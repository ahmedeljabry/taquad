<div class="max-w-[1500px] mx-auto px-4 sm:px-6 lg:px-8 mt-[7rem] py-12 lg:pt-16 lg:pb-24">

    {{-- Loading --}}
    <x-forms.loading />

    {{-- Heading --}}
    <div class="lg:flex lg:items-center lg:justify-between mb-2 border-b-2 border-gray-100 dark:border-zinc-800 pb-6">

        <div class="min-w-0 flex-1">

            {{-- Section heading --}}
            <h2
                class="text-lg font-bold leading-7 text-zinc-700 dark:text-gray-50 sm:truncate sm:text-2xl sm:tracking-tight">
                @lang('messages.t_recent_articles')
            </h2>

            {{-- Breadcrumbs --}}
            <div class="mt-2 flex flex-col sm:flex-row sm:flex-wrap sm:space-x-6 rtl:space-x-reverse">
                <ol class="inline-flex items-center mb-3 space-x-1 md:space-x-3 md:rtl:space-x-reverse sm:mb-0">

                    {{-- Main home --}}
                    <li>
                        <div class="flex items-center">
                            <a href="{{ url('/') }}"
                                class="text-sm font-medium text-gray-700 hover:text-primary-600 dark:text-zinc-300 dark:hover:text-white">
                                @lang('messages.t_home')
                            </a>
                        </div>
                    </li>

                    {{-- Blog --}}
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg aria-hidden="true" class="w-4 h-4 text-gray-400 rtl:rotate-180" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="mx-1 text-sm font-medium text-gray-400 md:mx-2 dark:text-zinc-400">
                                @lang('messages.t_blog')
                            </span>
                        </div>
                    </li>

                </ol>
            </div>

            {{-- Subtitle --}}
            @if (settings('newsletter')->is_enabled)
                <p class="text-[0.9375rem] text-gray-400 dark:text-zinc-300 font-normal mt-3">
                    @lang('messages.t_sign_up_for_newsletter_subtitle')
                </p>
            @endif

        </div>

        {{-- Actions --}}
        @if (settings('newsletter')->is_enabled)
            <div class="mt-5 flex lg:mt-0 lg:ltr::ml-4 lg:rtl:mr-4 justify-between">

                {{-- Newsletter --}}
                <x-form wire:submit="subscribe" class="mt-6 flex flex-col lg:mt-0 lg:justify-end">

                    {{-- Email --}}
                    <div>
                        <x-forms.text-input required :placeholder="__('messages.t_email_address')" model="email"
                            type="email" icon="at" />
                    </div>

                    {{-- Submit --}}
                    <div class="mt-2 flex w-full flex-shrink-0 sm:inline-flex sm:w-auto">
                        <x-bladewind.button size="small" class="mx-auto block w-full !rounded-md !py-2" can_submit="true">
                            @lang('messages.t_nofity_me')
                        </x-bladewind.button>
                    </div>

                </x-form>

            </div>
        @endif

    </div>

    {{-- Articles --}}
    <div class="grid grid-cols-1 gap-5 lg:grid-cols-4 sm:grid-cols-2 pt-10">
        @foreach ($articles as $article)
            <div wire:key="blog-articles-{{ $article->uid }}"
                class="relative flex items-end justify-start w-full ltr:text-left rtl:text-right bg-center bg-cover h-96 bg-gray-500"
                style="background-image: url(&quot;{{ src($article->image) }}&quot;);">
                <div
                    class="absolute top-0 bottom-0 left-0 right-0 bg-gradient-to-b via-transparent from-gray-900 to-gray-900">
                </div>
                <div class="absolute top-0 left-0 right-0 flex items-center justify-between mx-5 mt-3">

                    {{-- Date --}}
                    <span class="py-2 text-xs font-light tracking-wider uppercase text-gray-100">
                        {{ format_date($article->created_at) }}
                    </span>

                </div>

                {{-- Title --}}
                <h2 class="z-10 p-5">
                    <a href="{{ url('blog', $article->slug) }}" class="font-medium text-sm hover:underline text-gray-100">
                        {{ $article->title }}
                    </a>
                </h2>

            </div>
        @endforeach
    </div>

    {{-- Pagination --}}
    @if ($articles->hasPages())
        <div class="w-full flex justify-center items-center mt-24">
            {!! $articles->links('pagination::tailwind') !!}
        </div>
    @endif

</div>