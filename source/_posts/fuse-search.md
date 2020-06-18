---
extends: _layouts.post
section: main
title: Fuse Search
date: 2018-12-22
description: Fast local search powered by FuseJS
cover_image: https://raw.githubusercontent.com/tightenco/jigsaw-blog-template/master/source/assets/img/post-cover-image-1.png
categories: [feature]
---

To provide fast, local search of your blog, this starter template comes with a pre-built Vue.js component that uses Fuse.js. [Fuse.js](http://fusejs.io/) is a "lightweight fuzzy-search library with _no_ dependencies." It works by running queries against a JSON index of your content.

During the [build process](http://jigsaw.tighten.co/docs/building-and-previewing/), the contents of your `posts` collection is processed by the `GenerateIndex.php` listener, and an `index.json` file is generated in the build directory. The `Search.vue` component provides a search input that queries this local index.

If you'd like to customize the generation of your search index, take a look at the `handle` method of the `GenerateIndex.php` file.

