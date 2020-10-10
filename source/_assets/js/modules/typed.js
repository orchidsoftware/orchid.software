document.addEventListener('DOMContentLoaded', () => {

    if (document.getElementById('typed') == null) {
        return;
    }

    var options = {
        loop: true,
        strings: [
            'admin panels',
            'dashboards',
            'control panels',
            'crud interfaces',
            'user panels',
        ],
        typeSpeed: 50
    };


    if(window.screen.width > 1000){
        options.strings.push('back office applications');
    }

    var typed = new Typed(document.getElementById('typed'), options);
});


