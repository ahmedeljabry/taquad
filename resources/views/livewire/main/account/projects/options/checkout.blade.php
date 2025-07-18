<div class="max-w-[1500px] mx-auto px-4 sm:px-6 lg:px-8 mt-[7rem] py-12 lg:pt-16 lg:pb-24">

    {{-- Loading --}}
    <x-forms.loading />

    {{-- Container --}}
    <div class="w-full">

        {{-- Empty state --}}
        <div class="max-w-4xl mx-auto mb-8">
            <div class="text-center">

                {{-- Icon --}}
                <div class="h-28 w-28 bg-slate-200 dark:bg-zinc-700 rounded-full flex items-center justify-center mx-auto">
                    <svg class="mx-auto h-12 w-12 dark:text-zinc-400" stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 256 256" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M230.19,78,200.7,103.17a5.09,5.09,0,0,0-1.66,5l8.84,37.46a5.2,5.2,0,0,1-7.77,5.57l-33.42-19.87a5.29,5.29,0,0,0-5.38,0l-33.42,19.87a5.2,5.2,0,0,1-7.77-5.57L129,108.22a5.09,5.09,0,0,0-1.66-5L97.81,78a5.12,5.12,0,0,1,3-9l38.88-3.29A5.21,5.21,0,0,0,144,62.57L159.2,27.14a5.24,5.24,0,0,1,9.6,0L184,62.57a5.21,5.21,0,0,0,4.36,3.12L227.23,69A5.12,5.12,0,0,1,230.19,78Z" opacity="0.2"></path><path d="M239.37,70.1A13.16,13.16,0,0,0,227.9,61l-37.22-3.15L176.16,24a13.24,13.24,0,0,0-24.31,0L137.33,57.86,100.1,61a13.13,13.13,0,0,0-7.49,23.06l28.16,24-8.43,35.73a13.1,13.1,0,0,0,5,13.58,13.25,13.25,0,0,0,14.63.7l32-19,32,19a13.25,13.25,0,0,0,14.63-.7,13.09,13.09,0,0,0,5-13.58l-8.43-35.73,28.15-24A13.07,13.07,0,0,0,239.37,70.1Zm-43.86,27a13.06,13.06,0,0,0-4.26,13l7.31,31-27.78-16.51a13.24,13.24,0,0,0-13.56,0L129.44,141l7.31-31a13,13,0,0,0-4.25-13L108.24,76.38l32.09-2.72a13.16,13.16,0,0,0,11-7.94L164,36.24l12.64,29.48a13.18,13.18,0,0,0,11,7.94l32.09,2.72ZM85.66,125.66l-56,56a8,8,0,0,1-11.32-11.32l56-56a8,8,0,0,1,11.32,11.32Zm16,56-56,56a8,8,0,0,1-11.32-11.32l56-56a8,8,0,0,1,11.32,11.32Zm72-11.32a8,8,0,0,1,0,11.32l-56,56a8,8,0,0,1-11.32-11.32l56-56A8,8,0,0,1,173.66,170.34Z"></path></svg>
                </div>

                {{-- Texts --}}
                <h2 class="mt-4 text-base font-bold text-gray-700 dark:text-gray-100">{{ __('messages.t_promote_project') }}</h2>

                {{-- TGo back to shopping cart --}}
                <p class="leading-relaxed text-gray-400 mt-1 text-sm">
                    @lang('messages.t_promote_project_subtitle')
                </p>

            </div>
        </div>

        {{-- Project preview --}}
        <div class="max-w-4xl mx-auto mb-16 rounded-lg bg-white shadow-sm border-gray-200 border px-10 py-6 dark:bg-zinc-800 dark:border-transparent">

            {{-- Title --}}
            <a href="{{ url('project/' . $subscription->project->pid . '/' . $subscription->project->slug) }}" target="_blank" class="block mb-4">
                <h1 class="font-semibold text-base text-zinc-700 hover:underline hover:text-primary-600 transition-all duration-200 dark:text-white">{{ $subscription->project->title }}</h1>
            </a>

            {{-- Details --}}
            <dl class="flex-1 grid grid-cols-2 gap-x-6 text-sm sm:col-span-3 sm:grid-cols-3 lg:col-span-2">

                {{-- Status --}}
                <div>
                    <dt class="font-normal text-gray-500 dark:text-zinc-400 text-xs">@lang('messages.t_status')</dt>
                    <dd class="text-[13px] font-medium mt-1 text-amber-700 dark:text-amber-400">@lang('messages.t_pending_payment')</dd>
                </div>

                {{-- Posted date --}}
                <div class="hidden sm:block">
                    <dt class="font-normal text-gray-500 dark:text-zinc-400 text-xs">@lang('messages.t_posted_date')</dt>
                    <dd class="text-[13px] font-medium mt-1 text-gray-700 dark:text-zinc-200">
                        <span>{{ format_date($subscription->project->created_at, 'ago') }}</span>
                    </dd>
                </div>

                {{-- Budget --}}
                <div>
                    <dt class="font-normal text-gray-500 dark:text-zinc-400 text-xs">@lang('messages.t_budget')</dt>
                    <dd class="mt-1 text-[13px] font-medium text-gray-700 dark:text-zinc-200">
                        {{ money($subscription->project->budget_min, settings('currency')->code, true) }}
                        <span class="text-gray-300 mx-1">/</span>
                        {{ money($subscription->project->budget_max, settings('currency')->code, true) }}
                    </dd>
                </div>

            </dl>

            {{-- Description --}}
            <div class="my-4 block leading-relaxed text-gray-500 dark:text-zinc-100 text-sm">
                {{ add_3_dots($subscription->project->description, 100) }}
            </div>

            {{-- Skills --}}
            <div class="mt-4 space-y-1">
                @foreach ($subscription->project->skills as $skill)
                    <div class="inline-block bg-gray-100 hover:bg-primary-100 text-gray-600 hover:text-primary-600 text-xs font-medium ltr:mr-2 rtl:ml-2 px-2.5 py-1 rounded-sm dark:text-gray-400 border border-gray-300 hover:border-primary-600 transition-colors duration-200 dark:bg-zinc-700 dark:border-zinc-500 dark:hover:text-zinc-100 whitespace-nowrap mb-1">
                        {{ $skill->skill->name }}
                    </div>
                @endforeach
            </div>

            {{-- View upgrades --}}
            <button type="button" id="modal-upgrades-button-{{ $subscription->uid }}" class="inline-flex justify-center items-center rounded border font-normal focus:outline-none px-3 py-2.5 leading-5 text-[13px] border-slate-100 bg-slate-100 text-slate-500 hover:bg-slate-50 focus:ring-0 mt-8 w-full tracking-wide dark:bg-zinc-700 dark:border-transparent dark:hover:bg-zinc-600 dark:hover:text-zinc-100 dark:text-zinc-300">
                @lang('messages.t_selected_upgrades')
            </button>

        </div>

        {{-- Content --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 max-w-4xl mx-auto lg:divide-x lg:divide-gray-200 lg:dark:divide-zinc-700 rtl:divide-x-reverse space-y-10 lg:space-y-0" x-data="{ selected_method: '' }">

            {{-- Available payment methods --}}
            <fieldset class="lg:ltr:pr-10 lg:rtl:pl-10">

                {{-- Step title --}}
                <div class="flex items-center lg:justify-center rtl:space-x-reverse space-x-2 mb-10">
                    <svg class="h-6 w-6 -mt-px dark:text-gray-200" stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 256 256" xmlns="http://www.w3.org/2000/svg"><path d="M216,48V208a8,8,0,0,1-8,8H48a8,8,0,0,1-8-8V48a8,8,0,0,1,8-8H208A8,8,0,0,1,216,48Z" opacity="0.2"></path><path d="M208,32H48A16,16,0,0,0,32,48V208a16,16,0,0,0,16,16H208a16,16,0,0,0,16-16V48A16,16,0,0,0,208,32Zm0,176H48V48H208V208ZM140,80v96a8,8,0,0,1-16,0V95l-11.56,7.71a8,8,0,1,1-8.88-13.32l24-16A8,8,0,0,1,140,80Z"></path></svg>
                    <span class="text-base font-bold text-slate-500 tracking-wide dark:text-zinc-300">
                        @lang('messages.t_choose_ur_prefered_payment_method')
                    </span>
                </div>

                {{-- Automatic methods --}}
                <legend class="sr-only"> @lang('messages.t_select_payment_method') </legend>
                <div class="relative -space-y-px rounded-md bg-white border border-gray-200 divide-y divide-gray-100 shadow-sm dark:bg-zinc-800 dark:border-zinc-700 dark:divide-zinc-700 mb-4">

                    @foreach ($payment_methods as $p)
                        <label wire:key="payment-method-{{ $p->uid }}" class="{{ $loop->first ? 'rounded-tl-md rounded-tr-md' : '' }} {{ $loop->last ? 'rounded-bl-md rounded-br-md' : '' }} relative p-4 flex flex-col cursor-pointer md:ltr:pl-4 md:rtl:pr-4 md:ltr:pr-6 md:rtl:pl-6 md:grid md:grid-cols-2 focus:outline-none" :class="selected_method == '{{ $p->slug }}' ? 'bg-primary-50 border-primary-200 dark:bg-zinc-700 dark:border-zinc-700' : 'border-gray-200 hover:bg-gray-50 dark:hover:bg-zinc-600'">

                            {{-- Title --}}
                            <span class="flex items-center text-sm">
                                <input type="radio" x-model="selected_method" wire:model.live="selected_method" name="selected_method" value="{{ $p->slug }}" class="h-5 w-5 text-primary-600 border-gray-300 focus:ring-0 focus:outline-none focus:ring-transparent focus:ring-offset-0 dark:bg-zinc-700 dark:border-zinc-700" />
                                <span class="ltr:ml-3 rtl:mr-3 font-medium whitespace-nowrap" :class="selected_method == '{{ $p->slug }}' ? 'text-primary-600 dark:text-white' : 'text-zinc-800 dark:text-zinc-200'">
                                    {{ $p->name }}
                                </span>
                            </span>

                            {{-- Logo --}}
                            @if ($p->logo)
                                <span class="flex items-center">
                                    <img class="w-auto h-6 ltr:ml-auto rtl:mr-auto rounded" src="{{ src($p->logo) }}" alt="{{ $p->name }}">
                                </span>
                            @endif


                        </label>
                    @endforeach

                </div>

                {{-- Offline method --}}
                @php
                    $offline_method = payment_gateway('offline', false, true);
                @endphp
                @if ($offline_method?->is_active)
                    <div class="relative -space-y-px rounded-md bg-white border border-gray-200 divide-y divide-gray-100 shadow-sm dark:bg-zinc-800 dark:border-zinc-700 dark:divide-zinc-700">
                            <label wire:key="payment-method-offline" class="rounded-md relative p-4 flex flex-col cursor-pointer md:ltr:pl-4 md:rtl:pr-4 md:ltr:pr-6 md:rtl:pl-6 md:grid md:grid-cols-2 focus:outline-none" :class="selected_method == 'offline' ? 'bg-primary-50 border-primary-200 dark:bg-zinc-700 dark:border-zinc-700' : 'border-gray-200 hover:bg-gray-50 dark:hover:bg-zinc-600'">

                                {{-- Title --}}
                                <span class="flex items-center text-sm">
                                    <input type="radio" x-model="selected_method" wire:model.live="selected_method" name="selected_method" value="offline" class="h-5 w-5 text-primary-600 border-gray-300 focus:ring-0 focus:outline-none focus:ring-transparent focus:ring-offset-0 dark:bg-zinc-700 dark:border-zinc-700" />
                                    <span class="ltr:ml-3 rtl:mr-3 font-medium whitespace-nowrap" :class="selected_method == 'offline' ? 'text-primary-600 dark:text-white' : 'text-zinc-800 dark:text-zinc-200'">
                                        {{ $offline_method->name }}
                                    </span>
                                </span>

                                {{-- Logo --}}
                                @if ($offline_method->logo)
                                    <span class="flex items-center">
                                        <img class="w-auto h-6 ltr:ml-auto rtl:mr-auto rounded" src="{{ src($offline_method->logo) }}" alt="{{ $offline_method->name }}">
                                    </span>
                                @endif


                            </label>
                    </div>
                @endif

                {{-- wallet --}}
                @php
                    $wallet = convertToNumber(auth()->user()->balance_available);
                @endphp
                @if ($wallet >= $subscription->total)
                    <div class="mt-4 relative -space-y-px rounded-md bg-white border border-gray-200 divide-y divide-gray-100 shadow-sm dark:bg-zinc-800 dark:border-zinc-700 dark:divide-zinc-700">
                        <label wire:key="payment-method-wallet" class="items-center rounded-md relative p-4 flex flex-col cursor-pointer md:ltr:pl-4 md:rtl:pr-4 md:ltr:pr-6 md:rtl:pl-6 md:grid md:grid-cols-2 focus:outline-none" :class="selected_method == 'wallet' ? 'bg-primary-50 border-primary-200 dark:bg-zinc-700 dark:border-zinc-700' : 'border-gray-200 hover:bg-gray-50 dark:hover:bg-zinc-600'">

                            {{-- Title --}}
                            <span class="flex items-center text-sm">
                                <input type="radio" x-model="selected_method" wire:model.live="selected_method" name="selected_method" value="wallet" class="h-5 w-5 text-primary-600 border-gray-300 focus:ring-0 focus:outline-none focus:ring-transparent focus:ring-offset-0 dark:bg-zinc-700 dark:border-zinc-700" />
                                <span class="ltr:ml-3 rtl:mr-3 font-medium whitespace-nowrap" :class="selected_method == 'wallet' ? 'text-primary-600 dark:text-white' : 'text-zinc-800 dark:text-zinc-200'">
                                    @lang('messages.t_wallet')
                                </span>
                            </span>

                            {{-- Available amount --}}
                            <span class="text-right text-xs font-semibold text-black tracking-wide">
                                {{ money($wallet, settings('currency')->code, true) }}
                            </span>

                        </label>
                    </div>
                @endif

            </fieldset>

            {{-- Order summary --}}
            <div class="lg:ltr:pl-10 lg:rtl:pr-10">

                {{-- Step title --}}
                <div class="flex items-center lg:justify-center rtl:space-x-reverse space-x-2 mb-10">
                    <svg class="h-6 w-6 -mt-px dark:text-gray-200" stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 256 256" xmlns="http://www.w3.org/2000/svg"><path d="M216,48V208a8,8,0,0,1-8,8H48a8,8,0,0,1-8-8V48a8,8,0,0,1,8-8H208A8,8,0,0,1,216,48Z" opacity="0.2"></path><path d="M208,32H48A16,16,0,0,0,32,48V208a16,16,0,0,0,16,16H208a16,16,0,0,0,16-16V48A16,16,0,0,0,208,32Zm0,176H48V48H208V208Zm-48-32a8,8,0,0,1-8,8H104a8,8,0,0,1-6.4-12.8l43.17-57.56a16,16,0,1,0-27.86-15,8,8,0,0,1-15.09-5.34,32.43,32.43,0,0,1,4.62-8.59,32,32,0,1,1,51.11,38.52L120,168h32A8,8,0,0,1,160,176Z"></path></svg>
                    <span class="text-base font-bold text-slate-500 tracking-wide dark:text-zinc-300">
                        @lang('messages.t_order_summary')
                    </span>
                </div>

                {{-- Order details --}}
                <div class="w-full mb-8">

                    {{-- Order summary --}}
                    <div class="bg-gray-100 hover:bg-gray-200 hover:bg-opacity-50 py-6 px-5 rounded-xl space-y-6 dark:bg-zinc-800 mt-4">

                        {{-- Get payment method --}}
                        @php

                            // Get payment gateway details
                            if ($selected_method === "offline") {
                                $payment_gateway  = payment_gateway($selected_method, false, true);
                            } else {
                                $payment_gateway = payment_gateway($selected_method);
                            }

                            // Get currency
                            $payment_currency = !empty($payment_gateway->currency) ? $payment_gateway->currency : null;

                        @endphp

                        {{-- Subtotal --}}
                        <div class="flex items-center space-x-3 rtl:space-x-reverse">
                            <div class="grow">
                                <p class="text-sm text-gray-500 dark:text-zinc-400 font-light">
                                    @lang('messages.t_subtotal')
                                </p>
                            </div>
                            <div class="flex-none text-sm ltr:text-right rtl:text-left font-semibold text-zinc-700 dark:text-zinc-200">
                                {{ money($subscription->total, settings('currency')->code, true) }}
                            </div>
                        </div>

                        {{-- Fee --}}
                        <div class="flex items-center space-x-3 rtl:space-x-reverse">
                            <div class="grow">
                                <p class="text-sm text-gray-500 dark:text-zinc-400 font-light">
                                    @lang('messages.t_fee')
                                </p>
                            </div>
                            <div class="flex-none text-sm ltr:text-right rtl:text-left font-semibold text-zinc-700 dark:text-zinc-200">
                                @if ($fee_value)
                                    {{ $fee_text }}
                                @else
                                    -
                                @endif
                            </div>
                        </div>

                    </div>

                    {{-- Order total --}}
                    <div class="flex items-center space-x-3 rtl:space-x-reverse bg-gray-100 hover:bg-gray-200 hover:bg-opacity-50 py-4 px-5 rounded-xl dark:bg-zinc-800 mt-4">
                        <div class="grow">
                            <p class="text-sm text-gray-500 dark:text-zinc-400 font-light">
                                @lang('messages.t_total')
                            </p>
                        </div>
                        <div class="flex-none text-sm ltr:text-right rtl:text-left font-semibold text-zinc-700 dark:text-zinc-200">
                            {{ money($subscription->total + $fee_value, settings('currency')->code, true) }}
                        </div>
                    </div>

                    {{-- Exchange rate --}}
                    @if ( $payment_currency && is_array( config('money.' . $payment_currency) ) && !empty( $payment_gateway->exchange_rate ) && $payment_gateway->exchange_rate != settings('currency')->exchange_rate )
                        <div class="flex items-center space-x-3 rtl:space-x-reverse bg-gray-100 hover:bg-gray-200 hover:bg-opacity-50 py-4 px-5 rounded-xl dark:bg-zinc-800 mt-4">
                            <div class="grow">
                                <p class="text-sm text-gray-500 dark:text-zinc-400 font-light">
                                    @lang('messages.t_exchange_rate')
                                </p>
                            </div>
                            <div class="flex-none text-sm ltr:text-right rtl:text-left font-semibold text-zinc-700 dark:text-zinc-200">
                                {{ money( ($subscription->total + $fee_value) * $payment_gateway->exchange_rate / settings('currency')->exchange_rate, $payment_currency, true ) }}
                            </div>
                        </div>
                    @endif

                </div>

                {{-- Check if no thrid step is set --}}
                @if (!$is_third_step)

                    {{-- Confirm --}}
                    <button wire:click="confirm" wire:loading.class.remove="bg-primary-600 hover:bg-primary-700 text-white cursor-pointer" wire:loading.attr="disabled" class="w-full text-[13px] font-semibold flex justify-center bg-primary-600 hover:bg-primary-700 text-white py-4 px-8 rounded tracking-wide focus:outline-none focus:shadow-outline cursor-pointer disabled:!bg-gray-200 disabled:!text-gray-600 disabled:cursor-not-allowed dark:disabled:!bg-zinc-700 dark:disabled:!text-zinc-400" {{ !$selected_method ? "disabled" : "" }}>
                        {{ __('messages.t_confirm') }}
                    </button>

                @endif

                {{-- Third step --}}
                @if ($is_third_step)
                    <div class="w-full">

                        {{-- PayPal --}}
                        @if ($selected_method === 'paypal' && isset($payment_gateway_params['paypal']))
                            <div class="w-full">

                                {{-- Paypal button --}}
                                <div id="paypal-button-container" wire:ignore></div>

                            </div>
                        @endif

                        {{-- cPay --}}
                        @if ($selected_method === 'cpay' && isset($payment_gateway_params['cpay']))
                            <div class="w-full">
                                <form method="post" action="https://www.cpay.com.mk/client/Page/default.aspx?xml_id=/mk-MK/.loginToPay/.simple/">

                                    <input id="AmountToPay" name="AmountToPay" value="{{ $payment_gateway_params['cpay']['AmountToPay'] }}" type="hidden" />
                                    <input id="PayToMerchant" name="PayToMerchant" value="{{ $payment_gateway_params['cpay']['PayToMerchant'] }}" type="hidden" />
                                    <input id="MerchantName" name="MerchantName" value="{{ $payment_gateway_params['cpay']['MerchantName'] }}" type="hidden" />
                                    <input id="AmountCurrency" name="AmountCurrency" value="{{ $payment_gateway_params['cpay']['AmountCurrency'] }}" type="hidden" />
                                    <input id="Details1" name="Details1" value="{{ $payment_gateway_params['cpay']['Details1'] }}" type="hidden" />
                                    <input id="Details2" name="Details2" value="{{ $payment_gateway_params['cpay']['Details2'] }}" type="hidden" />
                                    <input id="PaymentOKURL" name="PaymentOKURL" value="{{ $payment_gateway_params['cpay']['PaymentOKURL'] }}" type="hidden" />
                                    <input id="PaymentFailURL" name="PaymentFailURL" value="{{ $payment_gateway_params['cpay']['PaymentFailURL'] }}" type="hidden" />
                                    <input id="CheckSumHeader" name="CheckSumHeader" value="{{ $payment_gateway_params['cpay']['CheckSumHeader'] }}" type="hidden" />
                                    <input id="CheckSum" name="CheckSum" value="{{ $payment_gateway_params['cpay']['CheckSum'] }}" type="hidden" />
                                    <input id="FirstName" name="FirstName" value="{{ $payment_gateway_params['cpay']['FirstName'] }}" type="hidden" />
                                    <input id="LastName" name="LastName" value="{{ $payment_gateway_params['cpay']['LastName'] }}" type="hidden" />
                                    <input id="Address" name="Address" value="{{ $payment_gateway_params['cpay']['Address'] }}" type="hidden" />
                                    <input id="City" name="City" value="{{ $payment_gateway_params['cpay']['City'] }}" type="hidden" />
                                    <input id="Zip" name="Zip" value="{{ $payment_gateway_params['cpay']['Zip'] }}" type="hidden" />
                                    <input id="Telephone" name="Telephone" value="{{ $payment_gateway_params['cpay']['Telephone'] }}" type="hidden" />
                                    <input id="Email" name="Email" value="{{ $payment_gateway_params['cpay']['Email'] }}" type="hidden" />
                                    <input id="OriginalAmount" name="OriginalAmount" value="{{ $payment_gateway_params['cpay']['OriginalAmount'] }}" type="hidden" />

                                    <button type="submit" class="w-full text-[13px] font-semibold flex justify-center bg-primary-600 hover:bg-primary-700 text-white py-4 px-8 rounded tracking-wide focus:outline-none focus:shadow-outline cursor-pointer disabled:!bg-gray-200 disabled:!text-gray-600 disabled:cursor-not-allowed dark:disabled:!bg-zinc-700 dark:disabled:!text-zinc-400">
                                        {{ __('messages.t_checkout') }}
                                    </button>

                                </form>
                            </div>
                        @endif

                        {{-- Ecpay --}}
                        @if ($selected_method === 'ecpay' && isset($payment_gateway_params['ecpay']))
                            <div class="w-full">
                                <form method="post" action="{{ $payment_gateway_params['ecpay']['link'] }}">

                                    @foreach ($payment_gateway_params['ecpay'] as $key => $value)
                                        <input id="{{ $key }}" name="{{ $key }}" value="{{ $value }}" type="hidden" />
                                    @endforeach

                                    <button type="submit" class="w-full text-[13px] font-semibold flex justify-center bg-primary-600 hover:bg-primary-700 text-white py-4 px-8 rounded tracking-wide focus:outline-none focus:shadow-outline cursor-pointer disabled:!bg-gray-200 disabled:!text-gray-600 disabled:cursor-not-allowed dark:disabled:!bg-zinc-700 dark:disabled:!text-zinc-400">
                                        {{ __('messages.t_checkout') }}
                                    </button>

                                </form>
                            </div>
                        @endif

                        {{-- Flutterwave --}}
                        @if ($selected_method === 'flutterwave' && isset($payment_gateway_params['flutterwave']))
                            <div class="w-full">

                                {{-- Pay --}}
                                <button @click="window.makeFlutterwavePayment" type="button" id="flutterwave-payment-button" class="w-full text-[13px] font-semibold flex justify-center bg-primary-600 hover:bg-primary-700 text-white py-4 px-8 rounded tracking-wide focus:outline-none focus:shadow-outline cursor-pointer disabled:!bg-gray-200 disabled:!text-gray-600 disabled:cursor-not-allowed dark:disabled:!bg-zinc-700 dark:disabled:!text-zinc-400">
                                    {{ __('messages.t_checkout') }}
                                </button>

                            </div>
                        @endif

                        {{-- Jazzcash --}}
                        @if ($selected_method === 'jazzcash' && isset($payment_gateway_params['jazzcash']))
                            <div class="w-full">
                                <form method="post" action="{{ $payment_gateway_params['jazzcash']['link'] }}">

                                    @foreach ($payment_gateway_params['jazzcash'] as $key => $value)
                                        <input id="{{ $key }}" name="{{ $key }}" value="{{ $value }}" type="hidden" />
                                    @endforeach

                                    <button type="submit" class="w-full text-[13px] font-semibold flex justify-center bg-primary-600 hover:bg-primary-700 text-white py-4 px-8 rounded tracking-wide focus:outline-none focus:shadow-outline cursor-pointer disabled:!bg-gray-200 disabled:!text-gray-600 disabled:cursor-not-allowed dark:disabled:!bg-zinc-700 dark:disabled:!text-zinc-400">
                                        {{ __('messages.t_checkout') }}
                                    </button>

                                </form>
                            </div>
                        @endif

                        {{-- Mercadopago --}}
                        @if ($selected_method === 'mercadopago' && isset($payment_gateway_params['mercadopago']))
                            <div class="w-full">

                                {{-- Form --}}
                                <div class="w-full relative">

                                    {{-- Loading --}}
                                    <div class="bg-gray-50 dark:bg-zinc-700 absolute w-full p-6 rounded-xl flex items-center justify-center" id="mercadopago-waiting">
                                        <div role="status">
                                            <svg aria-hidden="true" class="mb-1 w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-primary-600 mx-auto" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                                            </svg>
                                            <span class="text-xs font-bold tracking-widest text-gray-500 dark:text-gray-200">{{ __('messages.t_please_wait_dots') }}</span>
                                        </div>
                                    </div>

                                    {{-- Form --}}
                                    <div id="walletBrick_container"></div>

                                </div>

                            </div>
                        @endif

                        {{-- Paymob --}}
                        @if ($selected_method === 'paymob' && isset($payment_gateway_params['paymob']))
                            <div class="w-full">
                                <iframe src="https://accept.paymobsolutions.com/api/acceptance/iframes/{{ payment_method('paymob')?->settings['iframe_id'] }}?payment_token={{ $payment_gateway_params['paymob']['token'] }}" width="100%" height="500px"></iframe>
                            </div>
                        @endif

                        {{-- Paymob PK --}}
                        @if ($selected_method === 'paymob-pk' && isset($payment_gateway_params['paymob-pk']))
                            <div class="w-full">
                                <iframe src="https://pakistan.paymob.com/api/acceptance/iframes/{{ payment_method('paymob')?->settings['iframe_id'] }}?payment_token={{ $payment_gateway_params['paymob']['token'] }}" width="100%" height="500px"></iframe>
                            </div>
                        @endif

                        {{-- Paystack --}}
                        @if ($selected_method === 'paystack' && isset($payment_gateway_params['paystack']))
                            <div class="w-full">

                                {{-- Pay --}}
                                <button @click="window.makePaystackPayment" type="button" id="paystack-payment-button" class="w-full text-[13px] font-semibold flex justify-center bg-primary-600 hover:bg-primary-700 text-white py-4 px-8 rounded tracking-wide focus:outline-none focus:shadow-outline cursor-pointer disabled:!bg-gray-200 disabled:!text-gray-600 disabled:cursor-not-allowed dark:disabled:!bg-zinc-700 dark:disabled:!text-zinc-400">
                                    {{ __('messages.t_checkout') }}
                                </button>

                            </div>
                        @endif

                        {{-- Paytr --}}
                        @if ($selected_method === 'paytr' && isset($payment_gateway_params['paytr']))
                            <div class="w-full">
                                <iframe src="https://www.paytr.com/odeme/guvenli/{{ $payment_gateway_params['paytr']['token'] }}" id="paytriframe" frameborder="0" scrolling="yes" style="width: 100%;" height="600px"></iframe>
                            </div>
                        @endif

                        {{-- Razorpay --}}
                        @if ($selected_method === 'razorpay' && isset($payment_gateway_params['razorpay']))
                            <div class="w-full">

                                {{-- Payment button --}}
                                <button @click="window.makeRazorpayPayment" type="button" id="razorpay-payment-button" class="w-full text-[13px] font-semibold flex justify-center bg-primary-600 hover:bg-primary-700 text-white py-4 px-8 rounded tracking-wide focus:outline-none focus:shadow-outline cursor-pointer disabled:!bg-gray-200 disabled:!text-gray-600 disabled:cursor-not-allowed dark:disabled:!bg-zinc-700 dark:disabled:!text-zinc-400">
                                    {{ __('messages.t_checkout') }}
                                </button>

                            </div>
                        @endif

                        {{-- Stripe --}}
                        @if ($selected_method === 'stripe' && isset($payment_gateway_params['stripe']))
                            <div class="w-full">

                                {{-- Form --}}
                                <form id="stripe-payment-form" wire:ignore>

                                    {{-- Stripe form --}}
                                    <div id="stripe-payment-element"></div>

                                    <div id="address-element"></div>

                                    {{-- Pay --}}
                                    <button id="stripe-payment-button" type="submit" class="w-full text-[13px] font-semibold flex justify-center bg-primary-600 hover:bg-primary-700 text-white py-4 px-8 rounded tracking-wide focus:outline-none focus:shadow-outline cursor-pointer disabled:!bg-gray-200 disabled:!text-gray-600 disabled:cursor-not-allowed dark:disabled:!bg-zinc-700 dark:disabled:!text-zinc-400">
                                        {{ __('messages.t_checkout') }}
                                    </button>

                                </form>

                            </div>
                        @endif

                        {{-- Offline --}}
                        @if ($selected_method === 'offline' && $offline_method?->is_active)
                            <div class="w-full">

                                {{-- Details --}}
                                <div class="w-full mb-8 text-sm text-gray-500 tracking-wide font-normal">
                                    {!! $offline_method?->details !!}
                                </div>

                                {{-- Submit --}}
                                <button wire:click="offline" wire:loading.class.remove="bg-primary-600 hover:bg-primary-700 text-white cursor-pointer" wire:loading.attr="disabled" class="w-full text-[13px] font-semibold flex justify-center bg-primary-600 hover:bg-primary-700 text-white py-4 px-8 rounded tracking-wide focus:outline-none focus:shadow-outline cursor-pointer disabled:!bg-gray-200 disabled:!text-gray-600 disabled:cursor-not-allowed dark:disabled:!bg-zinc-700 dark:disabled:!text-zinc-400">
                                    {{ __('messages.t_checkout') }}
                                </button>

                            </div>
                        @endif

                    </div>
                @endif

                {{-- Checkout footer --}}
                <div class="flex-col font-medium grid md:flex mt-4 space-y-4 text-gray-500 text-xs items-center">

                    {{-- Secure transaction --}}
                    <div class="flex items-center space-x-1 rtl:space-x-reverse text-green-500 dark:text-green-400">
                        <svg class="w-3.5 h-3.5" stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 256 256" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M208,80H176V56a48,48,0,0,0-96,0V80H48A16,16,0,0,0,32,96V208a16,16,0,0,0,16,16H208a16,16,0,0,0,16-16V96A16,16,0,0,0,208,80Zm-80,84a12,12,0,1,1,12-12A12,12,0,0,1,128,164Zm32-84H96V56a32,32,0,0,1,64,0Z"></path></svg>
                        <span class="whitespace-nowrap">@lang('messages.t_ur_transaction_is_secure')</span>
                    </div>

                    {{-- Pages --}}
                    <div class="flex rtl:space-x-reverse space-x-3">

                        @if (settings('footer')->terms)

                            {{-- Terms of service --}}
                            <a href="{{ url('page', settings('footer')->terms?->slug) }}" class="text-gray-500 hover:text-gray-900 dark:text-gray-300 dark:hover:text-gray-100 whitespace-nowrap">
                                {{ settings('footer')->terms?->title }}
                            </a>

                        @endif

                        @if (settings('footer')->privacy)

                            {{-- Divider --}}
                            <span class="mx-1 text-gray-200 dark:text-zinc-600 hidden md:block">|</span>

                            {{-- Privacy policy --}}
                            <a href="{{ url('page', settings('footer')->privacy?->slug) }}" class="text-gray-500 hover:text-gray-900 dark:text-gray-300 dark:hover:text-gray-100 whitespace-nowrap">
                                {{ settings('footer')->privacy?->title }}
                            </a>

                        @endif

                    </div>

                </div>

            </div>

        </div>

        {{-- Upgrades modal --}}
        <x-forms.modal id="modal-upgrades-container-{{ $subscription->uid }}" target="modal-upgrades-button-{{ $subscription->uid }}" uid="modal_{{ uid() }}" placement="center-center" size="max-w-xl">

            {{-- Modal heading --}}
            <x-slot name="title">@lang('messages.t_selected_upgrades')</x-slot>

            {{-- Modal content --}}
            <x-slot name="content">
                <div class="col-span-4 divide-y divide-gray-50 dark:divide-zinc-700 text-sm">

                    {{-- Urgent plan --}}
                    @if ($subscription->project->is_urgent)
                        @php
                            $urgent = \App\Models\ProjectPlan::whereType('urgent')->first();
                        @endphp
                        @if ($urgent)
                            <div class="pb-4 flex items-center justify-between">
                                <dt class="text-gray-600 dark:text-zinc-300">
                                    <span class="font-semibold px-3 py-1 rounded-sm text-[13px] tracking-wide dark:!bg-zinc-500 dark:!text-zinc-200" style="color: {{ $urgent->badge_text_color }};background-color: {{ $urgent->badge_bg_color }}">{{ $urgent->title }}</span>
                                    <p class="text-[13px] mt-2">{{ $urgent->description }}</p>
                                </dt>
                                <dd class="font-medium text-gray-900 dark:text-zinc-100 ltr:pl-5 rtl:pr-5 whitespace-nowrap">
                                    {{ money($urgent->price, settings('currency')->code, true) }}
                                </dd>
                            </div>
                        @endif
                    @endif

                    {{-- Highlight plan --}}
                    @if ($subscription->project->is_highlighted)
                        @php
                            $highlight = \App\Models\ProjectPlan::whereType('highlight')->first();
                        @endphp
                        @if ($highlight)
                            <div class="py-4 flex items-center justify-between">
                                <dt class="text-gray-600 dark:text-zinc-300">
                                    <span class="font-semibold px-3 py-1 rounded-sm text-[13px] tracking-wide dark:!bg-zinc-500 dark:!text-zinc-200" style="color: {{ $highlight->badge_text_color }};background-color: {{ $highlight->badge_bg_color }}">{{ $highlight->title }}</span>
                                    <p class="text-[13px] mt-2">{{ $highlight->description }}</p>
                                </dt>
                                <dd class="font-medium text-gray-900 dark:text-zinc-100 ltr:pl-5 rtl:pr-5 whitespace-nowrap">
                                    {{ money($highlight->price, settings('currency')->code, true) }}
                                </dd>
                            </div>
                        @endif
                    @endif

                    {{-- Featured plan --}}
                    @if ($subscription->project->is_featured)
                        @php
                            $featured = \App\Models\ProjectPlan::whereType('featured')->first();
                        @endphp
                        @if ($featured)
                            <div class="py-4 flex items-center justify-between">
                                <dt class="text-gray-600 dark:text-zinc-300">
                                    <span class="font-semibold px-3 py-1 rounded-sm text-[13px] tracking-wide dark:!bg-zinc-500 dark:!text-zinc-200" style="color: {{ $featured->badge_text_color }};background-color: {{ $featured->badge_bg_color }}">{{ $featured->title }}</span>
                                    <p class="text-[13px] mt-2">{{ $featured->description }}</p>
                                </dt>
                                <dd class="font-medium text-gray-900 dark:text-zinc-100 ltr:pl-5 rtl:pr-5 whitespace-nowrap">
                                    {{ money($featured->price, settings('currency')->code, true) }}
                                </dd>
                            </div>
                        @endif
                    @endif

                    {{-- Alert plan --}}
                    @if ($subscription->project->is_alert)
                        @php
                            $alert = \App\Models\ProjectPlan::whereType('alert')->first();
                        @endphp
                        @if ($alert)
                            <div class="py-4 flex items-center justify-between">
                                <dt class="text-gray-600 dark:text-zinc-300">
                                    <span class="font-semibold px-3 py-1 rounded-sm text-[13px] tracking-wide dark:!bg-zinc-500 dark:!text-zinc-200" style="color: {{ $alert->badge_text_color }};background-color: {{ $alert->badge_bg_color }}">{{ $alert->title }}</span>
                                    <p class="text-[13px] mt-2">{{ $alert->description }}</p>
                                </dt>
                                <dd class="font-medium text-gray-900 dark:text-zinc-100 ltr:pl-5 rtl:pr-5 whitespace-nowrap">
                                    {{ money($alert->price, settings('currency')->code, true) }}
                                </dd>
                            </div>
                        @endif
                    @endif

                    {{-- Total --}}
                    <div class="pt-4 flex items-center justify-between">
                        <dt class="font-medium text-gray-900 dark:text-white">@lang('messages.t_total')</dt>
                        <dd class="font-medium text-primary-600">
                            {{ money($subscription->total, settings('currency')->code, true) }}
                        </dd>
                    </div>

                </div>
            </x-slot>

        </x-forms.modal>

    </div>

</div>

@push('scripts')

    {{-- Events --}}
    <script>
        document.addEventListener('livewire:initialized', () => {

            // PayPal
            Livewire.on('checkout-paypal-order-event', ({ orderID }) => {
                setTimeout(function () {
                    paypal.Buttons({

                        // Set up the transaction
                        createOrder: function(data, actions) {
                            return actions.order.create({
                                purchase_units: [{
                                    invoice_id: orderID,
                                    amount    : {
                                        value: "{{ convertToNumber( number_format( $total * payment_gateway('paypal')?->exchange_rate / settings('currency')->exchange_rate, 2, '.', '' ) ) }}"
                                    }
                                }]
                            });
                        },

                        // Finalize the transaction
                        onApprove: function(data, actions) {

                            // Redirecting
                            location.href = "{{ url('callback/paypal?order=') }}" + data.orderID;

                        }

                        }).render('#paypal-button-container');
                }, 500)

            });

            // Flutterwave
            Livewire.on('checkout-flutterwave-order-event', ({ orderID }) => {
                window.makeFlutterwavePayment = function() {
                    FlutterwaveCheckout({
                        public_key     : "{{ payment_gateway('flutterwave')?->settings['public_key'] }}",
                        tx_ref         : orderID,
                        amount         : Number("{{ convertToNumber( number_format( $total * payment_gateway('flutterwave')?->exchange_rate / settings('currency')->exchange_rate, 2, '.', '' ) ) }}"),
                        currency       : "{{ payment_gateway('flutterwave')?->currency }}",
                        payment_options: "card, banktransfer, ussd, account, mpesa, mobilemoneyghana, mobilemoneyfranco, mobilemoneyuganda, mobilemoneyrwanda, mobilemoneyzambia, barter, nqr, credit",
                        redirect_url   : "{{ url('callback/flutterwave') }}",
                        customer       : {
                            email       : "{{ auth()->user()->email }}",
                            name        : "{{ auth()->user()->fullname ?? auth()->user()->username }}",
                        },
                        customizations: {
                            title      : "{{ __('messages.t_add_funds') }}",
                            logo       : "{{ src(auth()->user()->avatar) }}",
                        },
                    });
                }
            });

            // Mercadopago
            Livewire.on('checkout-mercadopago-order-event', ({ preferenceId }) => {
                setTimeout(function () {
                    const bricksBuilder     = mercadopago.bricks();
                    const renderWalletBrick = async (bricksBuilder) => {
                        const settings = {
                            initialization: {
                                preferenceId: preferenceId,
                            },
                            callbacks: {
                                onReady: () => {
                                    $('#mercadopago-waiting').hide();
                                },
                                onSubmit: () => {
                                    //
                                },
                                onError: (error) => {
                                    console.log(error);
                                },
                            },
                        };
                        window.walletBrickController = await bricksBuilder.create(
                            'wallet',
                            'walletBrick_container',
                            settings
                        );
                    };
                    renderWalletBrick(bricksBuilder);
                }, 500);
            });

            // Paystack
            Livewire.on('checkout-paystack-order-event', ({ orderID }) => {
                window.makePaystackPayment = function(){
                    let handler = PaystackPop.setup({
                        key     : "{{ payment_gateway('paystack')?->settings['public_key'] }}",
                        email   : '{{ auth()->user()->email }}',
                        amount  : Number("{{ convertToNumber( number_format( $total * payment_gateway('paystack')?->exchange_rate / settings('currency')->exchange_rate, 2, '.', '' ) ) }}") * 100,
                        currency: "{{ payment_gateway('paystack')?->currency }}",
                        ref     : orderID,
                        channels: ['card', 'bank', 'ussd', 'qr', 'mobile_money', 'bank_transfer'],
                        onClose : function(){},
                        callback: function(response){
                            location.href = response.redirecturl;
                        }
                    });
                    handler.openIframe();
                }
            });

            // Paytr
            Livewire.on('checkout-paytr-order-event', () => {
                setTimeout(function () {
                    iFrameResize({},'#paytriframe');
                }, 500);
            });

            // Razorpay
            Livewire.on('checkout-razorpay-order-event', ({ orderID }) => {
                window.makeRazorpayPayment = function() {

                    // Set options
                    var options = {
                        "key"        : "{{ payment_gateway('razorpay')?->settings['key_id'] }}",
                        "amount"     : "{{ convertToNumber( number_format( $total * payment_gateway('razorpay')?->exchange_rate / settings('currency')->exchange_rate, 2, '.', '' ) ) * 100 }}",
                        "currency"   : "{{ payment_gateway('razorpay')?->currency }}",
                        "order_id"   : orderID,
                        "name"       : "{{ auth()->user()->fullname ?? auth()->user()->username }}",
                        "description": "{{ __('messages.t_add_funds') }}",
                        "image"      : "{{ src(auth()->user()->avatar) }}",
                        "handler"    : function (response){

                            // Set main domain link
                            const app_link = "{{ url('callback/razorpay?action=P') }}";

                            // Redirect
                            location.href = app_link + "&payment_id=" + response.razorpay_payment_id + "&order_id=" + response.razorpay_order_id + "&signature=" + response.razorpay_signature;

                        },
                    };

                    // Start payment
                    var rzp1 = new Razorpay(options);

                    // On Failed
                    rzp1.on('payment.failed', function (response){
                        alert(response.error.description);
                    });

                    // Open modal
                    rzp1.open();

                }
            });

            // Stripe
            Livewire.on('checkout-stripe-order-event', ({ clientSecret }) => {
                setTimeout(function () {

                    // Stripe public key
                    const stripe = Stripe("{{ payment_gateway('stripe')?->settings['public_key'] }}");

                    // Payment options
                    const options = {
                        clientSecret: clientSecret,
                        appearance  : {
                            theme    : 'stripe',
                            variables: {
                                colorPrimaryText: '#fff',
                                colorBackground : "{{ current_theme() === 'enabled' ? '#333' : '#ffffff' }}",
                                colorText       : '#30313d',
                                colorDanger     : '#df1b41',
                                spacingUnit     : '6px',
                                borderRadius    : '3px'
                            }
                        },
                    };

                    const elements = stripe.elements(options);

                    // Create and mount the Payment Element
                    const paymentElement = elements.create('payment');
                    paymentElement.mount('#stripe-payment-element');
                    const addressElement = elements.create('address', { mode: 'shipping' });
                    addressElement.mount('#address-element');

                    const form = document.getElementById('stripe-payment-form');

                    form.addEventListener('submit', async (event) => {
                        event.preventDefault();
                        document.getElementById("stripe-payment-button").disabled = true;
                        await stripe.confirmPayment({
                            elements,
                            confirmParams: {
                                return_url: "{{ url('callback/stripe?action=P') }}",
                            },
                        }).then((response) => {

                            // Check if error
                            if (response.error) {
                                window.$wireui.notify({
                                    title      : "{{ __('messages.t_error') }}",
                                    description: response.error.message,
                                    icon       : 'error'
                                });
                            }

                            document.getElementById("stripe-payment-button").disabled = false;

                        }).catch((error) => {
                            window.$wireui.notify({
                                title      : "{{ __('messages.t_error') }}",
                                description: error.message,
                                icon       : 'error'
                            });

                            document.getElementById("stripe-payment-button").disabled = false;
                        });
                    });

                }, 500);
            });

        });
    </script>

@endpush

@push('styles')

    {{-- PayPal SDK --}}
    @if ( payment_gateway('paypal')?->is_active )
        <script src="https://www.paypal.com/sdk/js?client-id={{ payment_gateway('paypal')?->settings['client_id'] }}&currency={{ payment_gateway('paypal')?->currency }}"></script>
    @endif

    {{-- Mercadopago.js --}}
    @if (payment_gateway('mercadopago')?->is_active)
        <script src="https://sdk.mercadopago.com/js/v2"></script>
        <script>
            var mercadopago = new MercadoPago("{{ payment_gateway('mercadopago')?->settings['public_key'] }}");
        </script>
    @endif

    {{-- Flutterwave.js --}}
    @if (payment_gateway('flutterwave')?->is_active)
        <script src="https://checkout.flutterwave.com/v3.js"></script>
    @endif

    {{-- Razorpay.js --}}
    @if (payment_gateway('razorpay')?->is_active)
        <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    @endif

    {{-- Stripe.js --}}
    @if (payment_gateway('stripe')?->is_active)
        <script src="https://js.stripe.com/v3/"></script>
    @endif

    {{-- Paystack.js --}}
    @if (payment_gateway('paystack')?->is_active)
        <script src="https://js.paystack.co/v1/inline.js"></script>
    @endif

@endpush
