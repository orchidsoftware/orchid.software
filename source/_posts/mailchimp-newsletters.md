---
extends: _layouts.post
section: main
title: Mailchimp Newsletters
date: 2018-11-21
categories: [feature]
description: Mailchimp newsletter signups, just add a url.
cover_image: https://raw.githubusercontent.com/tightenco/jigsaw-blog-template/master/source/assets/img/post-cover-image-1.png
---

[Mailchimp](https://mailchimp.com/) is a fantastic marketing platform, and takes the pain out of managing email lists and campaigns. The blog starter template comes with a beautiful pre-built newsletter form, that only needs a Mailchimp list URL to send to.

To begin accepting subscribers, simply add your list URL to the form `action` in the `source/_components/newsletter-signup.blade.php` file.

```html
<!-- source/_components/newsletter-signup.blade.php -->

<div id="mc_embed_signup">
    <form action="https://your-mail-chimp-list-manage-url" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
        <div id="mc_embed_signup_scroll">
            <h2>Sign up for newsletter</h2>
            <div class="mc-field-group">
                <label for="mce-EMAIL">Email Address </label>
                <input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL" placeholder="Email address">
            </div>
            <div id="mce-responses" class="clear">
                <div class="response" id="mce-error-response" style="display:none"></div>
                <div class="response" id="mce-success-response" style="display:none"></div>
            </div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->

            <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_25582686a9fc051afd5453557_189578c854" tabindex="-1" value=""></div>
            <div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
        </div>
    </form>
</div>
```

### Example

<img src="/assets/img/newsletter.png">

[See how to get your Mailchimp list URL.](https://mailchimp.com/help/host-your-own-signup-forms/#Edit_your_Custom_Signup_Form)
