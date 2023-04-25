<x-layout>
    <x-slot name="content">
        <article>
            <h1>{{ $post->title }}</h1>
            <h2>{{ $post->date }}</h2>
            <p>{!! $post->body !!}</p>
        </article>

        <a href="/">Go back</a>
    </x-slot>
</x-layout>
