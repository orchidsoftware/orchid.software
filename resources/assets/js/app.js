
var Turbolinks = require("turbolinks");
Turbolinks.start();


document.addEventListener("turbolinks:load", function() {
    require('./bootstrap');
    require('./modules/popupCenter');
});

require('./modules/typed');
require('./modules/icons');
require('./modules/prism');
require('./modules/docs');

if ('serviceWorker' in navigator) {
    navigator.serviceWorker
        .register('./js/worker.js')
        .then(function() { console.log('Service Worker Registered'); });
}
