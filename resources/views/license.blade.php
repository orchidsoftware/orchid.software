@extends('layout')

@section('title', "The MIT License (MIT)")
@section('description', 'Join us as we celebrate collaboration, innovation, and the boundless potential of open source. Together, we can build a future defined by limitless possibilities.')

@section('body')

    <div class="bg-dark position-relative">
        <div class="container pt-md-4 pt-2 position-relative">
            <header class="d-flex flex-wrap align-items-center justify-content-center py-3 mb-4 px-4 position-relative">
                @include('header-menu')
            </header>
        </div>
    </div>



    <div class="container col-xxl-8 py-5 mb-5">
        <div class="card shadow-sm h-100 position-relative">
            <div class="overflow-hidden">
                <div class="row pb-0 pe-lg-0 align-items-baseline">
                    <div class="col-lg-6 p-3 ps-lg-5 pt-lg-3">
                        <div class="px-4 py-md-4">
                            <h1 class="display-4 fw-bold lh-1 text-body-emphasis mb-4">Quick Summary</h1>


                            <p>At our core, we value the vibrant community of individuals who make each line of code
                               possible. Behind every piece of software lies the dedication, expertise, and passion of
                               talented individuals.</p>

                            <p>With pride, we champion a license that embodies the spirit of freedom and openness. Our
                               license is renowned as one of the most liberal in the industry, empowering users to
                               unleash their creativity, explore new possibilities, and shape their digital
                               experiences.</p>


                            <div class="row g-4 mt-3">
                                <div class="col-12">
                                    <h4>Can</h4>
                                    <ul class="d-flex flex-column p-0 mb-0">
                                        <li class="d-block my-1">✅ You may use the work commercially.</li>
                                        <li class="d-block my-1">✅ You may make changes to the work.</li>
                                        <li class="d-block my-1">✅ You may distribute the compiled code and/or source.</li>
                                        <li class="d-block my-1">✅ You may incorporate the work into something that has a more restrictive license.</li>
                                        <li class="d-block my-1">✅ You may use the work for private use.</li>
                                    </ul>
                                </div>
                                <div class="col-12 col-xl-6">
                                    <h4>Must ✍️</h4>
                                    <ul class="d-flex flex-column p-0 mb-0">
                                        <li class="d-block my-1">✍️ You must include the copyright notice in all copies or substantial uses of the work.</li>
                                        <li class="d-block my-1">✍️ You must include the license notice in all copies or substantial uses of the work.</li>
                                    </ul>
                                </div>
                                <div class="col-12 col-xl-6">
                                    <h4>Cannot</h4>
                                    <ul class="d-flex flex-column p-0 mb-0">
                                        <li class="d-block my-1">❌ The work is provided “as is”. You may not hold the author liable.</li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-6 p-3 pe-lg-5 pt-lg-3">
                        <main class="text-muted px-4 py-md-4">
                            <h2>MIT License</h2>
                            <p>Copyright © Chernyaev Alexandr</p>
                            <p>Permission is hereby granted, free of charge, to any person obtaining a copy
                               of this software and associated documentation files (the “Software”), to deal
                               in the Software without restriction, including without limitation the rights
                               to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
                               copies of the Software, and to permit persons to whom the Software is
                               furnished to do so, subject to the following conditions:</p>
                            <p>The above copyright notice and this permission notice shall be included in all
                               copies or substantial portions of the Software.</p>
                            <p>THE SOFTWARE IS PROVIDED “AS IS”, WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
                               IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR
                               PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
                               AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
                               LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
                               WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
                               SOFTWARE.</p>
                        </main>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-xxl-6 mx-auto">
            <p class="my-3 my-md-5 text-center text-muted">Join us as we celebrate collaboration, innovation, and the boundless potential of open source. Together, we can build a future defined by limitless possibilities.</p>
        </div>

    </div>

@endsection
