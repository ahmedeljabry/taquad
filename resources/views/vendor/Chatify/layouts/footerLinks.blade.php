{{-- Livewire --}}
@livewireScriptConfig

<script src="https://js.pusher.com/8.0.1/pusher.min.js"></script>

{{-- Run this code, only when admin is online --}}
@auth('admin')
	<script>
		var pusher_key = "{{ config('chatify.pusher.key') }}";

		// Check if key is exists
		if (!pusher_key) {
			alert('You need to add Pusher keys first. Go to dashboard => settings => live chat');
		}
	</script>
@endauth

<script>

	// Gloabl Chatify variables from PHP to JS
	window.chatify = {
		enable_attachments       : Boolean({{ settings('live_chat')->enable_attachments }}),
		enable_emojis            : Boolean({{ settings('live_chat')->enable_emojis }}),
		enable_notification_sound: Boolean({{ settings('live_chat')->play_notification_sound }}),
		notification_sound       : "{{ url('public/js/chatify/sounds/new-message-sound.mp3') }}"
	};

	// Disable pusher logging
	Pusher.logToConsole = false;

    const BROADCAST = @json(config('broadcasting.connections.reverb'));
    const LEGACY = @json(config('chatify.pusher'));
    const OPTIONS = (BROADCAST && BROADCAST.options) || (LEGACY && LEGACY.options) || {};
    const HOST = OPTIONS.host || window.location.hostname;
    const PORT = OPTIONS.port || (OPTIONS.encrypted ? 443 : 6001);
    const SCHEME = OPTIONS.scheme || (OPTIONS.encrypted ? 'https' : 'http');
    const KEY = (BROADCAST && BROADCAST.key) || (LEGACY && LEGACY.key);

	var pusher = new Pusher(KEY, {
        wsHost      : HOST,
        wsPort      : PORT,
        wssPort     : PORT,
        forceTLS    : SCHEME === 'https',
        enabledTransports: SCHEME === 'https' ? ['wss'] : ['ws', 'wss'],
		authEndpoint: '{{ route("pusher.auth") }}',
		auth        : {
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		}
	});

	// Bellow are all the methods/variables that using php to assign globally.
	const allowedImages        = {!! json_encode( explode(',', settings('live_chat')->allowed_images) ) !!} || [];
	const allowedFiles         = {!! json_encode( explode(',', settings('live_chat')->allowed_files) ) !!} || [];
	const getAllowedExtensions = [...allowedImages, ...allowedFiles];
	const getMaxUploadSize     = {{ settings('live_chat')->max_file_size * 1048576 }};

</script>

<script src="{{ url('public/js/chatify/utils.js') }}"></script>
<script src="{{ url('public/js/chatify/code.js') }}"></script>
