import { Livewire, Alpine } from "../../vendor/livewire/livewire/dist/livewire.esm";
import swal from "sweetalert2";
import "./bootstrap";
import axios from "axios";
import focus from "@alpinejs/focus";
import "./theme/theme-manager";

window.Swal = swal;
window.axios = axios;

Alpine.plugin(focus);
window.Alpine = Alpine;

axios.defaults.baseURL = __var_axios_base_url;
axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
axios.defaults.headers.post["X-CSRF-TOKEN"] = document
    .querySelector('meta[name="csrf-token"]')
    .getAttribute("content");

const flowbiteSelectors = [
    "[data-accordion]",
    "[data-carousel]",
    "[data-collapse]",
    "[data-dial-toggle]",
    "[data-dismiss-target]",
    "[data-drawer-target]",
    "[data-dropdown-toggle]",
    "[data-modal-target]",
    "[data-popover-target]",
    "[data-tabs-toggle]",
    "[data-tooltip-target]",
];

const hasMatchingElement = (selector) =>
    typeof selector === "string" && document.querySelector(selector);

const lazyQueue = [];
const enqueue = (loader) => {
    lazyQueue.push(
        loader().catch((error) => {
            if (import.meta.env.DEV) {
                console.error("Lazy module failed to load", error);
            }
        })
    );
};

const vueHost = document.getElementById("app");
if (vueHost) {
    enqueue(() =>
        import("./modules/vue-app").then(({ mountVueApp }) =>
            mountVueApp(vueHost)
        )
    );
}

if (document.querySelector("[data-filepond-root]")) {
    enqueue(() =>
        import("./modules/filepond").then(({ registerFilePond }) =>
            registerFilePond()
        )
    );
}

if (document.querySelector('[data-rich-text="quill"]')) {
    enqueue(() =>
        import("./modules/quill").then(({ registerQuill }) => registerQuill())
    );
}

if (document.querySelector("[data-date-picker-root]")) {
    enqueue(() =>
        import("./modules/flatpickr").then(({ registerFlatpickr }) =>
            registerFlatpickr()
        )
    );
}

if (flowbiteSelectors.some(hasMatchingElement)) {
    enqueue(() =>
        import("./modules/flowbite").then(({ setupFlowbite }) =>
            setupFlowbite()
        )
    );
}

Promise.all(lazyQueue).catch(() => {});

Livewire.start();
