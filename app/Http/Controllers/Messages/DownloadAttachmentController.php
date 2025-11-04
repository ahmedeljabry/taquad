<?php

namespace App\Http\Controllers\Messages;

use App\Http\Controllers\Controller;
use App\Models\MessageAttachment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DownloadAttachmentController extends Controller
{
    public function __invoke(MessageAttachment $attachment): StreamedResponse
    {
        $user = Auth::user() ?: Auth::guard('admin')->user();

        abort_unless($user, 403);

        $attachment->loadMissing('message.conversation.participants');

        $conversation = optional($attachment->message)->conversation;

        $isParticipant = $conversation
            ? $conversation->participants->contains('user_id', $user->id)
            : false;

        $isAdmin = Auth::guard('admin')->check()
            || (method_exists($user, 'isAdmin') && $user->isAdmin());

        abort_unless($isParticipant || $isAdmin, 403);

        abort_unless(Storage::disk($attachment->disk)->exists($attachment->path), 404);

        $filename = $attachment->file_name ?: basename($attachment->path);

        return Storage::disk($attachment->disk)->download($attachment->path, $filename);
    }
}
