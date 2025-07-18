import Echo from "laravel-echo";
import Pusher from "pusher-js";

(function () {
  /* ---- config pulled from inline JSON ---- */
  const c       = window.__CHAT__;
  const KEY     = c.k;
  const OPTS    = c.o;          // {cluster:"mt1", wsHost:"...", forceTLS:true, ...}
  const UID     = c.u;
  const AUTH    = c.au;
  let   unread  = c.uc || 0;

  const BASE    = document.title.replace(/\(\d+\)\s*/, "") || "Inbox";
  const paint   = () => { document.title = unread ? `(${unread}) ${BASE}` : BASE; };

  /* ---- boot Echo (same options as server) ---- */
  window.Pusher = Pusher;
  window.Echo   = new Echo({
      broadcaster : "pusher",
      key         : KEY,
      ...OPTS,
      authEndpoint: AUTH,
      csrfToken   : document.head.querySelector('meta[name="csrf-token"]').content,
      enabledTransports: ["ws","wss"]
  });

  /* ---- realtime listeners ---- */
  window.Echo.private(`chat.${UID}`)          // Echo adds "private-" internally
      .listen(".messaging", e => {
          if (e.to_id === UID) {
              unread++;
              new Audio("/js/chatify/sounds/new-message-sound.mp3").play();
              paint();
          }
      })
      .listen(".client-seen", e => {
          if (e.to_id === UID && e.seen) {
              unread = 0;
              paint();
          }
      });

  window.addEventListener("focus", () => { unread = 0; paint(); });
  paint();
})();
