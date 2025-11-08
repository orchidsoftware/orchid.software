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




document.querySelectorAll('.documentation main img').forEach(function(el) {
    el.addEventListener('click', function(){
        var src = this.getAttribute('src');
        var div = document.createElement('div');
        div.style.cssText = `background: RGBA(0,0,0,.5) url('${src}') no-repeat center;
        background-size: contain;
        width:100%; height:100%;
        position:fixed;
        z-index:10000;
        top:0; left:0;
        cursor: zoom-out;
        background-size: contain;`;
        div.addEventListener('click', function() {
            document.body.removeChild(this);
        });
        document.body.appendChild(div);
    });
});
