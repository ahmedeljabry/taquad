import * as FilePond from "filepond";
import FilePondPluginImagePreview from "filepond-plugin-image-preview";
import FilePondPluginImageCrop from "filepond-plugin-image-crop";
import FilePondPluginImageResize from "filepond-plugin-image-resize";

export function registerFilePond() {
    if (window.FilePond) {
        return;
    }

    FilePond.registerPlugin(
        FilePondPluginImageCrop,
        FilePondPluginImagePreview,
        FilePondPluginImageResize
    );

    window.FilePond = FilePond;
}
