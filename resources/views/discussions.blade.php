@extends('layout')

@section('title', "Support Orchid Sustainable Development")
@section('description', 'Your contribution goes a long way in enabling us to develop and maintain our open-source packages while providing ongoing support to the community')

@section('body')

    <div class="bg-dark position-relative">

        <div class="container pt-md-4 pt-2 position-relative">
            <header class="d-flex flex-wrap align-items-center justify-content-center py-3 mb-4 px-4 position-relative">
                @include('header-menu')
            </header>
        </div>
    </div>



    <div class="container col-xxl-8 px-4 py-5">
        <div class="card shadow-sm h-100 position-relative">
            <img src="/img/next/docs-left-tentacli.svg" class="d-none d-md-block pe-none position-absolute" style="
    left: -3.5em;
    height: 20em;
    z-index: 3;
    bottom: 35%;">
            <div class="card-body d-flex flex-column p-5 pb-0">
                <div class="row flex-lg-row-reverse align-items-end g-5">
                    <div class="col-6">
                        <div class="bg-body-tertiary me-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden">

                            <div class="bg-dark shadow-sm mx-auto" style="min-height: 300px; border-radius: 21px 21px 0 0;">
                                <div class="list-group text-start p-5">

                                    @foreach($discussions as $discussion)
                                        <div class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
                                            <img src="{{ $discussion['author']['avatarUrl'] }}" alt="twbs" width="48" height="48" class="rounded-circle flex-shrink-0">
                                            <div class="d-flex gap-2 w-100 justify-content-between">
                                                <div>
                                                    <h6 class="mb-0">{{ $discussion['author']['name'] ?? $discussion['author']['login'] }}</h6>
                                                    <p class="mb-0 opacity-75 small text-balance">{{ $discussion['title'] }}</p>
                                                </div>
                                                <small class="opacity-50 text-nowrap">{{ \Illuminate\Support\Carbon::parse($discussion['createdAt'])->diffForHumans() }}</small>
                                            </div>
                                        </div>
                                    @endforeach


                                    <div class="d-md-flex justify-content-md-start pt-4 gap-3">
                                        <a href="https://github.com/orchidsoftware/platform/issues" target="_blank" class="btn btn-outline-secondary px-4 w-100">New Issue</a>
                                        <a href="https://github.com/orgs/orchidsoftware/discussions" target="_blank" class="btn btn-outline-secondary px-4 w-100">New Discussion</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 my-auto py-lg-5">
                        <div class="p-4">
                            <h1 class="display-4 fw-bold lh-1 text-body-emphasis mb-4">Discussions</h1>

                            <p>
                                Join our user groups, where community members have created vibrant and
                                interactive spaces for discussions. Don't hesitate to actively participate and feel free
                                to share your thoughts, ask questions, or even engage in some friendly banter or "flud"
                                with fellow Orchid enthusiasts.
                            </p>

                            <div class="mt-5">
                                <h4 class="d-flex align-items-center mb-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" class="bi bi-github me-3" viewBox="0 0 16 16">
                                        <path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.012 8.012 0 0 0 16 8c0-4.42-3.58-8-8-8z"/>
                                    </svg>

                                    GitHub
                                </h4>
                                <p class="mb-4">
                                    For questions or in-depth discussions, we recommend utilizing the power of GitHub. It
                                    allows you to publicly reference the conversation history and track progress with all
                                    participants. Create <a
                                        href="https://github.com/orchidsoftware/platform/issues" class="link-light">issues</a> to report
                                    problems or participate in <a
                                        href="https://github.com/orchidsoftware/platform/discussions"  class="link-light">discussions</a> to ask
                                    questions, share ideas, and give opinions.

                                <h5 class="mt-5 d-flex align-items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" class="bi bi-telegram me-3" viewBox="0 0 16 16">
                                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.287 5.906c-.778.324-2.334.994-4.666 2.01-.378.15-.577.298-.595.442-.03.243.275.339.69.47l.175.055c.408.133.958.288 1.243.294.26.006.549-.1.868-.32 2.179-1.471 3.304-2.214 3.374-2.23.05-.012.12-.026.166.016.047.041.042.12.037.141-.03.129-1.227 1.241-1.846 1.817-.193.18-.33.307-.358.336a8.154 8.154 0 0 1-.188.186c-.38.366-.664.64.015 1.088.327.216.589.393.85.571.284.194.568.387.936.629.093.06.183.125.27.187.331.236.63.448.997.414.214-.02.435-.22.547-.82.265-1.417.786-4.486.906-5.751a1.426 1.426 0 0 0-.013-.315.337.337 0 0 0-.114-.217.526.526 0 0 0-.31-.093c-.3.005-.763.166-2.984 1.09z"/>
                                    </svg>

                                    +

                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" class="bi bi-discord mx-3" viewBox="0 0 16 16">
                                        <path d="M13.545 2.907a13.227 13.227 0 0 0-3.257-1.011.05.05 0 0 0-.052.025c-.141.25-.297.577-.406.833a12.19 12.19 0 0 0-3.658 0 8.258 8.258 0 0 0-.412-.833.051.051 0 0 0-.052-.025c-1.125.194-2.22.534-3.257 1.011a.041.041 0 0 0-.021.018C.356 6.024-.213 9.047.066 12.032c.001.014.01.028.021.037a13.276 13.276 0 0 0 3.995 2.02.05.05 0 0 0 .056-.019c.308-.42.582-.863.818-1.329a.05.05 0 0 0-.01-.059.051.051 0 0 0-.018-.011 8.875 8.875 0 0 1-1.248-.595.05.05 0 0 1-.02-.066.051.051 0 0 1 .015-.019c.084-.063.168-.129.248-.195a.05.05 0 0 1 .051-.007c2.619 1.196 5.454 1.196 8.041 0a.052.052 0 0 1 .053.007c.08.066.164.132.248.195a.051.051 0 0 1-.004.085 8.254 8.254 0 0 1-1.249.594.05.05 0 0 0-.03.03.052.052 0 0 0 .003.041c.24.465.515.909.817 1.329a.05.05 0 0 0 .056.019 13.235 13.235 0 0 0 4.001-2.02.049.049 0 0 0 .021-.037c.334-3.451-.559-6.449-2.366-9.106a.034.034 0 0 0-.02-.019Zm-8.198 7.307c-.789 0-1.438-.724-1.438-1.612 0-.889.637-1.613 1.438-1.613.807 0 1.45.73 1.438 1.613 0 .888-.637 1.612-1.438 1.612Zm5.316 0c-.788 0-1.438-.724-1.438-1.612 0-.889.637-1.613 1.438-1.613.807 0 1.451.73 1.438 1.613 0 .888-.631 1.612-1.438 1.612Z"/>
                                    </svg>

                                    Community Groups
                                </h5>

                                <ul>
                                    <li><a href="https://t.me/orchid_community" class="link-light">Telegram</a></li>
                                    <li><a href="https://discord.gg/NxXhSHa5tq" class="link-light">Discord</a></li>
                                </ul>

                                <p class="small opacity-50">Locale groups</p>
                                <ul>
                                    <li><a href="https://t.me/orchid_russian_community" class="link-light">Telegram Russian Community</a></li>
                                    <li><a href="https://t.me/esLaravelOrchid" class="link-light">Telegram Spanish Community</a></li>
                                </ul>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
