import Prism from 'prismjs';

Prism.manual = true;

document.addEventListener("DOMContentLoaded", () => {
    [...document.querySelectorAll('pre code')].forEach(el => {
        Prism.highlightElement(el);
    });
});

document.addEventListener("DOMContentLoaded", () => {

    if (window.location.href.includes('#')) {
        return false;
    }

    document.querySelector('.active-doc-menu').scrollIntoView({
        behavior: "auto",
        block: "end",
        inline: "center"
    })
});
