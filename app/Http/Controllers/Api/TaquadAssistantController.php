<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Ai\TaquadAssistant;
use Illuminate\Http\Request;

class TaquadAssistantController extends Controller
{
    public function chat(Request $request, TaquadAssistant $assistant)
    {

        $validated = $request->validate([
            'message'            => ['required', 'string', 'max:2000'],
            'history'            => ['sometimes', 'array'],
            'history.*.role'     => ['required_with:history', 'string', 'in:user,assistant'],
            'history.*.content'  => ['required_with:history', 'string', 'max:2000'],
        ]);

        $reply = $assistant->reply(
            $request->user(),
            $validated['message'],
            $validated['history'] ?? []
        );

        return response()->json([
            'reply' => $reply,
        ]);
    }
}
