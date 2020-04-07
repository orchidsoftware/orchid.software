---
title: Icons
description:
extends: _layouts.documentation
section: main
lang: en
githubEdit: false
---

@extends('_layouts.documentation')

@section('main')
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group form-group-default">
                <label>Search Icons</label>
                <div class="controls">
                    <input type="text"   id="quick-search"  placeholder="Search..." class="form-control">
                </div>
            </div>
            <p>Click on the icons to get the icon class name
                The source code is located on <a href="https://github.com/orchidsoftware/icons" target="_blank">github</a>
            </p>
        </div>

        @foreach($page->icons as $icon)
            <div class="icon-preview-box col-xs-6 col-md-3 col-lg-3">
                <div class="preview">
                    <a href="#" class="show-code text-ellipsis" title="click to show css class name"><i
                                class="icon-{{$icon}} icons"></i><span class="name">{{$icon}}</span> <code
                                class="code-preview">.icon-{{$icon}}</code></a>
                </div>
            </div>
        @endforeach


    </div>
@endsection
