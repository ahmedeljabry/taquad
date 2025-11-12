<div>
    {{-- SEO --}}
    {!! SEO::generate(true) !!}

    {{-- Page Header --}}
    <div class="w-full mb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                {{ __('messages.t_my_contracts') }}
            </h1>
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                {{ __('messages.t_manage_your_contracts_and_offers') }}
            </p>
        </div>
    </div>

    {{-- Stats Cards --}}
    <div class="w-full mb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Active Contracts --}}
                <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl shadow-lg p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-blue-100">{{ __('messages.t_active_contracts') }}</p>
                            <p class="text-3xl font-bold mt-2">{{ $activeContracts }}</p>
                        </div>
                        <div class="bg-white/20 rounded-full p-3">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- Pending Offers --}}
                <div class="bg-gradient-to-br from-amber-500 to-amber-600 rounded-2xl shadow-lg p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-amber-100">{{ __('messages.t_pending_offers') }}</p>
                            <p class="text-3xl font-bold mt-2">{{ $pendingOffers }}</p>
                        </div>
                        <div class="bg-white/20 rounded-full p-3">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Tabs --}}
    <div class="w-full mb-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex space-x-2 overflow-x-auto border-b border-gray-200 dark:border-zinc-700">
                <button wire:click="setTab('offers')"
                        class="px-6 py-3 text-sm font-medium border-b-2 transition {{ $activeTab === 'offers' ? 'border-primary-600 text-primary-600' : 'border-transparent text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-200' }}">
                    {{ __('messages.t_offers') }} 
                    @if($pendingOffers > 0)
                        <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800">
                            {{ $pendingOffers }}
                        </span>
                    @endif
                </button>
                <button wire:click="setTab('active')"
                        class="px-6 py-3 text-sm font-medium border-b-2 transition {{ $activeTab === 'active' ? 'border-primary-600 text-primary-600' : 'border-transparent text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-200' }}">
                    {{ __('messages.t_active') }}
                </button>
                <button wire:click="setTab('paused')"
                        class="px-6 py-3 text-sm font-medium border-b-2 transition {{ $activeTab === 'paused' ? 'border-primary-600 text-primary-600' : 'border-transparent text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-200' }}">
                    {{ __('messages.t_paused') }}
                </button>
                <button wire:click="setTab('ended')"
                        class="px-6 py-3 text-sm font-medium border-b-2 transition {{ $activeTab === 'ended' ? 'border-primary-600 text-primary-600' : 'border-transparent text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-200' }}">
                    {{ __('messages.t_ended') }}
                </button>
            </div>
        </div>
    </div>

    {{-- Contracts List --}}
    <div class="w-full">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if ($contracts->isEmpty())
                <div class="text-center py-12">
                    <svg class="mx-auto h-24 w-24 text-gray-400 dark:text-zinc-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <h3 class="mt-4 text-lg font-medium text-gray-900 dark:text-white">
                        {{ $activeTab === 'offers' ? __('messages.t_no_offers_yet') : __('messages.t_no_contracts_yet') }}
                    </h3>
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                        {{ $activeTab === 'offers' ? __('messages.t_offers_will_appear_here') : __('messages.t_contracts_will_appear_here') }}
                    </p>
                </div>
            @else
                <div class="grid grid-cols-1 gap-6">
                    @foreach ($contracts as $contract)
                        <div class="bg-white dark:bg-zinc-800 rounded-2xl shadow-sm border border-gray-200 dark:border-zinc-700 hover:shadow-md transition overflow-hidden">
                            <div class="p-6">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        {{-- Project Title --}}
                                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                            {{ $contract->project->title ?? 'Untitled Project' }}
                                        </h3>

                                        {{-- Client Info --}}
                                        <div class="mt-2 flex items-center space-x-2 text-sm text-gray-600 dark:text-gray-400">
                                            <span>{{ __('messages.t_client') }}:</span>
                                            <a href="{{ url('profile/' . $contract->client->username) }}" 
                                               target="_blank"
                                               class="font-medium text-primary-600 hover:text-primary-700">
                                                {{ $contract->client->username }}
                                            </a>
                                        </div>

                                        {{-- Contract Details --}}
                                        <div class="mt-4 grid grid-cols-2 md:grid-cols-4 gap-4">
                                            <div>
                                                <p class="text-xs text-gray-500 dark:text-gray-400">{{ __('messages.t_hourly_rate') }}</p>
                                                <p class="text-lg font-bold text-gray-900 dark:text-white">
                                                    ${{ number_format($contract->hourly_rate, 2) }}<span class="text-sm text-gray-500">/hr</span>
                                                </p>
                                            </div>
                                            <div>
                                                <p class="text-xs text-gray-500 dark:text-gray-400">{{ __('messages.t_weekly_limit') }}</p>
                                                <p class="text-lg font-bold text-gray-900 dark:text-white">
                                                    {{ $contract->weekly_limit_hours ?? 'N/A' }} <span class="text-sm text-gray-500">hrs</span>
                                                </p>
                                            </div>
                                            <div>
                                                <p class="text-xs text-gray-500 dark:text-gray-400">{{ __('messages.t_manual_time') }}</p>
                                                <p class="text-lg font-bold {{ $contract->allow_manual_time ? 'text-green-600' : 'text-red-600' }}">
                                                    {{ $contract->allow_manual_time ? __('messages.t_yes') : __('messages.t_no') }}
                                                </p>
                                            </div>
                                            <div>
                                                <p class="text-xs text-gray-500 dark:text-gray-400">{{ __('messages.t_start_date') }}</p>
                                                <p class="text-sm font-medium text-gray-900 dark:text-white">
                                                    {{ $contract->starts_at ? $contract->starts_at->format('M d, Y') : 'N/A' }}
                                                </p>
                                            </div>
                                        </div>

                                        @if ($contract->notes)
                                            <div class="mt-4 p-3 bg-gray-50 dark:bg-zinc-900 rounded-lg">
                                                <p class="text-sm text-gray-700 dark:text-gray-300">{{ $contract->notes }}</p>
                                            </div>
                                        @endif
                                    </div>

                                    {{-- Status Badge --}}
                                    <div class="ml-4">
                                        @php
                                            $statusColors = [
                                                'offer_sent' => 'bg-amber-100 text-amber-800 dark:bg-amber-900 dark:text-amber-300',
                                                'active' => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300',
                                                'paused' => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300',
                                                'ended' => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300',
                                            ];
                                            $colorClass = $statusColors[$contract->status->value] ?? 'bg-gray-100 text-gray-800';
                                        @endphp
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $colorClass }}">
                                            {{ ucfirst(str_replace('_', ' ', $contract->status->value)) }}
                                        </span>
                                    </div>
                                </div>

                                {{-- Actions --}}
                                <div class="mt-6 flex items-center space-x-3 pt-4 border-t border-gray-200 dark:border-zinc-700">
                                    @if ($contract->status->value === 'offer_sent')
                                        <button wire:click="acceptOffer({{ $contract->id }})"
                                                class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 transition">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                            </svg>
                                            {{ __('messages.t_accept_offer') }}
                                        </button>
                                        <button wire:click="openDeclineModal({{ $contract->id }})"
                                                class="inline-flex items-center px-4 py-2 border border-red-300 dark:border-red-600 rounded-lg shadow-sm text-sm font-medium text-red-700 dark:text-red-400 bg-white dark:bg-zinc-800 hover:bg-red-50 dark:hover:bg-red-900/20 transition">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                            {{ __('messages.t_decline') }}
                                        </button>
                                    @elseif ($contract->status->value === 'active')
                                        <a href="{{ url('seller/projects/tracker/' . $contract->project->uid) }}"
                                           class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 transition">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            {{ __('messages.t_track_time') }}
                                        </a>
                                    @endif

                                    <a href="{{ url('account/projects/' . $contract->project->uid) }}"
                                       target="_blank"
                                       class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-zinc-600 rounded-lg shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-zinc-800 hover:bg-gray-50 dark:hover:bg-zinc-700 transition">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        {{ __('messages.t_view_project') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Pagination --}}
                <div class="mt-8">
                    {{ $contracts->links() }}
                </div>
            @endif
        </div>
    </div>

    {{-- Decline Offer Modal --}}
    <x-forms.modal id="decline-modal" target="open-decline-modal" size="max-w-lg">
        <x-slot name="title">{{ __('messages.t_decline_offer') }}</x-slot>
        <x-slot name="content">
            <div class="space-y-4">
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    {{ __('messages.t_decline_offer_confirmation') }}
                </p>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('messages.t_reason_optional') }}
                    </label>
                    <textarea wire:model="declineReason" rows="4"
                              class="w-full px-4 py-2 border border-gray-300 dark:border-zinc-600 rounded-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-zinc-800 dark:text-white"
                              placeholder="{{ __('messages.t_explain_why_declining') }}"></textarea>
                    @error('declineReason') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <div class="flex space-x-3">
                <button type="button" x-on:click="$dispatch('close-decline-modal')"
                        class="flex-1 inline-flex justify-center items-center px-6 py-3 border border-gray-300 dark:border-zinc-600 rounded-lg shadow-sm text-base font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-zinc-800 hover:bg-gray-50 dark:hover:bg-zinc-700 transition">
                    {{ __('messages.t_cancel') }}
                </button>
                <button type="button" wire:click="declineOffer"
                        class="flex-1 inline-flex justify-center items-center px-6 py-3 border border-transparent rounded-lg shadow-sm text-base font-medium text-white bg-red-600 hover:bg-red-700 transition">
                    {{ __('messages.t_decline_offer') }}
                </button>
            </div>
        </x-slot>
    </x-forms.modal>
</div>

