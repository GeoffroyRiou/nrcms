@props(['item'])

<li {{ $attributes->merge(['class' => '']) }}>
    <a href="{{ $item['url'] ?? '' }}" @if ($item['blank']) target="_blank" @endif>
        {{ $item['label'] }}
    </a>
    @if (!empty($item['children']))
        <x-nrcms::menu.menu-wrapper>
            @foreach ($item['children'] as $item)
                <x-nrcms::menu.menu-item :item="$item" />
            @endforeach
        </x-nrcms::menu.menu-wrapper>
    @endif
</li>
