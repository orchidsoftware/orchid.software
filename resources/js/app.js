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

    let nav = document.querySelector('.nav-docs')

    if (!nav) {
        return;
    }

    if (nav.scrollWidth <= nav.clientWidth) {
        return false;
    }

    document.querySelector('.active-doc-menu').scrollIntoView({
        behavior: "auto",
        block: "end",
        inline: "center"
    })
});

document.addEventListener("DOMContentLoaded", () => {
    let intersectionObserver = new IntersectionObserver((entries) => processIntersectionEntries(entries));


    [...document.querySelectorAll('.intersection')].forEach(element => {
        intersectionObserver.observe(element);
    });

});

// Private
function processIntersectionEntries(entries) {
    entries.forEach((entry) => {
        entry.target.classList.toggle('show', entry.isIntersecting);
    });
}
