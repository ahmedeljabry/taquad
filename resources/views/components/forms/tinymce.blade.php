@props(['model', 'id'])

<div>

    {{-- Editor --}}
    <div wire:ignore>
        <textarea
            class="min-h-fit h-48"
            id="tinymce-element-{{ $id }}">
		
			{{-- Pre-defined value --}}
			@if ($value ?? null)
				{!! $value !!}
			@endif

		</textarea>
    </div>

	{{-- Error --}}
	@error($model)
        <p class="mt-1 text-xs text-red-600 dark:text-red-500">{{ $errors->first($model) }}</p>
    @enderror

</div>

{{-- Inject TinyMCE plugin --}}
@pushOnce('scripts')
    <script src="{{ asset('js/plugins/tinymce/tinymce.min.js') }}"></script>
@endPushOnce

{{-- Initialize --}}
@push('scripts')
    <script>

        // Initialize TinyMCE
        tinymce.init({

            // Element
            selector: '#tinymce-element-{{ $id }}',

            // Language
            language: '{{ app()->getLocale() }}',

			// Plugins
            plugins: [
    			'accordion', 'advlist', 'autolink', 'link', 'image', 'lists', 'charmap', 'preview', 'anchor', 'pagebreak', 'searchreplace', 'wordcount', 'visualblocks', 'code', 'fullscreen', 'insertdatetime', 'media','table', 'emoticons', 'help'
			],

			// Toolbar
  			toolbar: 'accordion | undo redo | styles | bold italic | alignleft aligncenter alignright alignjustify | ' +  'bullist numlist outdent indent | link image | print preview media fullscreen | ' + 'forecolor backcolor emoticons | help',

			// Menu
			menu: {
				favs: { title: 'My Favorites', items: 'code visualaid | searchreplace | emoticons' }
			},

			// Link outside
			link_default_target: '_blank',

			// Emojis
			emoticons_database  : 'emojiimages',
			emoticons_images_url: '{{ url("public/js/plugins/twemoji/assets/72x72") }}/',
			relative_urls       : false,

			// Files
			image_title         : true,
			automatic_uploads   : true,
			file_picker_types   : 'image',
			file_picker_callback: (cb, value, meta) => {
				const input = document.createElement('input');
				input.setAttribute('type', 'file');
				input.setAttribute('accept', 'image/*');

				input.addEventListener('change', (e) => {
				const file = e.target.files[0];

				const reader = new FileReader();
				reader.addEventListener('load', () => {
					/*
					Note: Now we need to register the blob in TinyMCEs image blob
					registry. In the next release this part hopefully won't be
					necessary, as we are looking to handle it internally.
					*/
					const id = 'blobid' + (new Date()).getTime();
					const blobCache =  tinymce.activeEditor.editorUpload.blobCache;
					const base64 = reader.result.split(',')[1];
					const blobInfo = blobCache.create(id, file, base64);
					blobCache.add(blobInfo);

					/* call the callback and populate the Title field with the file name */
					cb(blobInfo.blobUri(), { title: file.name });
				});
				reader.readAsDataURL(file);
				});

				input.click();
			},

    		// Toolbar
			menubar     : 'edit view insert format tools table',
			toolbar_mode: 'sliding',

			// Theme
			skin         : '{{ current_theme() === "dark" ? "oxide-dark" : "oxide" }}',
			content_css  : '{{ current_theme() === "dark" ? "dark" : "default" }}',
			content_style: "body { font-family:  @php echo settings('appearance')->font_family @endphp, sans-serif !important; font-size: 14px }",

			// Setup
			setup: function (editor) {
				editor.on('init change', function () {
					editor.save();
				});
				editor.on('submit', function (e) {
					@this.set('{{ $model }}', editor.getContent());
				});
			}

        });

    </script>
@endpush