import { createApp } from "vue";
import Toast, { POSITION } from "vue-toastification";
import PostProject from "../components/main/post/project/project.vue";
import EditProject from "../components/main/account/projects/edit.vue";

export function mountVueApp(target) {
    const host = typeof target === "string" ? document.querySelector(target) : target;
    if (!host) {
        return;
    }

    const app = createApp({});
    app.component("post-project", PostProject);
    app.component("edit-project", EditProject);

    app.use(Toast, {
        position: POSITION.BOTTOM_CENTER,
    });

    app.mount(host);
}
