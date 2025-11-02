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
    <body class="min-h-screen bg-slate-950 text-white">
        @php
            $avatar = $user->avatar ? src($user->avatar) : placeholder_img();
        @endphp

        <div class="relative flex min-h-screen items-center justify-center px-5 py-12">
            <div class="absolute inset-0 overflow-hidden">
                <div class="pointer-events-none absolute -top-32 -end-20 h-72 w-72 rounded-full bg-primary-500/30 blur-3xl"></div>
                <div class="pointer-events-none absolute -bottom-32 -start-20 h-72 w-72 rounded-full bg-indigo-500/30 blur-3xl"></div>
            </div>

            <div class="relative w-full max-w-xl space-y-8 rounded-3xl border border-white/10 bg-white/10 p-10 shadow-2xl shadow-indigo-900/40 backdrop-blur">
                <div class="flex items-center justify-between gap-4">
                    <h1 class="text-start text-2xl font-semibold leading-snug sm:text-3xl">
                        {{ __('messages.t_tracker_browser_heading', ['app' => config('app.name')]) }}
                    </h1>
                    <img src="{{ $avatar }}" alt="{{ $user->fullname ?? $user->username ?? $user->name }}"
                         class="h-16 w-16 rounded-2xl border border-white/30 object-cover shadow-lg" />
                </div>

                <p class="text-sm leading-relaxed text-white/70">
                    {{ __('messages.t_tracker_browser_message') }}
                </p>

                @if (session('status'))
                    <div class="rounded-2xl border border-emerald-400/40 bg-emerald-500/10 px-4 py-3 text-sm text-emerald-100 shadow">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="flex items-center gap-4 rounded-2xl border border-white/10 bg-white/5 px-5 py-4 text-left">
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-primary-500/20 text-primary-200">
                        <i class="ph-duotone ph-user-circle text-2xl"></i>
                    </div>
                    <div class="space-y-1">
                        <p class="text-xs font-semibold uppercase tracking-[0.35em] text-white/40">
                            {{ __('messages.t_tracker_browser_signed_in_as') }}
                        </p>
                        <p class="text-base font-semibold text-white">
                            {{ $user->fullname ?? $user->username ?? $user->name }}
                        </p>
                    </div>
                </div>

                <div class="space-y-4">
                    <button type="button"
                            class="w-full inline-flex items-center justify-center gap-2 rounded-2xl border border-transparent bg-primary-500 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-primary-600 focus:outline-none focus:ring-2 focus:ring-primary-300 focus:ring-offset-2 focus:ring-offset-slate-900"
                            onclick="window.close();">
                        <i class="ph-duotone ph-check-circle text-base"></i>
                        {{ __('messages.t_tracker_browser_close_button') }}
                    </button>

                    <p class="text-xs leading-relaxed text-white/50">
                        {{ __('messages.t_tracker_browser_manual_hint') }}
                    </p>

                    <form method="POST" action="{{ route('tracker.logout') }}" class="w-full">
                        @csrf
                        <button type="submit"
                                class="inline-flex w-full items-center justify-center gap-2 rounded-2xl border border-white/30 px-4 py-2 text-xs font-semibold text-white/80 transition hover:border-white/50 hover:text-white">
                            <i class="ph-duotone ph-sign-out text-base"></i>
                            {{ __('messages.t_tracker_browser_logout_button') }}
                        </button>
                    </form>
                </div>
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
