document.addEventListener('DOMContentLoaded', () => {

    if (document.getElementById('typed') == null) {
        return;
    }

    var options = {
        loop: true,
        strings: [
            'admin panels',
            'back-offices application',
            'control panels',
            'crud interfaces',
            'user panels',
            'dashboards',
        ],
        typeSpeed: 50
    };

    var typed = new Typed(document.getElementById('typed'), options);
});


