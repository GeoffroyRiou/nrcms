@use('Illuminate\View\ComponentAttributeBag')
@php
    $blocks = $model->page_blocks ?? [];
@endphp
@foreach($blocks as $block)
    @php
        $component = $block['type'];
        $attributes = new ComponentAttributeBag($block['data']);
    @endphp
    <x-dynamic-component :$component :$attributes />
@endforeach
