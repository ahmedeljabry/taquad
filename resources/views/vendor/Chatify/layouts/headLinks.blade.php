	<meta name="id" content="{{ $id }}">
	<meta name="uid" content="{{ $uid }}">
	<meta name="type" content="{{ $type }}">
	<meta name="messenger-color" content="{{ $messengerColor }}">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="authenticated-user" data-user-uid="{{ auth()->user()->uid }}" />
	<meta name="url" content="{{ url('').'/'.config('chatify.routes.prefix') }}" data-user="{{ auth()->id() }}">
	<meta name="time-locale" content="{{ config()->get('frontend_timing_locale') }}" />
	<meta name="time-timezone" content="{{ config('app.timezone') }}" />
	<meta name="chatify-voice-enabled" content="{{ config('chatify.voice_notes.enabled') ? '1' : '0' }}">
	<meta name="chatify-voice-max" content="{{ config('chatify.voice_notes.max_seconds') }}">
	<meta name="chatify-voice-formats" content="{{ implode(',', config('chatify.voice_notes.formats')) }}">

	{{-- Styles --}}
	<link rel="stylesheet" href="{{ url('public/js/plugins/emojipanel/dist/emojipanel.css') }}" />
	<link rel="stylesheet" href="{{ url('public/js/plugins/file-icon-vectors/file-icon-vectors.min.css') }}" />
	<link rel='stylesheet' href="{{ url('public/js/plugins/nprogress/nprogress.css') }}" />
	<link rel="stylesheet" href="{{ url('public/css/chatify/style.css') }}" />
	<link rel="stylesheet" href="{{ url('public/css/chatify/'.$dark_mode.'.mode.css') }}" />

	{{-- Messenger Color Style--}}
	@include('Chatify::layouts.messengerColor')

	{{-- Custom css --}}
	<style>
		:root {
			--color-primary-h: {{ hex2hsl( settings('appearance')->colors['primary'] )[0] }};
			--color-primary-s: {{ hex2hsl( settings('appearance')->colors['primary'] )[1] }}%;
			--color-primary-l: {{ hex2hsl( settings('appearance')->colors['primary'] )[2] }}%;
			--chatify-gradient-start: rgba(59, 130, 246, 0.16);
			--chatify-gradient-end: rgba(14, 165, 233, 0.12);
			--chatify-glass-light: rgba(255, 255, 255, 0.82);
			--chatify-glass-dark: rgba(39, 39, 42, 0.78);
			--chatify-border-light: rgba(148, 163, 184, 0.18);
			--chatify-border-dark: rgba(63, 63, 70, 0.45);
		}
		html {
			font-family: @php echo settings('appearance')->font_family @endphp, sans-serif !important;
		}
		img.twemoji, img.emoji {
			height: 1.5em;
			width: 1.5em;
			margin: 5px;
			display: inline-block;
		}
		.messenger-messagingView {
			height: 100% !important;
		}
		.messenger {
			background:
				radial-gradient(120% 120% at 10% 10%, rgba(14, 165, 233, 0.16), transparent 60%),
				radial-gradient(100% 100% at 85% 5%, rgba(126, 58, 242, 0.18), transparent 55%),
				linear-gradient(135deg, var(--chatify-gradient-start), var(--chatify-gradient-end));
			padding: clamp(1.25rem, 3vw, 2.75rem);
			gap: clamp(1.25rem, 3vw, 2rem);
		}
		.messenger-listView,
		.messenger-messagingView {
			border-radius: 24px;
			border: 1px solid var(--chatify-border-light);
			background: var(--chatify-glass-light);
			backdrop-filter: blur(16px);
			box-shadow: 0 28px 48px rgba(15, 23, 42, 0.10);
		}
		.dark .messenger-listView,
		.dark .messenger-messagingView {
			background: var(--chatify-glass-dark);
			border-color: var(--chatify-border-dark);
			box-shadow: 0 28px 60px rgba(0, 0, 0, 0.32);
		}
		.messenger-listView .m-header {
			padding: clamp(1.25rem, 2.4vw, 1.9rem) !important;
			border-bottom: 1px solid rgba(148, 163, 184, 0.22);
		}
		.dark .messenger-listView .m-header {
			border-color: rgba(63, 63, 70, 0.55);
		}
		.messenger-listView nav {
			background: transparent;
			border-color: rgba(148, 163, 184, 0.15) !important;
		}
		.messenger-search {
			border-radius: 9999px;
			background: rgba(255, 255, 255, 0.82);
			border-color: transparent;
			padding-block: 0.75rem;
			box-shadow: inset 0 1px 0 rgba(148, 163, 184, 0.18);
		}
		.dark .messenger-search {
			background: rgba(39, 39, 42, 0.85);
			box-shadow: inset 0 1px 0 rgba(63, 63, 70, 0.35);
		}
		.messenger-favorites {
			padding: 1.2rem 1.5rem;
			gap: 0.75rem;
		}
		.messenger-list-item {
			border-radius: 18px;
			margin-inline: 16px;
			transition: transform 0.18s ease, box-shadow 0.18s ease, background 0.18s ease;
		}
		.messenger-list-item:hover {
			transform: translateX(4px);
			background: rgba(59, 130, 246, 0.08);
			box-shadow: 0 10px 24px rgba(37, 99, 235, 0.08);
		}
		.dark .messenger-list-item:hover {
			background: rgba(37, 99, 235, 0.18);
		}
		.m-list-active {
			background: linear-gradient(135deg, rgba(56, 189, 248, 0.16), rgba(59, 130, 246, 0.18)) !important;
			box-shadow: 0 14px 28px rgba(37, 99, 235, 0.12);
		}
		.dark .m-list-active {
			background: linear-gradient(135deg, rgba(14, 165, 233, 0.25), rgba(59, 130, 246, 0.22)) !important;
		}
		.message-card .msg-card-content {
			background: linear-gradient(135deg, rgba(59, 130, 246, 0.12), rgba(29, 78, 216, 0.08));
			border-radius: 22px;
			box-shadow: 0 12px 24px rgba(59, 130, 246, 0.12);
			color: rgba(15, 23, 42, 0.82);
		}
		.dark .message-card .msg-card-content {
			background: linear-gradient(135deg, rgba(59, 130, 246, 0.22), rgba(14, 165, 233, 0.14));
			color: rgba(248, 250, 252, 0.95);
		}
		.mc-sender .msg-card-content {
			background: linear-gradient(135deg, rgba(59, 130, 246, 0.88), rgba(14, 165, 233, 0.72));
			color: #fff !important;
		}
		.messenger-sendCard {
			border-radius: 9999px;
			padding: 0.85rem 1.4rem;
			margin-inline: 1.5rem;
			margin-bottom: 1.25rem;
			background: rgba(15, 23, 42, 0.04);
			border: 1px solid rgba(148, 163, 184, 0.25);
			box-shadow: 0 12px 30px rgba(15, 23, 42, 0.08);
		}
		.dark .messenger-sendCard {
			background: rgba(255, 255, 255, 0.05);
			border-color: rgba(63, 63, 70, 0.45);
			box-shadow: 0 18px 30px rgba(0, 0, 0, 0.45);
		}
		.messenger-sendCard textarea {
			background: transparent;
			font-size: 0.95rem;
			color: inherit;
		}
		.messenger-sendCard button {
			background: linear-gradient(135deg, rgba(59, 130, 246, 0.95), rgba(37, 99, 235, 0.92));
			color: #fff !important;
			border-radius: 9999px;
			padding: 0.6rem;
			box-shadow: 0 12px 24px rgba(59, 130, 246, 0.32);
			transition: transform 0.15s ease, box-shadow 0.15s ease;
		}
		.messenger-sendCard button:hover {
			transform: translateY(-1px);
			box-shadow: 0 16px 32px rgba(59, 130, 246, 0.38);
		}
		.voice-note-btn {
			display: inline-flex;
			align-items: center;
			justify-content: center;
			gap: 0.5rem;
			border-radius: 9999px;
			padding: 0.55rem 0.9rem;
			margin-right: 0.75rem;
			background: rgba(59, 130, 246, 0.08);
			color: rgba(37, 99, 235, 0.95);
			font-weight: 600;
			border: 1px solid rgba(59, 130, 246, 0.18);
			transition: all 0.2s ease;
		}
		.voice-note-btn:hover {
			background: rgba(59, 130, 246, 0.15);
			box-shadow: 0 12px 24px rgba(37, 99, 235, 0.18);
		}
		.voice-note-btn.is-recording {
			background: linear-gradient(135deg, rgba(239, 68, 68, 0.92), rgba(251, 113, 133, 0.9));
			border-color: rgba(248, 113, 113, 0.28);
			color: #fff;
			box-shadow: 0 16px 36px rgba(239, 68, 68, 0.32);
		}
		.voice-note-btn svg {
			width: 1.15rem;
			height: 1.15rem;
		}
		.voice-note-btn .voice-record-timer {
			font-variant-numeric: tabular-nums;
			font-size: 0.9rem;
		}
		.voice-note-preview {
			margin-inline: 1.5rem;
			margin-bottom: 1rem;
			border-radius: 18px;
			padding: 0.85rem 1.15rem;
			display: flex;
			align-items: center;
			justify-content: space-between;
			gap: 1rem;
			background: rgba(15, 23, 42, 0.06);
			border: 1px solid rgba(148, 163, 184, 0.25);
		}
		.dark .voice-note-preview {
			background: rgba(255, 255, 255, 0.06);
			border-color: rgba(63, 63, 70, 0.45);
		}
		.voice-note-preview audio {
			width: 100%;
		}
		.voice-note-preview button {
			display: inline-flex;
			align-items: center;
			justify-content: center;
			gap: 0.35rem;
			padding: 0.45rem 0.9rem;
			border-radius: 9999px;
			font-size: 0.85rem;
		}
		.voice-note-cancel {
			background: rgba(239, 68, 68, 0.15);
			color: rgba(185, 28, 28, 0.96);
			border: 1px solid rgba(248, 113, 113, 0.35);
		}
		.voice-note-send {
			background: linear-gradient(135deg, rgba(59, 130, 246, 0.92), rgba(37, 99, 235, 0.9));
			color: #fff;
			border: 0;
		}
		.voice-note-hint {
			margin-inline: 1.5rem;
			margin-bottom: 0.75rem;
			font-size: 0.78rem;
			font-weight: 500;
			color: rgba(37, 99, 235, 0.9);
		}
		.voice-note-hint.is-error {
			color: rgba(220, 38, 38, 0.92);
		}
		.voice-note-duration {
			font-variant-numeric: tabular-nums;
			font-weight: 600;
			color: rgba(15, 23, 42, 0.65);
		}
		.dark .voice-note-duration {
			color: rgba(226, 232, 240, 0.85);
		}
		.voice-note-player {
			border: 1px solid rgba(148, 163, 184, 0.25);
			background: rgba(255, 255, 255, 0.78);
			backdrop-filter: blur(14px);
			box-shadow: 0 18px 32px rgba(15, 23, 42, 0.12);
		}
		.dark .voice-note-player {
			background: rgba(39, 39, 42, 0.78);
			border-color: rgba(63, 63, 70, 0.45);
			box-shadow: 0 18px 32px rgba(0, 0, 0, 0.4);
		}
		.voice-note-player audio {
			filter: drop-shadow(0 6px 18px rgba(15, 23, 42, 0.18));
		}
		@media (max-width: 1024px) {
			.messenger {
				flex-direction: column;
				padding: 1rem;
				background: rgba(15, 23, 42, 0.05);
			}
			.messenger-listView,
			.messenger-messagingView {
				border-radius: 20px;
				box-shadow: 0 20px 40px rgba(15, 23, 42, 0.16);
			}
			.voice-note-preview {
				flex-direction: column;
				align-items: stretch;
			}
		}
	</style>

	{{-- JavaScript variables --}}
	<script>
		__var_app_url        = "{{ url('/') }}";
		__var_app_locale     = "{{ app()->getLocale() }}";
		__var_rtl            = @js(config()->get('direction') === 'ltr' ? false : true);
		__var_primary_color  = "{{ settings('appearance')->colors['primary'] }}";
		__var_axios_base_url = "{{ url('/') }}/";
		__var_currency_code  = "{{ settings('currency')->code }}";
		window.__chatifyVoiceNotes = {
			enabled: @json((bool) config('chatify.voice_notes.enabled')),
			maxSeconds: @json((int) config('chatify.voice_notes.max_seconds')),
			formats: @json(config('chatify.voice_notes.formats')),
			labels: {
				record: @json(trans('messages.t_record_voice_note') !== 'messages.t_record_voice_note' ? trans('messages.t_record_voice_note') : 'Record voice'),
				stop: @json(trans('messages.t_stop_recording') !== 'messages.t_stop_recording' ? trans('messages.t_stop_recording') : 'Stop'),
				discard: @json(trans('messages.t_discard') !== 'messages.t_discard' ? trans('messages.t_discard') : 'Discard'),
				send: @json(trans('messages.t_send_voice_note') !== 'messages.t_send_voice_note' ? trans('messages.t_send_voice_note') : 'Send voice'),
				unsupported: @json(trans('messages.t_voice_not_supported') !== 'messages.t_voice_not_supported' ? trans('messages.t_voice_not_supported') : 'Your browser does not support voice notes.'),
				permission: @json(trans('messages.t_voice_permission_denied') !== 'messages.t_voice_permission_denied' ? trans('messages.t_voice_permission_denied') : 'Please allow microphone access to record.'),
				noRecording: @json(trans('messages.t_voice_no_recording') !== 'messages.t_voice_no_recording' ? trans('messages.t_voice_no_recording') : 'No voice note recorded yet.'),
				uploading: @json(trans('messages.t_voice_uploading') !== 'messages.t_voice_uploading' ? trans('messages.t_voice_uploading') : 'Uploading voice note…'),
				uploadFailed: @json(trans('messages.t_voice_upload_failed') !== 'messages.t_voice_upload_failed' ? trans('messages.t_voice_upload_failed') : 'Failed to upload the voice note. Please try again.')
			}
		};
	</script>

	{{-- Scripts --}}
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="{{ url('public/js/chatify/autosize.js') }}"></script>
	<script src="{{ url('node_modules/@webcomponents/webcomponentsjs/webcomponents-bundle.js') }}"></script>
	<script src="{{ url('public/js/plugins/twemoji/twemoji.min.js') }}"></script>
	<script src="{{ url('public/js/plugins/nprogress/nprogress.js') }}"></script>
	<script src="{{ url('public/js/plugins/emoji-mart/dist/browser.js') }}"></script>
	<script src="{{ url('public/js/plugins/momentjs/moment-with-locales.js') }}"></script>
	<script src="{{ url('public/js/plugins/momentjs/moment-timezone.min.js') }}"></script>
	<script src="{{ url('public/js/plugins/momentjs/moment-timezone-with-data-1970-2030.min.js') }}"></script>

	@vite(['resources/css/app.css','resources/js/app.js'])
