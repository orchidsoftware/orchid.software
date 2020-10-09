document.addEventListener('DOMContentLoaded', () => {

    if (document.getElementById('typed') == null) {
        return;
    }

    var options = {
        loop: true,
        strings: [
            'admin panel',
            'back-office',
            'control panel',
            'crud interface',
            'user panel',
            'dashboard',
        ],
        typeSpeed: 50
    };

    var typed = new Typed(document.getElementById('typed'), options);
});


