@extends('layout')

@section('title', "License")
@section('description', 'Join us as we celebrate collaboration, innovation, and the boundless potential of open source. Together, we can build a future defined by limitless possibilities.')

@section('body')

    <div class="page-masthead">
        <div class="masthead shell">
            <header class="header">
                @include('header-menu')
            </header>
        </div>
    </div>

    <main class="license shell">
        <div class="card license-card">
            <div class="clip">
                <div class="license-layout">
                    <div class="summary">
                        <div class="body">
                            <h1 class="page-title">Quick Summary</h1>

                            <p>At our core, we value the vibrant community of individuals who make each line of code
                               possible. Behind every piece of software lies the dedication, expertise, and passion of
                               talented individuals.</p>

                            <p>With pride, we champion a license that embodies the spirit of freedom and openness. Our
                               license is renowned as one of the most liberal in the industry, empowering users to
                               unleash their creativity, explore new possibilities, and shape their digital
                               experiences.</p>

                            <div class="rights">
                                <div class="allowed">
                                    <h4>Can</h4>
                                    <ul class="list">
                                        <li class="item">✅ You may use the work commercially.</li>
                                        <li class="item">✅ You may make changes to the work.</li>
                                        <li class="item">✅ You may distribute the compiled code and/or source.</li>
                                        <li class="item">✅ You may incorporate the work into something that has a more restrictive license.</li>
                                        <li class="item">✅ You may use the work for private use.</li>
                                    </ul>
                                </div>
                                <div>
                                    <h4>Must</h4>
                                    <ul class="list">
                                        <li class="item">✍️ You must include the copyright notice in all copies or substantial uses of the work.</li>
                                        <li class="item">✍️ You must include the license notice in all copies or substantial uses of the work.</li>
                                    </ul>
                                </div>
                                <div>
                                    <h4>Cannot</h4>
                                    <ul class="list">
                                        <li class="item">❌ The work is provided “as is”. You may not hold the author liable.</li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="terms">
                        <div class="body">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="license-outro">
            <p class="outro">Join us as we celebrate collaboration, innovation, and the boundless potential of open source. Together, we can build a future defined by limitless possibilities.</p>
        </div>

    </main>

@endsection
