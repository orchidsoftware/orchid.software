
var Turbolinks = require("turbolinks");
Turbolinks.start();


document.addEventListener("turbolinks:load", function() {
    require('./bootstrap');
});

require('./modules/typed');
require('./modules/icons');
require('./modules/prism');
