<?php

namespace App\Http\Validators\Admin\Settings;

use Illuminate\Support\Facades\Validator;

class ChatValidator
{
    public static function validate($request): void
    {
        $rules = [
            'allowed_images'          => 'required',
            'allowed_files'           => 'required',
            'max_file_size'           => 'required|integer|min:1',
            'enable_attachments'      => 'boolean',
            'enable_emojis'           => 'boolean',
            'play_notification_sound' => 'boolean',
        ];

        $messages = [
            'allowed_images.required'         => __('messages.t_validator_required'),
            'allowed_files.required'          => __('messages.t_validator_required'),
            'max_file_size.required'          => __('messages.t_validator_required'),
            'max_file_size.integer'           => __('messages.t_validator_integer'),
            'max_file_size.min'               => __('messages.t_validator_min', ['min' => 1]),
            'enable_attachments.boolean'      => __('messages.t_validator_boolean'),
            'enable_emojis.boolean'           => __('messages.t_validator_boolean'),
            'play_notification_sound.boolean' => __('messages.t_validator_boolean'),
        ];

        $data = [
            'allowed_images'          => $request->allowed_images,
            'allowed_files'           => $request->allowed_files,
            'max_file_size'           => $request->max_file_size,
            'enable_attachments'      => $request->enable_attachments,
            'enable_emojis'           => $request->enable_emojis,
            'play_notification_sound' => $request->play_notification_sound,
        ];

        Validator::make($data, $rules, $messages)->validate();

        $request->resetValidation();
    }
}
