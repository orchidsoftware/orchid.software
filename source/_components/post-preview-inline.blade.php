{{--
<div class="flex flex-col mb-4">
    <p class="text-gray-700 font-medium my-2">
        {{ $post->getDate()->format('F j, Y') }}
    </p>

    <h2 class="text-3xl mt-0">
        <a
            href="{{ $post->getUrl() }}"
            title="Read more - {{ $post->title }}"
            class="text-gray-900 font-extrabold"
        >{{ $post->title }}</a>
    </h2>

    <p class="mb-4 mt-0">{!! $post->getExcerpt(200) !!}</p>

    <a
        href="{{ $post->getUrl() }}"
        title="Read more - {{ $post->title }}"
        class="uppercase font-semibold tracking-wide mb-2"
    >Read</a>
</div>
--}}

<div class="card">
    @if ($post->cover_image)
        <img src="{{ $post->cover_image }}" alt="{{ $post->title }} cover image" class="card-img-top img-fluid">
    @endif
    <div class="card-body">
        <h4 class="card-title mb-0">
            <a
                    href="{{ $post->getUrl() }}"
                    title="Read more - {{ $post->title }}"
            >{{ $post->title }}</a>
        </h4>
        <time class="small text-muted mb-3 block">{{ $post->getDate()->format('F j, Y') }}</time>
        <p class="card-text">{!! $post->getExcerpt(200) !!}</p>

        <a
                href="{{ $post->getUrl() }}"
                title="Read more - {{ $post->title }}"
                class="uppercase mb-2"
        >Read &RightArrow;</a>
    </div>
</div>
