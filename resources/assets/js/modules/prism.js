document.addEventListener("turbolinks:load", function() {
    window.Prism = require('prismjs');
    require('prismjs/components/prism-javascript');
    require('prismjs/components/prism-php');
    Prism.highlightAll();
});
