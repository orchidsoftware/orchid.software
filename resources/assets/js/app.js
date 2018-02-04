
var Turbolinks = require("turbolinks");
Turbolinks.start();


document.addEventListener("turbolinks:before-visit", function (event) {
    // console.info(`Network Call Avoidance Workaround (for Turbolinks) attempting to short-circuit network calls.`);
    var origin = window.location.href; // Current URL
    var destination = event.data.url; // Destination URL
    // Make sure both destination and origin urls end with "/" unless they contain an "#"
    if ((origin.match(/#/) === null) && origin[origin.length - 1] !== "/")
        origin = origin + '/';
    if ((destination.match(/#/) === null) && destination[destination.length - 1] !== "/")
        destination = destination + '/';
    // console.info(`Origin: ${origin}`);
    // console.info(`Destination: ${destination}`);
    // Prevent Turbolinks from doing anything when clicking on a link to the current page
    if (origin === destination) {
        // console.info("Turbolinks stopped since origin and destination URLs are identical.");
        event.preventDefault();
        if (origin.match(/#/) !== null) {
            // console.info(`Letting browser navigate to: ${destination}`);
            window.location.href = destination;
        }
        else {
            // Gives user feedback for clicking link to current page.
            // console.info(`Giving user fake feedback since link points to current page.`)
            var tpb = new Turbolinks.ProgressBar();
            tpb.setValue(0);
            tpb.show();
            tpb.setValue(0.2);
            setTimeout(function () { tpb.setValue(1); tpb.hide(); }, 100);
        }
        return;
    }
    var shorterLength = Math.min(origin.length, destination.length);
    // To handle the cases where both origin and destination URLs contain "#".
    // Only intended to prevent page reloads for anchor links within current page.
    if (((origin.match(/#/) !== null) && (destination.match(/#/) !== null)) &&
        (origin.indexOf("#") === destination.indexOf("#"))) {
        // console.info("Detected that both origin and destination have same index for #");
        shorterLength = Math.min(origin.indexOf("#"), destination.indexOf("#"));
    }
    // console.info(`shorterLength: ${shorterLength}`);
    // See if the first `shorterLength` characters of both the origin and destination URLS are the same.
    // If these characters are not the same, do nothing.
    if (origin.substring(0, shorterLength) !== destination.substring(0, shorterLength)) {
        // console.info(`Turbolinks not stopped since first ${shorterLength} characters of origin and destination URL are different.`);
        return;
    }
    // console.info(`The first ${shorterLength} chars of both origin and destination URLs are identical`);
    // If the destination URL contains an "#" immediately after the first `shorterLength` characters, let
    // the browser navigate to the URL. In this case the origin URL would be desination URL without the hash.
    if (destination.length > shorterLength && destination[shorterLength] === "#") {
        // console.info("Turbolinks stopped since destination URL is a bookmark on the current page.");
        event.preventDefault();
        // console.info(`Letting browser navigate to: ${destination}`);
        window.location.href = destination;
        return;
    }
    // If the origin URL contains an "#" immediately after the first `shorterLength` characters, do nothing.
    // In this case the destination URL would be the origin URL without the hash.
    if (origin.length > shorterLength && origin[shorterLength] === "#") {
        // console.info("Turbolinks stopped since trying to navigate to current page's URL without hash.");
        event.preventDefault();
        return;
    }
    // Note that either destination or origin is substring within the other (starting at index 0) if this function hasn't already returned.
    // console.info("Turbolinks not stopped since there is no reason to do so.");
});



    require('./bootstrap');
    require('./modules/affix');
    require('./modules/typed');
    require('./modules/icons');

    window.Prism = require('prismjs');
    require('prismjs/components/prism-javascript');
    require('prismjs/components/prism-php');


document.addEventListener("turbolinks:load", function() {
    Prism.highlightAll();
});
