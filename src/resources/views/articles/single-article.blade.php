<x-nrcms::layout>
    <h1 class="text-center text-3xl p-10">{{ $model->title }}</h1>

    {{ $model->illustration }}

    <x-nrcms::page-builder :model="$model" />
</x-nrcms::layout>
