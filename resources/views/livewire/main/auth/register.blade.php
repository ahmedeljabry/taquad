<div class="w-full px-6 py-10 sm:px-10 lg:px-12">
    <div class="mx-auto w-full max-w-xl space-y-10">

        {{-- Welcome --}}
        <div class="space-y-3 text-center">
            <span class="inline-flex items-center gap-2 rounded-full bg-primary-50 px-4 py-1 text-[11px] font-semibold uppercase tracking-[0.35em] text-primary-600 dark:bg-primary-500/15 dark:text-primary-200">
                <i class="ph ph-seal-check text-xs"></i>
                {{ __('messages.t_create_account') }}
            </span>
            <h2 class="text-2xl font-semibold text-zinc-900 dark:text-white sm:text-3xl">
                {{ __('messages.t_welcome_to_app_name', ['name' => config('app.name')]) }}
            </h2>
            <p class="mx-auto max-w-sm text-sm leading-6 text-slate-500 dark:text-zinc-300">
                {{ __('messages.t_register_intro_modern') }}
            </p>
        </div>

        {{-- Flash message --}}
        @if (session()->has('success'))
            <div class="rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700 dark:border-emerald-500/40 dark:bg-emerald-500/10 dark:text-emerald-200">
                {{ session()->get('success') }}
            </div>
        @endif

        {{-- Multi step form --}}
        <div class="relative overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm shadow-slate-900/5 dark:border-zinc-700 dark:bg-zinc-900"
            x-data="window.UcZWcDFfVKBjfgP">

            <div class="absolute inset-0 opacity-10 blur-2xl" style="background: radial-gradient(circle at top, rgba(14,165,233,0.4), transparent 55%), radial-gradient(circle at bottom, rgba(249,115,22,0.4), transparent 55%);"></div>

            <div class="relative space-y-10 p-6 sm:p-8">

                {{-- Step indicator --}}
                <div class="flex items-center justify-between text-xs font-semibold uppercase tracking-[0.32em] text-slate-400 dark:text-zinc-500">
                    <div class="flex items-center gap-3">
                        <span x-bind:class="step === 1 ? 'bg-primary-600 text-white' : 'bg-slate-200 text-slate-600 dark:bg-zinc-700 dark:text-zinc-200'"
                            class="flex h-9 w-9 items-center justify-center rounded-full transition">1</span>
                        <span>{{ __('messages.t_register_step_choose_role') }}</span>
                    </div>
                    <div class="hidden items-center gap-3 sm:flex">
                        <span x-bind:class="step === 2 ? 'bg-primary-600 text-white' : 'bg-slate-200 text-slate-600 dark:bg-zinc-700 dark:text-zinc-200'"
                            class="flex h-9 w-9 items-center justify-center rounded-full transition">2</span>
                        <span>{{ __('messages.t_register_step_account') }}</span>
                    </div>
                </div>

                {{-- Step 1: role selection --}}
                <div x-show="step === 1" x-cloak class="space-y-6">
                    <div class="space-y-2">
                        <h3 class="text-lg font-semibold text-zinc-900 dark:text-zinc-100">
                            {{ __('messages.t_choose_how_you_will_use_app', ['app' => config('app.name')]) }}
                        </h3>
                        <p class="text-sm text-slate-500 dark:text-zinc-400">
                            {{ __('messages.t_role_selection_help') }}
                        </p>
                    </div>

                    <div class="grid gap-4 sm:grid-cols-1">
                        <template x-for="role in roles" :key="role.key">
                            <button type="button" x-on:click="selectRole(role.key)"
                                x-bind:class="selectedRole === role.key ? 'border-primary-400/80 bg-primary-50/70 text-primary-700 dark:border-primary-400/40 dark:bg-primary-500/10 dark:text-primary-200' : 'border-slate-200 bg-white text-slate-600 hover:-translate-y-1 hover:border-primary-200 hover:bg-primary-50/60 dark:border-zinc-700 dark:bg-zinc-900/60 dark:text-zinc-300 dark:hover:border-primary-400/40 dark:hover:text-primary-200'"
                                class="group flex w-full flex-col items-start gap-3 rounded-2xl border px-5 py-4 text-left transition duration-200">
                                <span class="inline-flex items-center gap-2 rounded-full bg-white/80 px-3 py-1 text-[11px] font-semibold uppercase tracking-[0.35em] text-slate-400 dark:bg-zinc-900/80 dark:text-zinc-500">
                                    <i class="ph text-xs" x-bind:class="role.icon"></i>
                                    <span x-text="role.badge"></span>
                                </span>
                                <div class="space-y-1">
                                    <h4 class="text-base font-semibold text-zinc-900 dark:text-zinc-100" x-text="role.title"></h4>
                                    <p class="text-sm leading-6 text-slate-500 dark:text-zinc-400" x-text="role.description"></p>
                                </div>
                                <span class="inline-flex items-center gap-2 text-[11px] font-semibold uppercase tracking-[0.35em] text-primary-600 transition group-hover:translate-x-1 dark:text-primary-200">
                                    <span>{{ __('messages.t_select_role_cta') }}</span>
                                    <i class="ph ph-arrow-right text-xs"></i>
                                </span>
                            </button>
                        </template>
                    </div>

                    <div class="flex flex-wrap items-center justify-between gap-4">
                        <button type="button"
                            class="inline-flex items-center gap-2 text-xs font-semibold uppercase tracking-[0.35em] text-slate-400 transition hover:text-slate-600 dark:text-zinc-500 dark:hover:text-zinc-300"
                            x-on:click="resetRole()">
                            <i class="ph ph-arrow-counter-clockwise text-xs"></i>
                            {{ __('messages.t_clear_choice') }}
                        </button>
                        <button type="button" x-on:click="nextStep"
                            x-bind:disabled="!selectedRole"
                            class="inline-flex items-center gap-2 rounded-2xl bg-primary-600 px-5 py-3 text-xs font-semibold uppercase tracking-[0.35em] text-white shadow-sm shadow-primary-500/30 transition hover:-translate-y-0.5 hover:bg-primary-700 disabled:cursor-not-allowed disabled:bg-slate-200 disabled:text-slate-500 dark:disabled:bg-zinc-600 dark:disabled:text-zinc-300">
                            {{ __('messages.t_continue') }}
                            <i class="ph ph-arrow-right text-xs"></i>
                        </button>
                    </div>
                </div>

                {{-- Step 2: account details --}}
                <div x-show="step === 2" x-cloak class="space-y-6">
                    <div class="space-y-2">
                        <div class="inline-flex items-center gap-2 rounded-full bg-slate-100 px-3 py-1 text-[11px] font-semibold uppercase tracking-[0.35em] text-slate-500 dark:bg-zinc-800 dark:text-zinc-400">
                            <i class="ph ph-user-focus text-xs"></i>
                            <span x-text="roleLabel"></span>
                        </div>
                        <h3 class="text-lg font-semibold text-zinc-900 dark:text-zinc-100">
                            {{ __('messages.t_setup_your_profile') }}
                        </h3>
                        <p class="text-sm text-slate-500 dark:text-zinc-400">
                            {{ __('messages.t_account_details_subheading') }}
                        </p>
                    </div>

                    <div class="space-y-5">
                        {{-- Fullname --}}
                        <div class="space-y-2">
                            <label class="text-xs font-semibold uppercase tracking-[0.32em] text-slate-400 dark:text-zinc-500">
                                @lang('messages.t_fullname')
                            </label>
                            <input type="text" x-model="form.fullname"
                                class="w-full rounded-2xl border {{ $errors->first('fullname') ? 'border-rose-400 focus:border-rose-500 focus:ring-rose-500/20' : 'border-slate-200 focus:border-primary-500 focus:ring-primary-500/10 dark:border-zinc-700 dark:focus:border-primary-400' }} bg-white/80 px-4 py-3 text-sm font-semibold text-slate-900 shadow-sm outline-none transition placeholder:text-slate-400 dark:bg-zinc-900/80 dark:text-zinc-100 dark:placeholder:text-zinc-500"
                                placeholder="{{ __('messages.t_enter_your_fullname') }}">
                            @error('fullname')
                                <p class="text-[12px] font-semibold text-rose-500">
                                    {{ $errors->first('fullname') }}
                                </p>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div class="space-y-2">
                            <label class="text-xs font-semibold uppercase tracking-[0.32em] text-slate-400 dark:text-zinc-500">
                                @lang('messages.t_email')
                            </label>
                            <input type="email" x-model="form.email"
                                class="w-full rounded-2xl border {{ $errors->first('email') ? 'border-rose-400 focus:border-rose-500 focus:ring-rose-500/20' : 'border-slate-200 focus:border-primary-500 focus:ring-primary-500/10 dark:border-zinc-700 dark:focus:border-primary-400' }} bg-white/80 px-4 py-3 text-sm font-semibold text-slate-900 shadow-sm outline-none transition placeholder:text-slate-400 dark:bg-zinc-900/80 dark:text-zinc-100 dark:placeholder:text-zinc-500"
                                placeholder="{{ __('messages.t_enter_email_address') }}">
                            @error('email')
                                <p class="text-[12px] font-semibold text-rose-500">
                                    {{ $errors->first('email') }}
                                </p>
                            @enderror
                        </div>

                        {{-- Username --}}
                        <div class="space-y-2">
                            <label class="text-xs font-semibold uppercase tracking-[0.32em] text-slate-400 dark:text-zinc-500">
                                @lang('messages.t_username')
                            </label>
                            <input type="text" x-model="form.username"
                                class="w-full rounded-2xl border {{ $errors->first('username') ? 'border-rose-400 focus:border-rose-500 focus:ring-rose-500/20' : 'border-slate-200 focus:border-primary-500 focus:ring-primary-500/10 dark:border-zinc-700 dark:focus:border-primary-400' }} bg-white/80 px-4 py-3 text-sm font-semibold text-slate-900 shadow-sm outline-none transition placeholder:text-slate-400 dark:bg-zinc-900/80 dark:text-zinc-100 dark:placeholder:text-zinc-500"
                                placeholder="{{ __('messages.t_enter_username') }}">
                            @error('username')
                                <p class="text-[12px] font-semibold text-rose-500">
                                    {{ $errors->first('username') }}
                                </p>
                            @enderror
                        </div>

                        {{-- Password --}}
                        <div class="space-y-2" x-data="{ reveal: false }">
                            <label class="text-xs font-semibold uppercase tracking-[0.32em] text-slate-400 dark:text-zinc-500">
                                @lang('messages.t_password')
                            </label>
                            <div class="relative">
                                <input :type="reveal ? 'text' : 'password'" x-model="form.password"
                                    class="w-full rounded-2xl border {{ $errors->first('password') ? 'border-rose-400 focus:border-rose-500 focus:ring-rose-500/20' : 'border-slate-200 focus:border-primary-500 focus:ring-primary-500/10 dark:border-zinc-700 dark:focus:border-primary-400' }} bg-white/80 px-4 py-3 text-sm font-semibold text-slate-900 shadow-sm outline-none transition placeholder:text-slate-400 dark:bg-zinc-900/80 dark:text-zinc-100 dark:placeholder:text-zinc-500"
                                    placeholder="{{ __('messages.t_enter_password') }}">
                                <button type="button" x-on:click="reveal = !reveal"
                                    class="absolute inset-y-0 right-0 flex items-center pr-4 text-slate-400 transition hover:text-slate-600 dark:text-zinc-500 dark:hover:text-zinc-300">
                                    <i :class="reveal ? 'ph-eye-slash' : 'ph-eye'" class="ph text-lg"></i>
                                </button>
                            </div>
                            @error('password')
                                <p class="text-[12px] font-semibold text-rose-500">
                                    {{ $errors->first('password') }}
                                </p>
                            @enderror
                        </div>

                        {{-- Terms --}}
                        <div class="space-y-2 rounded-2xl bg-slate-100/70 p-4 text-[12px] font-semibold text-slate-500 dark:bg-zinc-800/70 dark:text-zinc-300">
                            <div class="inline-flex items-center gap-3">
                                <i class="ph ph-shield-check text-base text-primary-500"></i>
                                <span>{{ __('messages.t_by_signup_u_agree_to_terms_privacy') }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-wrap items-center justify-between gap-4">
                        <button type="button" x-on:click="previousStep"
                            class="inline-flex items-center gap-2 text-xs font-semibold uppercase tracking-[0.35em] text-slate-400 transition hover:text-slate-600 dark:text-zinc-500 dark:hover:text-zinc-300">
                            <i class="ph ph-caret-left text-xs"></i>
                            {{ __('messages.t_back') }}
                        </button>
                        <button type="button" x-on:click="submit"
                            :disabled="!form.fullname || !form.email || !form.username || !form.password"
                            class="inline-flex items-center gap-2 rounded-2xl bg-primary-600 px-5 py-3 text-xs font-semibold uppercase tracking-[0.35em] text-white shadow-sm shadow-primary-500/30 transition hover:-translate-y-0.5 hover:bg-primary-700 disabled:cursor-not-allowed disabled:bg-slate-200 disabled:text-slate-500 dark:disabled:bg-zinc-600 dark:disabled:text-zinc-300">
                            {{ __('messages.t_create_account') }}
                            <i class="ph ph-arrow-right text-xs"></i>
                        </button>
                    </div>
                </div>

                {{-- Divider --}}
                <div class="relative">
                    <div class="absolute inset-0 flex items-center" aria-hidden="true">
                        <span class="w-full border-t border-dashed border-slate-200 dark:border-zinc-700"></span>
                    </div>
                    <div class="relative flex justify-center">
                        <span class="rounded-full bg-white px-3 text-[11px] font-semibold uppercase tracking-[0.35em] text-slate-400 dark:bg-zinc-900 dark:text-zinc-500">
                            {{ __('messages.t_or') }}
                        </span>
                    </div>
                </div>

                {{-- Social logins --}}
                @if ($social_grid)
                    <div class="grid grid-cols-{{ $social_grid > 3 ? 3 : $social_grid }} gap-3">
                        @if (settings('auth')->is_facebook_login)
                            <a href="{{ url('auth/facebook') }}" class="inline-flex items-center justify-center gap-2 rounded-2xl border border-slate-200 bg-white/90 px-3 py-2 text-sm font-semibold text-slate-600 transition hover:-translate-y-0.5 hover:border-primary-300 dark:border-zinc-700 dark:bg-zinc-900/80 dark:text-zinc-100">
                                <i class="ph ph-facebook-logo text-lg text-[#1877F2]"></i>
                                <span class="hidden sm:inline">{{ __('messages.t_continue_with_facebook') }}</span>
                            </a>
                        @endif
                        @if (settings('auth')->is_google_login)
                            <a href="{{ url('auth/google') }}" class="inline-flex items-center justify-center gap-2 rounded-2xl border border-slate-200 bg-white/90 px-3 py-2 text-sm font-semibold text-slate-600 transition hover:-translate-y-0.5 hover:border-primary-300 dark:border-zinc-700 dark:bg-zinc-900/80 dark:text-zinc-100">
                                <i class="ph ph-google-logo text-lg text-[#EA4335]"></i>
                                <span class="hidden sm:inline">{{ __('messages.t_continue_with_google') }}</span>
                            </a>
                        @endif
                        @if (settings('auth')->is_github_login)
                            <a href="{{ url('auth/github') }}" class="inline-flex items-center justify-center gap-2 rounded-2xl border border-slate-200 bg-white/90 px-3 py-2 text-sm font-semibold text-slate-600 transition hover:-translate-y-0.5 hover:border-primary-300 dark:border-zinc-700 dark:bg-zinc-900/80 dark:text-zinc-100">
                                <i class="ph ph-github-logo text-lg"></i>
                                <span class="hidden sm:inline">{{ __('messages.t_continue_with_github') }}</span>
                            </a>
                        @endif
                        @if (settings('auth')->is_twitter_login)
                            <a href="{{ url('auth/twitter') }}" class="inline-flex items-center justify-center gap-2 rounded-2xl border border-slate-200 bg-white/90 px-3 py-2 text-sm font-semibold text-slate-600 transition hover:-translate-y-0.5 hover:border-primary-300 dark:border-zinc-700 dark:bg-zinc-900/80 dark:text-zinc-100">
                                <i class="ph ph-twitter-logo text-lg text-[#1DA1F2]"></i>
                                <span class="hidden sm:inline">{{ __('messages.t_continue_with_twitter') }}</span>
                            </a>
                        @endif
                        @if (settings('auth')->is_linkedin_login)
                            <a href="{{ url('auth/linkedin') }}" class="inline-flex items-center justify-center gap-2 rounded-2xl border border-slate-200 bg-white/90 px-3 py-2 text-sm font-semibold text-slate-600 transition hover:-translate-y-0.5 hover:border-primary-300 dark:border-zinc-700 dark:bg-zinc-900/80 dark:text-zinc-100">
                                <i class="ph ph-linkedin-logo text-lg text-[#0A66C2]"></i>
                                <span class="hidden sm:inline">{{ __('messages.t_continue_with_linkedin') }}</span>
                            </a>
                        @endif
                    </div>
                @endif

                {{-- Already have account --}}
                <div class="flex flex-wrap items-center justify-center gap-2 text-sm font-semibold text-slate-500 dark:text-zinc-300">
                    <span>{{ __('messages.t_already_have_account') }}</span>
                    <a href="{{ url('auth/login') }}" class="inline-flex items-center gap-1 text-primary-600 transition hover:text-primary-700 dark:text-primary-300">
                        <span>{{ __('messages.t_login') }}</span>
                        <i class="ph ph-arrow-up-right text-xs"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
    @if (settings('security')->is_recaptcha)
        <script src="https://www.google.com/recaptcha/api.js?render={{ config('recaptcha.site_key') }}"></script>
        <script>
            var recaptcha_token = null;
            grecaptcha.ready(function () {
                grecaptcha.execute("{{ config('recaptcha.site_key') }}", { action: 'register' })
                        .then(function (token) {
                            var recaptcha_token = token;
                        });
            });
        </script>
    @endif
@endpush

@push('scripts')
    <script>
        function UcZWcDFfVKBjfgP() {
            return {
                step: 1,
                selectedRole: null,
                roleLabel: '',
                roles: [
                    {
                        key: 'freelancer',
                        title: "{{ __('messages.t_role_freelancer_title') }}",
                        description: "{{ __('messages.t_role_freelancer_desc') }}",
                        badge: "{{ __('messages.t_role_freelancer_badge') }}",
                        icon: 'ph-briefcase'
                    },
                    {
                        key: 'client',
                        title: "{{ __('messages.t_role_client_title') }}",
                        description: "{{ __('messages.t_role_client_desc') }}",
                        badge: "{{ __('messages.t_role_client_badge') }}",
                        icon: 'ph-buildings'
                    },
                    {
                        key: 'hybrid',
                        title: "{{ __('messages.t_role_hybrid_title') }}",
                        description: "{{ __('messages.t_role_hybrid_desc') }}",
                        badge: "{{ __('messages.t_role_hybrid_badge') }}",
                        icon: 'ph-planet'
                    }
                ],
                form: {
                    fullname    : null,
                    email       : null,
                    username    : null,
                    password    : null,
                    account_type: 'buyer',
                    intent      : null
                },
                recaptcha: Boolean("{{ settings('security')->is_recaptcha ? true : false }}"),

                selectRole(key) {
                    this.selectedRole = key;
                    this.form.intent  = key;
                    if (key === 'freelancer') {
                        this.form.account_type = 'seller';
                        this.roleLabel         = "{{ __('messages.t_role_label_freelancer') }}";
                    } else if (key === 'client') {
                        this.form.account_type = 'buyer';
                        this.roleLabel         = "{{ __('messages.t_role_label_client') }}";
                    } else {
                        this.form.account_type = 'buyer';
                        this.roleLabel         = "{{ __('messages.t_role_label_hybrid') }}";
                    }
                },

                resetRole() {
                    this.selectedRole = null;
                    this.form.account_type = 'buyer';
                    this.form.intent = null;
                    this.roleLabel = '';
                },

                nextStep() {
                    if (this.selectedRole) {
                        this.step = 2;
                    } else {
                        window.$wireui.notify({
                            title      : "{{ __('messages.t_error') }}",
                            description: "{{ __('messages.t_select_role_first') }}",
                            icon       : 'error'
                        });
                    }
                },

                previousStep() {
                    this.step = 1;
                },

                submit() {
                    if (!this.form.fullname || !this.form.email || !this.form.username || !this.form.password) {
                        window.$wireui.notify({
                            title      : "{{ __('messages.t_error') }}",
                            description: "{{ __('messages.t_pls_check_ur_inputs_and_try_again') }}",
                            icon       : 'error'
                        });
                        return;
                    }

                    @this.register({
                        fullname       : this.form.fullname,
                        email          : this.form.email,
                        username       : this.form.username,
                        password       : this.form.password,
                        account_type   : this.form.account_type,
                        intent         : this.form.intent,
                        recaptcha_token: typeof recaptcha_token !== 'undefined' ? recaptcha_token : null
                    });
                }
            }
        }
        window.UcZWcDFfVKBjfgP = UcZWcDFfVKBjfgP();
    </script>
@endpush
