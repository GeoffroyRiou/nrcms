@props(['questions' => [], 'title' => '', 'text' => ''])

<section class="bg-slate-50 py-8">

    <div class="max-w-6/12 mx-auto px-5 flex flex-col gap-5">

        <div>
            @if (!empty($title))
                <h2 class="text-2xl text-center">
                    {{ $title }}
                </h2>
            @endif

            @if (!empty($text))
                <div class="text-center">
                    {!! $text !!}
                </div>
            @endif
        </div>

        <div class="flex flex-col gap-3">
            @foreach ($questions as $question)
                <details class="p-5 shadow-lg bg-white rounded-lg">
                    <summary>
                        {{ $question['title'] }}
                    </summary>
                    <div class="mt-5">
                        {!! $question['text'] ?? '' !!}
                    </div>
                </details>
            @endforeach
        </div>
    </div>
</section>
