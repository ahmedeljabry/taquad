import { Modal } from "flowbite";
import "flowbite";
import { createPopper } from "@popperjs/core";

export function setupFlowbite() {
    if (!window.Modal) {
        window.Modal = Modal;
    }

    if (!window.createPopper) {
        window.createPopper = createPopper;
    }
}
