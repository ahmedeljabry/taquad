<?php

namespace App\Http\Validators\Main\Project;

use Illuminate\Support\Facades\Validator;

class BidValidator
{
    
    /**
     * Validate form
     *
     * @param object $request
     * @return void
     */
    static function validate($request)
    {
        try {

            // Set rules
            $rules    = [
                'bid_amount'      => 'required|regex:/^\d+(\.\d{1,2})?$/|max:10',
                'bid_days'        => 'required|integer',
                'bid_description' => 'required|max:3500'
            ];

            // Set errors messages
            $messages = [
                'bid_amount.required'      => __('messages.t_validator_required'),
                'bid_amount.regex'         => __('messages.t_validator_regex'),
                'bid_amount.max'           => __('messages.t_validator_max', ['max' => 10]),
                'bid_days.required'        => __('messages.t_validator_required'),
                'bid_days.integer'         => __('messages.t_validator_integer'),
                'bid_description.required' => __('messages.t_validator_required'),
                'bid_description.max'      => __('messages.t_validator_max', ['max' => 3500])
            ];

            // Set data to validate
            $data     = [
                'bid_amount'      => $request->bid_amount,
                'bid_days'        => $request->bid_days,
                'bid_description' => $request->bid_description
            ];

            $validator = Validator::make($data, $rules, $messages);

            $validator->after(function ($validator) use ($request) {
                if (($request->bid_plan_type ?? 'fixed') !== 'milestone') {
                    return;
                }

                $milestones = collect($request->bid_milestones ?? [])
                    ->map(function ($item) {
                        return [
                            'title'  => trim($item['title'] ?? ''),
                            'amount' => trim($item['amount'] ?? ''),
                            'due_in' => trim($item['due_in'] ?? ''),
                        ];
                    })
                    ->filter(function ($item) {
                        return $item['title'] !== '' || $item['amount'] !== '' || $item['due_in'] !== '';
                    });

                if ($milestones->isEmpty()) {
                    $validator->errors()->add('bid_milestones', __('messages.t_bid_milestones_required'));
                    return;
                }

                $hasError = false;

                foreach ($milestones as $milestone) {
                    if ($milestone['title'] === '' || $milestone['amount'] === '' || $milestone['due_in'] === '') {
                        $validator->errors()->add('bid_milestones', __('messages.t_bid_milestones_required'));
                        $hasError = true;
                        break;
                    }

                    if (!is_numeric(str_replace(',', '', $milestone['amount']))) {
                        $validator->errors()->add('bid_milestones', __('messages.t_validator_numeric'));
                        $hasError = true;
                        break;
                    }
                }

                if (!$hasError) {
                    $request->bid_milestones = $milestones->values()->toArray();
                }
            });

            // Validate data
            $validator->validate();

            // Reset validation
            $request->resetValidation();

        } catch (\Throwable $th) {
            throw $th;
        }
    }

}
