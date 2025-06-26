<?php

namespace App\Http\Validators\Admin\Projects\Skills;

use Illuminate\Support\Facades\Validator;

class CreateValidator
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
                'name'     => 'required',
                'category' => 'required|exists:projects_categories,id'
            ];

            // Set errors messages
            $messages = [
                'name.required'     => __('messages.t_validator_required'),
                'category.required' => __('messages.t_validator_required'),
                'category.exists'   => __('messages.t_validator_exists')
            ];

            // Set data to validate
            $data     = [
                'name'     => $request->name,
                'category' => $request->category
            ];

            // Validate data
            Validator::make($data, $rules, $messages)->validate();

            // Reset validation
            $request->resetValidation();

        } catch (\Throwable $th) {
            throw $th;
        }
    }

}
