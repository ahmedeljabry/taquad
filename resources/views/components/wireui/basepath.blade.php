@php
    $iconsRoute = route('wireui.icons', ['style' => 'outline', 'icon' => 'check']);
    $iconsPath  = parse_url($iconsRoute, PHP_URL_PATH) ?? '';
    $wireuiPos  = strpos($iconsPath, '/wireui');
    $wireuiBase = $wireuiPos !== false ? substr($iconsPath, 0, $wireuiPos) : '';
    $wireuiBase = rtrim($wireuiBase, '/');
@endphp

<script>
    (function () {
        const prefix = "{{ $wireuiBase }}";
        const normalizedPrefix = prefix ? '/' + prefix.replace(/^\/|\/$/g, '') : '';

        window.__wireuiBasePath = normalizedPrefix;

        const originalFetch = window.fetch.bind(window);
        window.fetch = function (resource, init) {
            const adjust = (url) => {
                if (!url) {
                    return url;
                }

                const origin = window.location.origin;
                const wireuiRoot = normalizedPrefix ? origin + normalizedPrefix : origin;

                if (typeof url === 'string') {
                    if (url.startsWith('/wireui/')) {
                        return normalizedPrefix + url;
                    }

                    if (url.startsWith(origin + '/wireui/')) {
                        return wireuiRoot + url.substring(origin.length);
                    }

                    return url;
                }

                return url;
            };

            if (typeof resource === 'string') {
                resource = adjust(resource);
            } else if (resource instanceof Request) {
                const nextUrl = adjust(resource.url);

                if (nextUrl !== resource.url) {
                    resource = new Request(nextUrl, resource);
                }
            }

            return originalFetch(resource, init);
        };
    })();
</script>
