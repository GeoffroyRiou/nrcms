<x-nrcms::layout>
    <h1 class="text-center text-3xl p-10">{{ $page->title }}</h1>

    <x-nrcms::page-builder :model="$page" />
</x-nrcms::layout>
