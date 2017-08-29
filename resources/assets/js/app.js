

require('./bootstrap');

require('./modules/scroll');
require('./modules/affix');
require('./modules/wizard');
require('./modules/typed');


window.Vue = require('vue');


const moment = require('moment');
require('moment/locale/ru');

/*
var Turbolinks = require("turbolinks")
Turbolinks.start()
}

document.addEventListener("turbolinks:load", function() {
 $(window).trigger("load");
 dispatchEvent(new Event('load'));


 window.wow = new WOW(
     {
         boxClass:     'wow',      // animated element css class (default is wow)
         animateClass: 'animated', // animation css class (default is animated)
         offset:       0,          // distance to the element when triggering the animation (default is 0)
         mobile:       true,       // trigger animations on mobile devices (default is true)
         live:         true,       // act on asynchronously loaded content (default is true)
         callback:     function(box) {
             // the callback is fired every time an animation is started
             // the argument that is passed in is the DOM node being animated
         },
         scrollContainer: null,    // optional scroll container selector, otherwise use window,
         resetAnimation: false,     // reset animation on end (default is true)
     }
 );
 wow.init();
})
*/


window.Prism = require('prismjs');
require('prismjs/components/prism-javascript');
require('prismjs/components/prism-php');

Prism.highlightAll();
