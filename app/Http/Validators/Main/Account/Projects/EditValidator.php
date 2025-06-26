<?php

namespace App\Http\Validators\Main\Account\Projects;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class EditValidator
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

            // Get max skills
            $max_skills = settings('projects')->max_skills;

            // Set rules
            $rules      = [
                'title'         => 'required|max:100',
                'description'   => 'required',
                'category'      => 'required|exists:categories,id',
                'subcategory'   => 'required|exists:subcategories,id',
                'childcategory' => 'required|exists:childcategories,id',
                'skills'        => ['required', 'array', "max:$max_skills"],
                'skills.*'      => [ Rule::exists('projects_skills', 'id')->where(function($query) use ($request) {
                    return $query->where('category_id', $request->category);
                }) ],
                'salary_type' => 'required|in:hourly,fixed',
                'min_price'   => ['required', 'regex:/^([1-9][0-9]*|0)(\.[0-9]{1,2})?$/'],
                'max_price'   => ['required', 'regex:/^([1-9][0-9]*|0)(\.[0-9]{1,2})?$/']
            ];

            // Set errors messages
            $messages = [
                'title.required'         => __('messages.t_validator_required'),
                'title.max'              => __('messages.t_validator_max', ['max' => 100]),
                'description.required'   => __('messages.t_validator_required'),
                'category.required'      => __('messages.t_validator_required'),
                'category.exists'        => __('messages.t_validator_exists'),
                'subcategory.required'   => __('messages.t_validator_required'),
                'subcategory.exists'     => __('messages.t_validator_exists'),
                'childcategory.required' => __('messages.t_validator_required'),
                'childcategory.exists'   => __('messages.t_validator_exists'),
                'skills.required'        => __('messages.t_validator_required'),
                'skills.array'           => __('messages.t_validator_array'),
                'skills.max'             => __('messages.t_validator_max_array', ['max' => $max_skills]),
                'skills.*.exists'        => __('messages.t_validator_exists'),
                'salary_type.required'   => __('messages.t_validator_required'),
                'salary_type.in'         => __('messages.t_validator_in'),
                'min_price.required'     => __('messages.t_validator_required'),
                'min_price.regex'        => __('messages.t_validator_regex'),
                'max_price.required'     => __('messages.t_validator_required'),
                'max_price.regex'        => __('messages.t_validator_regex'),
            ];

            // Set data to validate
            $data     = [
                'title'         => $request->title,
                'description'   => $request->description,
                'category'      => $request->category,
                'subcategory'   => $request->subcategory,
                'childcategory' => $request->childcategory,
                'skills'        => $request->required_skills,
                'salary_type'   => $request->salary_type,
                'min_price'     => $request->min_price,
                'max_price'     => $request->max_price
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
