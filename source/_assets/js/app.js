var Turbolinks = require("turbolinks");
Turbolinks.start();

window.$ = window.jQuery = require('jquery');

window.Popper = require('popper.js').default;
require('bootstrap');

require('./modules/icons');
require('./modules/prism');
require('./modules/docs');

/*
if ('serviceWorker' in navigator) {
    navigator.serviceWorker
        .register('./js/worker.js')
        .then(function() { console.log('Service Worker Registered'); });
}
*/