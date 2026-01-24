@props([
    'href' => '#',
    'textColor' => '',
    'scrolledColor' => '',
    'underlineColor' => '',
])

<a
    href="{{ $href }}"
    class="group relative font-medium block transition-colors duration-200"
    style="color: {{ $textColor }}"
    :style="scrolled ? 'color: {{ $scrolledColor }}' : 'color: {{ $textColor }}'"
>
    {{ $slot }}
    <span
        class="absolute left-0 -bottom-1 h-[3px] w-full scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-center"
        style="background-color: {{ $underlineColor }};"
    ></span>
</a>
