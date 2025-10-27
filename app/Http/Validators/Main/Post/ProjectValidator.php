<?php

namespace App\Http\Validators\Main\Post;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class ProjectValidator
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
                'category'      => 'required|exists:projects_categories,id',
                'skills'        => ['required', 'array', "max:$max_skills"],
                'skills.*'      => [ Rule::exists('projects_skills', 'id')->where(function($query) use ($request) {
                    return $query->where('category_id', $request->category);
                }) ],
                'salary_type'   => 'required|in:fixed',
                'min_price'     => ['required', 'regex:/^([1-9][0-9]*|0)(\.[0-9]{1,2})?$/'],
                'max_price'     => ['required', 'regex:/^([1-9][0-9]*|0)(\.[0-9]{1,2})?$/'],
                'attachments'   => 'nullable|array|max:5',
                'attachments.*' => 'nullable|file|max:25600|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx,zip,rar,7z,png,jpg,jpeg,webp,gif,mp3,wav,ogg,webm,mp4,m4a',
                'questions'     => 'nullable|array|max:8',
                'questions.*.text' => 'nullable|string|max:200',
                'questions.*.is_required' => 'nullable|boolean',
                'requires_nda'   => 'nullable|boolean',
                'nda_scope'      => 'nullable|string|max:500',
                'nda_term_months'=> 'nullable|integer|min:1|max:60',
            ];

            // Set errors messages
            $messages = [
                'title.required'         => __('messages.t_validator_required'),
                'title.max'              => __('messages.t_validator_max', ['max' => 100]),
                'description.required'   => __('messages.t_validator_required'),
                'category.required'      => __('messages.t_validator_required'),
                'category.exists'        => __('messages.t_validator_exists'),
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
                'attachments.array'      => __('messages.t_validator_array'),
                'attachments.max'        => __('messages.t_project_attachment_limit_reached', ['max' => 5]),
                'attachments.*.file'     => __('messages.t_validator_file'),
                'attachments.*.max'      => __('messages.t_validator_max_file_size', ['max' => '25MB']),
                'attachments.*.mimes'    => __('messages.t_validator_mimes'),
                'questions.array'        => __('messages.t_validator_array'),
                'questions.max'          => __('messages.t_question_limit_reached'),
                'questions.*.text.max'   => __('messages.t_validator_max', ['max' => 200]),
                'nda_scope.max'          => __('messages.t_validator_max', ['max' => 500]),
                'nda_term_months.integer'=> __('messages.t_validator_integer'),
                'nda_term_months.min'    => __('messages.t_validator_min', ['min' => 1]),
                'nda_term_months.max'    => __('messages.t_validator_max', ['max' => 60]),
            ];

            // Set data to validate
            $data     = [
                'title'         => $request->title,
                'description'   => $request->description,
                'category'      => $request->category,
                'skills'        => $request->required_skills,
                'salary_type'   => $request->salary_type,
                'min_price'     => $request->min_price,
                'max_price'     => $request->max_price,
                'attachments'   => $request->attachments,
                'questions'     => $request->questions,
                'requires_nda'  => $request->requires_nda,
                'nda_scope'     => $request->nda_scope,
                'nda_term_months' => $request->nda_term_months,
            ];

            // Validate data
            $validator = Validator::make($data, $rules, $messages);

            $validator->after(function ($validator) use ($data) {
                if (!empty($data['requires_nda']) && blank($data['nda_scope'])) {
                    $validator->errors()->add('nda_scope', __('messages.t_validator_required'));
                }
            });

            $validator->validate();

            // Reset validation
            $request->resetValidation();

        } catch (\Throwable $th) {
            throw $th;
        }
    }

}
