<?php extract(collect($attributes->getAttributes())->mapWithKeys(function ($value, $key) { return [Illuminate\Support\Str::camel(str_replace([':', '.'], ' ', $key)) => $value]; })->all(), EXTR_SKIP); ?>
@props(['class','variant','mini'])
<x-wireui::icons.outline.plus :class="$class" :variant="$variant" :mini="$mini" >

{{ $slot ?? "" }}
</x-wireui::icons.outline.plus>