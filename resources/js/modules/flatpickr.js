import flatpickr from "flatpickr";

export function registerFlatpickr() {
    if (!window.flatpickr) {
        window.flatpickr = flatpickr;
    }
}
