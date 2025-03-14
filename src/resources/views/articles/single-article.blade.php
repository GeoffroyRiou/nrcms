<x-nrcms::layout>
    <h1 class="text-center text-3xl p-10">{{ $article->title }}</h1>

    {{ $article->illustration }}

    <x-nrcms::page-builder :model="$article" />
</x-nrcms::layout>
