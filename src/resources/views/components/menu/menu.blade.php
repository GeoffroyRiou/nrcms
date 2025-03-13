<x-nrcms::menu.menu-wrapper>
    @foreach ($items as $item)
        <x-nrcms::menu.menu-item :item="$item"/>
    @endforeach
</x-nrcms::menu.menu-wrapper>
