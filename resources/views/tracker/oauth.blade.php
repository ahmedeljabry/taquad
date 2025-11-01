<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ config()->get('direction') }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>{{ __('messages.t_tracker_browser_heading', ['app' => config('app.name')]) }}</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @vite(['resources/css/app.css','resources/js/app.js'])
    </head>
    <body class="antialiased min-h-screen bg-slate-950 text-white flex items-center justify-center px-6 py-16">
        <div class="w-full max-w-lg space-y-8 rounded-3xl border border-white/10 bg-white/5 p-10 text-center shadow-2xl shadow-indigo-900/30 backdrop-blur">
            <div class="space-y-3">
                <span class="inline-flex items-center justify-center gap-2 rounded-full bg-white/10 px-4 py-1 text-[11px] font-semibold uppercase tracking-[0.35em] text-indigo-200">
                    
                    {{ __('messages.t_tracker_browser_title') }}
                </span>

                <h1 class="text-2xl font-semibold leading-snug sm:text-3xl">
                    {{ __('messages.t_tracker_browser_heading', ['app' => config('app.name')]) }}
                </h1>

                <p class="text-sm leading-relaxed text-white/70">
                    {{ __('messages.t_tracker_browser_message') }}
                </p>
            </div>

            <div class="space-y-2 rounded-2xl border border-white/10 bg-white/5 px-5 py-4 text-sm text-left text-white/80">
                <p class="text-xs font-semibold uppercase tracking-[0.35em] text-white/40">
                    {{ __('messages.t_tracker_browser_signed_in_as') }}
                </p>
                <p class="font-semibold text-base text-white">
                    {{ $user->fullname ?? $user->username ?? $user->name }}
                </p>
                <p class="text-xs text-white/50">
                    {{ $user->email }}
                </p>
            </div>

            <div class="space-y-3">
                <button type="button"
                        class="w-full inline-flex items-center justify-center gap-2 rounded-2xl border border-transparent bg-primary-500 px-4 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-primary-600 focus:outline-none focus:ring-2 focus:ring-primary-400 focus:ring-offset-2 focus:ring-offset-slate-950"
                        onclick="window.close();">
                    
                    {{ __('messages.t_tracker_browser_close_button') }}
                </button>

                <p class="text-xs leading-relaxed text-white/50">
                    {{ __('messages.t_tracker_browser_manual_hint') }}
                </p>

                <form method="POST" action="{{ route('logout') }}" class="inline-flex w-full justify-center">
                    @csrf
                    <button type="submit"
                            class="inline-flex items-center justify-center gap-2 rounded-2xl border border-white/20 px-4 py-2 text-xs font-semibold text-white/80 transition hover:border-white/40 hover:text-white">
                        
                        {{ __('messages.t_tracker_browser_logout_button') }}
                    </button>
                </form>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                if (@json($autoClose) && window.opener == null) {
                    try {
                        window.close();
                    } catch (e) {
                        /* noop */
                    }
                }
            });
        </script>
    </body>
</html>
