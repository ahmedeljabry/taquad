<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\SupportMessage;
use App\Notifications\Admin\PendingMessage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class SupportWidgetController extends Controller
{
    /**
     * Handle support widget ticket submission.
     */
    public function __invoke(Request $request): JsonResponse
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name'     => ['required', 'string', 'max:60'],
                'email'    => ['required', 'email', 'max:120'],
                'topic'    => ['nullable', 'string', 'max:120'],
                'priority' => ['nullable', 'in:low,normal,high'],
                'message'  => ['required', 'string', 'max:2000'],
            ],
            [
                'name.required'    => __('messages.t_validator_required'),
                'name.max'         => __('messages.t_validator_max', ['max' => 60]),
                'email.required'   => __('messages.t_validator_required'),
                'email.email'      => __('messages.t_validator_email'),
                'email.max'        => __('messages.t_validator_max', ['max' => 120]),
                'topic.max'        => __('messages.t_validator_max', ['max' => 120]),
                'priority.in'      => __('messages.t_validator_in'),
                'message.required' => __('messages.t_validator_required'),
                'message.max'      => __('messages.t_validator_max', ['max' => 2000]),
            ]
        );

        $data = $validator->validate();

        $subject = $data['topic'] ?? __('messages.t_support_widget_subject_fallback');
        if (!empty($data['priority'])) {
            $subject = '[' . __('messages.t_support_priority_' . $data['priority']) . '] ' . $subject;
        }

        $supportMessage             = new SupportMessage();
        $supportMessage->uid        = Str::uuid()->toString();
        $supportMessage->ip_address = $request->ip();
        $supportMessage->user_agent = $request->userAgent();
        $supportMessage->name       = clean($data['name']);
        $supportMessage->email      = clean($data['email']);
        $supportMessage->subject    = clean($subject);
        $supportMessage->message    = clean($data['message']);
        $supportMessage->save();

        Admin::first()?->notify((new PendingMessage($supportMessage))->locale(config('app.locale')));

        return response()->json([
            'message' => __('messages.t_support_widget_success'),
        ]);
    }
}
