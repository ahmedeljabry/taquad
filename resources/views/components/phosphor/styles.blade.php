@once
    @php
        $phosphorVersion = '2.1.1';
        $phosphorWeights = [
            'regular' => 'Phosphor',
            'thin' => 'Phosphor-Thin',
            'light' => 'Phosphor-Light',
            'bold' => 'Phosphor-Bold',
            'fill' => 'Phosphor-Fill',
            'duotone' => 'Phosphor-Duotone',
        ];
    @endphp

    @foreach ($phosphorWeights as $weight => $fontFamily)
        @php
            $relativeCssPath = "vendor/phosphor/{$weight}/style.css";
            $localCssPath = public_path($relativeCssPath);
            $hasLocalAssets = is_file($localCssPath);
            $cdnBase = "https://unpkg.com/@phosphor-icons/web@{$phosphorVersion}/src/{$weight}";
            $cdnCss = "{$cdnBase}/style.css";
        @endphp

        @if ($hasLocalAssets)
            <link rel="preload" href="{{ asset($relativeCssPath) }}" as="style">
            <link rel="stylesheet" href="{{ asset($relativeCssPath) }}">
        @else
            <link rel="preload" href="{{ $cdnCss }}" as="style" crossorigin="anonymous">
            <link rel="stylesheet" href="{{ $cdnCss }}" crossorigin="anonymous">
            <style>
                @font-face {
                    font-family: "{{ $fontFamily }}";
                    src:
                        url("{{ $cdnBase }}/{{ $fontFamily }}.woff2") format("woff2"),
                        url("{{ $cdnBase }}/{{ $fontFamily }}.woff") format("woff"),
                        url("{{ $cdnBase }}/{{ $fontFamily }}.ttf") format("truetype"),
                        url("{{ $cdnBase }}/{{ $fontFamily }}.svg#{{ $fontFamily }}") format("svg");
                    font-weight: normal;
                    font-style: normal;
                    font-display: swap;
                }
            </style>
        @endif
    @endforeach
@endonce
