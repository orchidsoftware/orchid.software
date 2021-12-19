import Prism from 'prismjs';

Prism.manual = true;

document.addEventListener("DOMContentLoaded", () => {
    [...document.querySelectorAll('pre code')].forEach(el => {
        Prism.highlightElement(el);
    });
});
