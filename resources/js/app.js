import { Livewire, Alpine } from "../../vendor/livewire/livewire/dist/livewire.esm";

import swal from 'sweetalert2';
window.Swal = swal;

import './bootstrap';
import 'flowbite';
import { createApp } from 'vue';
import axios from 'axios';
// import Helpers from './plugins/helpers';
import Toast, { POSITION } from "vue-toastification";
// import $ from 'jquery';
// window.$ = window.jQuery = $;
import select2 from 'select2';

import flatpickr from "flatpickr";
import Quill from "quill";
import * as FilePond from "filepond";
import { createPopper } from "@popperjs/core";
import focus from "@alpinejs/focus";
import "@tabler/icons-webfont/tabler-icons.min.css";
// Import the plugin code
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';

// Import the plugin styles
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css';

Alpine.plugin(focus);

// Import the plugin code
import FilePondPluginImageCrop from 'filepond-plugin-image-crop';
import FilePondPluginImageResize from 'filepond-plugin-image-resize';


// Register the plugin
FilePond.registerPlugin(FilePondPluginImageCrop, FilePondPluginImagePreview, FilePondPluginImageResize);

window.flatpickr = flatpickr;
window.FilePond = FilePond;
window.Quill = Quill;
window.createPopper = createPopper;

axios.defaults.baseURL                            = __var_axios_base_url;
axios.defaults.headers.common['X-Requested-With'] = "XMLHttpRequest";
axios.defaults.headers.post  ['X-CSRF-TOKEN']     = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

// Vue.js Components
import PostProject from './components/main/post/project/project.vue';
import EditProject from './components/main/account/projects/edit.vue';

// Get app element
const app_element = document.getElementById("app");
const app = createApp({});

app.component('post-project', PostProject);
app.component('edit-project', EditProject);

// app.use(Helpers);
app.use(Toast, {
    position: POSITION.BOTTOM_CENTER
});
if (app_element) {
    app.mount('#app');
}

Livewire.start();