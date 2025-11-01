<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrackerLoginController extends Controller
{
    public function __invoke(Request $request)
    {
        if (! Auth::check()) {
            session()->put('url.intended', $request->fullUrl());

            return redirect()->route('login');
        }

        return view('tracker.oauth', [
            'user' => Auth::user(),
            'autoClose' => $request->boolean('auto_close', true),
        ]);
    }
}
