import Quill from "quill";

export function registerQuill() {
    if (!window.Quill) {
        window.Quill = Quill;
    }
}
