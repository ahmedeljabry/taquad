<div class="w-full">

    {{-- Loading --}}
    <x-forms.loading />

    {{-- Container --}}
    <div class="w-full">

        {{-- Empty state --}}
        <div class="max-w-4xl mx-auto mb-8">
            <div class="text-center">

                {{-- Icon --}}
                <div class="h-28 w-28 bg-slate-200 dark:bg-zinc-700 rounded-full flex items-center justify-center mx-auto">
                    <svg class="mx-auto h-12 w-12 dark:text-zinc-400" stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 256 256" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M96,188a28,28,0,1,1-28-28A28,28,0,0,1,96,188Z" opacity="0.2"></path><path d="M68,152a36,36,0,1,0,36,36A36,36,0,0,0,68,152Zm0,56a20,20,0,1,1,20-20A20,20,0,0,1,68,208ZM34.34,106.34,48.69,92,34.34,77.66A8,8,0,0,1,45.66,66.34L60,80.69,74.34,66.34A8,8,0,0,1,85.66,77.66L71.31,92l14.35,14.34a8,8,0,0,1-11.32,11.32L60,103.31,45.66,117.66a8,8,0,0,1-11.32-11.32Zm187.32,96a8,8,0,0,1-11.32,11.32L196,199.31l-14.34,14.35a8,8,0,0,1-11.32-11.32L184.69,188l-14.35-14.34a8,8,0,0,1,11.32-11.32L196,176.69l14.34-14.35a8,8,0,0,1,11.32,11.32L207.31,188Zm-45.19-89.51c-6.18,22.33-25.32,41.63-46.53,46.93a8.13,8.13,0,0,1-2,.24,8,8,0,0,1-1.93-15.76c15.63-3.91,30.35-18.91,35-35.68,3.19-11.5,3.22-29-14.71-46.9L144,59.31V80a8,8,0,0,1-16,0V40a8,8,0,0,1,8-8h40a8,8,0,0,1,0,16H155.31l2.35,2.34C175.9,68.59,182.58,90.78,176.47,112.83Z"></path></svg>
                </div>

                {{-- Texts --}}
                <h2 class="mt-4 text-base font-bold text-gray-700 dark:text-gray-100">{{ __('messages.t_promote_bid') }}</h2>

                {{-- TGo back to shopping cart --}}
                <p class="leading-relaxed text-gray-400 mt-1 text-sm">
                    @lang('messages.t_promote_bid_subtitle')
                </p>

            </div>
        </div>

        {{-- Bid preview --}}
        <div class="max-w-4xl mx-auto mb-16 h-fit relative">
            
            {{-- Bid card --}}
            <div class="rounded-lg bg-white shadow-sm border-gray-200 border relative mb-4 dark:bg-zinc-800 dark:shadow-none px-4 py-5 sm:px-6 {{ $subscription->bid->is_highlight ? 'ltr:border-l-8 rtl:border-l-8 border-amber-300 dark:border-zinc-600' : '' }}">
            
                {{-- Bid heading --}}
                <div class="flex items-center justify-between mb-8">
            
                    {{-- Freelancer profile --}}
                    <div class="flex items-center space-x-4 rtl:space-x-reverse">
            
                        {{-- Avatar --}}
                        <a href="{{ url('profile', $subscription->bid->user->username) }}" target="_blank" class="block">
                            <img class="rounded-full h-12 w-12 object-cover object-center" src="{{ src($subscription->bid->user->avatar) }}" alt="{{ $subscription->bid->user->username }}">
                        </a>
            
                        {{-- User info --}}
                        <div class="space-y-0.5">
            
                            <div class="flex items-center">
            
                                {{-- User fullname --}}
                                @if ($subscription->bid->user->fullname)
                                    <span class="font-medium text-zinc-900 text-sm hover:text-black dark:text-zinc-200 ltr:pr-1 rtl:pl-1">
                                        {{ $subscription->bid->user->fullname }}
                                    </span>
                                @endif
            
                                {{-- Username --}}
                                <a href="{{ url('profile', $subscription->bid->user->username) }}" class="font-medium text-gray-500 text-[13px] hover:text-primary-600 focus:text-primary-600 inline-flex items-center">
                                    <svg class="w-4 h-4" stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10c1.466 0 2.961-.371 4.442-1.104l-.885-1.793C14.353 19.698 13.156 20 12 20c-4.411 0-8-3.589-8-8s3.589-8 8-8 8 3.589 8 8v1c0 .692-.313 2-1.5 2-1.396 0-1.494-1.819-1.5-2V8h-2v.025A4.954 4.954 0 0 0 12 7c-2.757 0-5 2.243-5 5s2.243 5 5 5c1.45 0 2.748-.631 3.662-1.621.524.89 1.408 1.621 2.838 1.621 2.273 0 3.5-2.061 3.5-4v-1c0-5.514-4.486-10-10-10zm0 13c-1.654 0-3-1.346-3-3s1.346-3 3-3 3 1.346 3 3-1.346 3-3 3z"></path></svg>
                                    <span>{{ $subscription->bid->user->username }}</span>
                                </a>
            
                            </div>
            
                            {{-- User details --}}
                            <div class="flex items-center space-x-3 rtl:space-x-reverse text-[13px] dark:text-zinc-400">
            
                                {{-- Country --}}
                                @if ($subscription->bid->user->country)
                                    <p class="flex items-center space-x-1 rtl:space-x-reverse">
                                        <img class="h-4 ltr:pr-0.5 rtl:pl-0.5 -mt-0.5 lazy" src="{{ placeholder_img() }}" data-src="{{ countryFlag($subscription->bid->user->country->code) }}" alt="{{ $subscription->bid->user->country->name }}">
                                    </p>
            
                                    <div class="mx-2 my-0.5 text-gray-300 dark:text-zinc-600">|</div>
                                @endif
            
                                {{-- Rating --}}
                                <p class="flex shrink-0 items-center space-x-1 rtl:space-x-reverse">
                                    <svg aria-hidden="true" class="w-4 h-4 {{ $subscription->bid->user->rating() == 0 ? 'text-gray-400' : 'text-amber-500' }} -mt-0.5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                    <span>
                                        {{ $subscription->bid->user->rating() }}
                                    </span>
                                </p>
            
                                {{-- Verified account --}}
                                @if ($subscription->bid->user->status === 'verified')
                                    <div class="mx-2 my-0.5 text-gray-300 dark:text-zinc-600">|</div>
                                    <div class="flex shrink-0 items-center space-x-1 rtl:space-x-reverse">
                                        <svg class="w-4 h-4 text-blue-500 -mt-0.5" stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                        <span>@lang('messages.t_verified')</span>
                                    </div>
                                @endif
            
                            </div>
            
                        </div>
            
                    </div>
                    
                    {{-- Budget --}}
                    <div class="shrink-0">
                        <div class="flex items-center justify-between space-x-2 rtl:space-x-reverse">
        
                            {{-- Budget --}}
                            @if ($subscription->bid->amount && $subscription->bid->days)
                                <span class="flex items-center text-sm font-normal text-gray-500 dark:text-zinc-400 bg-gray-100 dark:bg-zinc-700 px-3 py-2 rounded-md">
                                    <span class="font-semibold text-zinc-800 dark:text-zinc-200">
                                        {{ money($subscription->bid->amount, settings('currency')->code, true) }}
                                    </span>
                                    <span class="mx-2">/</span>
                                    <div>
                                        @if ($subscription->bid->days === 1)
                                            {{ $subscription->bid->days }} {{ strtolower(__('messages.t_day')) }}
                                        @else
                                            {{ $subscription->bid->days }} {{ strtolower(__('messages.t_days')) }}
                                        @endif	
                                    </div>
                                </span>
                            @endif
        
                        </div>
                    </div>
                                
                </div>
                
                {{-- Bid message --}}
                @if ($subscription->bid->is_sealed)
                    <div class="flex flex-col items-center justify-between rounded-lg border border-slate-200 px-4 py-3 text-gray-500 sm:flex-row sm:px-5 dark:border-zinc-700 dark:text-zinc-400">
                        
                        {{-- Info --}}
                        <div class="flex items-center space-x-3 rtl:space-x-reverse">
                            <svg class="w-5 h-5 text-slate-400 flex-none ltr:-ml-2 rtl:-mr-2" stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zm0 18c-4.411 0-8-3.589-8-8s3.589-8 8-8 8 3.589 8 8-3.589 8-8 8z"></path><path d="M11 11h2v6h-2zm0-4h2v2h-2z"></path></svg>
                            <p class="text-sm">@lang('messages.t_this_bid_sealed_explain')</p>
                        </div>
            
                        {{-- Badge --}}
                        <span class="text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-0 font-medium rounded-full text-xs tracking-wide px-8 py-2 text-center ltr:ml-6 rtl:mr-6">
                            @lang('messages.t_sealed')
                        </span>
                        
                    </div>
                @else
                    <p class="mb-2 font-light text-sm leading-relaxed text-gray-500 dark:text-gray-400">
                        {!! nl2br($subscription->bid->message) !!}
                    </p>
                @endif
            
                {{-- Bid footer --}}
                <div class="mt-6 flex justify-between items-center">
                    <div class="space-x-2 rtl:space-x-reverse"></div>
            
                    <aside class="flex items-center mt-3 space-x-5 rtl:space-x-reverse text-xs text-gray-500 dark:text-zinc-300">
            
                        {{-- Sponsored --}}
                        @if ($subscription->bid->is_sponsored)
                            <div class="flex items-center space-x-1 rtl:space-x-reverse">
                                <svg class="w-4 h-4 text-gray-400" stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M11.219 3.375 8 7.399 4.781 3.375A1.002 1.002 0 0 0 3 4v15c0 1.103.897 2 2 2h14c1.103 0 2-.897 2-2V4a1.002 1.002 0 0 0-1.781-.625L16 7.399l-3.219-4.024c-.381-.474-1.181-.474-1.562 0zM5 19v-2h14.001v2H5zm10.219-9.375c.381.475 1.182.475 1.563 0L19 6.851 19.001 15H5V6.851l2.219 2.774c.381.475 1.182.475 1.563 0L12 5.601l3.219 4.024z"></path></svg>
                                <span>{{ __('messages.t_sponsored') }}</span>
                            </div>
                        @endif
            
                        {{-- Date --}}
                        <div class="flex items-center space-x-1 rtl:space-x-reverse">
                            <svg class="w-4 h-4 text-gray-400" stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12 4c-4.879 0-9 4.121-9 9s4.121 9 9 9 9-4.121 9-9-4.121-9-9-9zm0 16c-3.794 0-7-3.206-7-7s3.206-7 7-7 7 3.206 7 7-3.206 7-7 7z"></path><path d="M13 12V8h-2v6h6v-2zm4.284-8.293 1.412-1.416 3.01 3-1.413 1.417zm-10.586 0-2.99 2.999L2.29 5.294l2.99-3z"></path></svg>
                            <span>{{ format_date($subscription->bid->created_at, 'ago') }}</span>
                        </div>
            
                    </aside>
            
                </div>
            
            </div>
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
                @if ($wallet >= $subscription->amount)
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
                                {{ money($subscription->amount, settings('currency')->code, true) }}
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
                            {{ money($subscription->amount + $fee_value, settings('currency')->code, true) }}
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
                                {{ money( ($subscription->amount + $fee_value) * $payment_gateway->exchange_rate / settings('currency')->exchange_rate, $payment_currency, true ) }}
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
                <div class="divide-y divide-gray-100 dark:divide-zinc-700 text-sm">

                    {{-- Sponsored plan --}}
                    @if ($subscription->bid?->is_sponsored)
                        @php
                            $sponsored = \App\Models\ProjectBiddingPlan::wherePlanType('sponsored')->first();
                        @endphp
                        @if ($sponsored)
                            <div class="pb-4 flex items-center justify-between">
                                <dt class="text-gray-600 dark:text-zinc-300">
                                    <span class="font-semibold px-3 py-1 rounded-sm text-[13px] tracking-wide" style="color: {{ $sponsored->badge_text_color }};background-color: {{ $sponsored->badge_bg_color }}">
                                        {{ __('messages.t_' . $sponsored->plan_type) }}
                                    </span>
                                    <p class="text-[13px] mt-2">
                                        {{ __('messages.t_bidding_plan_' . $sponsored->plan_type . '_subtitle') }}
                                    </p>    
                                </dt>
                                <dd class="font-medium text-gray-900 ltr:pl-10 rtl:pr-10 dark:text-white">
                                    {{ money($sponsored->price, settings('currency')->code, true) }}
                                </dd>
                            </div>
                        @endif
                    @endif

                    {{-- Sealed plan --}}
                    @if ($subscription->bid?->is_sealed)
                        @php
                            $sealed = \App\Models\ProjectBiddingPlan::wherePlanType('sealed')->first();
                        @endphp
                        @if ($sealed)
                            <div class="py-4 flex items-center justify-between">
                                <dt class="text-gray-600 dark:text-zinc-300">
                                    <span class="font-semibold px-3 py-1 rounded-sm text-[13px] tracking-wide" style="color: {{ $sealed->badge_text_color }};background-color: {{ $sealed->badge_bg_color }}">
                                        {{ __('messages.t_' . $sealed->plan_type) }}
                                    </span>
                                    <p class="text-[13px] mt-2">
                                        {{ __('messages.t_bidding_plan_' . $sealed->plan_type . '_subtitle') }}
                                    </p>    
                                </dt>
                                <dd class="font-medium text-gray-900 ltr:pl-10 rtl:pr-10 dark:text-white">
                                    {{ money($sealed->price, settings('currency')->code, true) }}
                                </dd>
                            </div>
                        @endif
                    @endif

                    {{-- Highlight plan --}}
                    @if ($subscription->bid?->is_highlight)
                        @php
                            $highlight = \App\Models\ProjectBiddingPlan::wherePlanType('highlight')->first();
                        @endphp
                        @if ($highlight)
                            <div class="py-4 flex items-center justify-between">
                                <dt class="text-gray-600 dark:text-zinc-300">
                                    <span class="font-semibold px-3 py-1 rounded-sm text-[13px] tracking-wide" style="color: {{ $highlight->badge_text_color }};background-color: {{ $highlight->badge_bg_color }}">
                                        {{ __('messages.t_' . $highlight->plan_type) }}
                                    </span>
                                    <p class="text-[13px] mt-2">
                                        {{ __('messages.t_bidding_plan_' . $highlight->plan_type . '_subtitle') }}
                                    </p>    
                                </dt>
                                <dd class="font-medium text-gray-900 ltr:pl-10 rtl:pr-10 dark:text-white">
                                    {{ money($highlight->price, settings('currency')->code, true) }}
                                </dd>
                            </div>
                        @endif
                    @endif

                    {{-- Total --}}
                    <div class="pt-4 flex items-center justify-between">
                        <dt class="font-medium text-gray-900 dark:text-zinc-100">@lang('messages.t_total')</dt>
                        <dd class="font-medium text-primary-600">
                            {{ money($subscription->amount, settings('currency')->code, true) }}
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