<div>
    {{-- SEO --}}
    {!! SEO::generate(true) !!}

    {{-- Page Title --}}
    <div class="w-full mb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                        {{ __('messages.t_manage_proposals') }}
                    </h1>
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                        {{ $project->title }}
                    </p>
                </div>
                <a href="{{ url('account/projects') }}" 
                   class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-zinc-600 rounded-lg text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-zinc-800 hover:bg-gray-50 dark:hover:bg-zinc-700 transition">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    {{ __('messages.t_back_to_projects') }}
                </a>
            </div>
        </div>
    </div>

    {{-- Status Filter --}}
    <div class="w-full mb-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex space-x-2 overflow-x-auto">
                <button wire:click="$set('statusFilter', 'all')"
                        class="px-4 py-2 rounded-lg text-sm font-medium transition {{ $statusFilter === 'all' ? 'bg-primary-600 text-white' : 'bg-gray-100 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-zinc-700' }}">
                    {{ __('messages.t_all') }}
                </button>
                <button wire:click="$set('statusFilter', 'submitted')"
                        class="px-4 py-2 rounded-lg text-sm font-medium transition {{ $statusFilter === 'submitted' ? 'bg-primary-600 text-white' : 'bg-gray-100 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-zinc-700' }}">
                    {{ __('messages.t_submitted') }}
                </button>
                <button wire:click="$set('statusFilter', 'shortlisted')"
                        class="px-4 py-2 rounded-lg text-sm font-medium transition {{ $statusFilter === 'shortlisted' ? 'bg-primary-600 text-white' : 'bg-gray-100 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-zinc-700' }}">
                    {{ __('messages.t_shortlisted') }}
                </button>
                <button wire:click="$set('statusFilter', 'accepted')"
                        class="px-4 py-2 rounded-lg text-sm font-medium transition {{ $statusFilter === 'accepted' ? 'bg-primary-600 text-white' : 'bg-gray-100 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-zinc-700' }}">
                    {{ __('messages.t_accepted') }}
                </button>
                <button wire:click="$set('statusFilter', 'rejected')"
                        class="px-4 py-2 rounded-lg text-sm font-medium transition {{ $statusFilter === 'rejected' ? 'bg-primary-600 text-white' : 'bg-gray-100 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-zinc-700' }}">
                    {{ __('messages.t_rejected') }}
                </button>
            </div>
        </div>
    </div>

    {{-- Proposals Grid --}}
    <div class="w-full">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if ($proposals->isEmpty())
                <div class="text-center py-12">
                    <svg class="mx-auto h-24 w-24 text-gray-400 dark:text-zinc-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <h3 class="mt-4 text-lg font-medium text-gray-900 dark:text-white">{{ __('messages.t_no_proposals_yet') }}</h3>
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">{{ __('messages.t_proposals_will_appear_here') }}</p>
                </div>
            @else
                <div class="grid grid-cols-1 gap-6">
                    @foreach ($proposals as $proposal)
                        <div class="bg-white dark:bg-zinc-800 rounded-2xl shadow-sm border border-gray-200 dark:border-zinc-700 hover:shadow-md transition overflow-hidden">
                            <div class="p-6">
                                <div class="flex items-start justify-between">
                                    {{-- Freelancer Info --}}
                                    <div class="flex items-start space-x-4 flex-1">
                                        <a href="{{ url('profile/' . $proposal->freelancer->username) }}" target="_blank">
                                            <img src="{{ $proposal->freelancer->avatar }}" 
                                                 alt="{{ $proposal->freelancer->username }}"
                                                 class="w-16 h-16 rounded-full object-cover border-2 border-gray-200 dark:border-zinc-700">
                                        </a>
                                        <div class="flex-1">
                                            <div class="flex items-center space-x-3">
                                                <a href="{{ url('profile/' . $proposal->freelancer->username) }}" 
                                                   target="_blank"
                                                   class="text-lg font-semibold text-gray-900 dark:text-white hover:text-primary-600 transition">
                                                    {{ $proposal->freelancer->username }}
                                                </a>
                                                @if ($proposal->freelancer->level)
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary-100 text-primary-800 dark:bg-primary-900 dark:text-primary-300">
                                                        {{ $proposal->freelancer->level->name }}
                                                    </span>
                                                @endif
                                            </div>
                                            
                                            {{-- Cover Letter --}}
                                            <div class="mt-3 text-sm text-gray-700 dark:text-gray-300 line-clamp-3">
                                                {{ $proposal->cover_letter }}
                                            </div>

                                            {{-- Proposed Rate --}}
                                            <div class="mt-4 flex items-center space-x-6">
                                                <div>
                                                    <span class="text-sm text-gray-600 dark:text-gray-400">{{ __('messages.t_hourly_rate') }}</span>
                                                    <div class="text-2xl font-bold text-gray-900 dark:text-white">
                                                        ${{ number_format($proposal->hourly_rate, 2) }}<span class="text-sm text-gray-500 dark:text-gray-400">/hr</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Status Badge --}}
                                    <div class="ml-4">
                                        @php
                                            $statusColors = [
                                                'submitted' => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300',
                                                'shortlisted' => 'bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-300',
                                                'accepted' => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300',
                                                'rejected' => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300',
                                            ];
                                            $colorClass = $statusColors[$proposal->status->value] ?? 'bg-gray-100 text-gray-800';
                                        @endphp
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $colorClass }}">
                                            {{ ucfirst($proposal->status->value) }}
                                        </span>
                                    </div>
                                </div>

                                {{-- Actions --}}
                                @if ($proposal->status->value === 'submitted' || $proposal->status->value === 'shortlisted')
                                    <div class="mt-6 flex items-center space-x-3 pt-4 border-t border-gray-200 dark:border-zinc-700">
                                        <button wire:click="openOfferModal({{ $proposal->id }})"
                                                class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            {{ __('messages.t_send_offer') }}
                                        </button>

                                        @if ($proposal->status->value === 'submitted')
                                            <button wire:click="shortlistProposal({{ $proposal->id }})"
                                                    class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-zinc-600 rounded-lg shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-zinc-800 hover:bg-gray-50 dark:hover:bg-zinc-700 transition">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                                                </svg>
                                                {{ __('messages.t_shortlist') }}
                                            </button>
                                        @endif

                                        <button wire:click="rejectProposal({{ $proposal->id }})"
                                                class="inline-flex items-center px-4 py-2 border border-red-300 dark:border-red-600 rounded-lg shadow-sm text-sm font-medium text-red-700 dark:text-red-400 bg-white dark:bg-zinc-800 hover:bg-red-50 dark:hover:bg-red-900/20 transition">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                            {{ __('messages.t_reject') }}
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Pagination --}}
                <div class="mt-8">
                    {{ $proposals->links() }}
                </div>
            @endif
        </div>
    </div>

    {{-- Send Offer Modal --}}
    <x-forms.modal id="offer-modal" target="open-offer-modal" size="max-w-2xl">
        <x-slot name="title">{{ __('messages.t_send_offer') }}</x-slot>
        <x-slot name="content">
            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('messages.t_hourly_rate') }} ($)
                    </label>
                    <input type="number" wire:model="offerRate" step="0.01" min="1"
                           class="w-full px-4 py-2 border border-gray-300 dark:border-zinc-600 rounded-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-zinc-800 dark:text-white">
                    @error('offerRate') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('messages.t_weekly_limit_hours') }}
                    </label>
                    <input type="number" wire:model="offerWeeklyLimit" step="1" min="1" max="168"
                           class="w-full px-4 py-2 border border-gray-300 dark:border-zinc-600 rounded-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-zinc-800 dark:text-white">
                    @error('offerWeeklyLimit') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div class="flex items-center">
                    <input type="checkbox" wire:model="offerAllowManual" id="offerAllowManual"
                           class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded">
                    <label for="offerAllowManual" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">
                        {{ __('messages.t_allow_manual_time_entries') }}
                    </label>
                </div>

                <div class="flex items-center">
                    <input type="checkbox" wire:model="offerAutoApprove" id="offerAutoApprove"
                           class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded">
                    <label for="offerAutoApprove" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">
                        {{ __('messages.t_auto_approve_low_activity') }}
                    </label>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('messages.t_message_optional') }}
                    </label>
                    <textarea wire:model="offerMessage" rows="4"
                              class="w-full px-4 py-2 border border-gray-300 dark:border-zinc-600 rounded-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-zinc-800 dark:text-white"></textarea>
                    @error('offerMessage') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <button type="button" wire:click="sendOffer"
                    class="w-full inline-flex justify-center items-center px-6 py-3 border border-transparent rounded-lg shadow-sm text-base font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition">
                {{ __('messages.t_send_offer') }}
            </button>
        </x-slot>
    </x-forms.modal>
</div>

