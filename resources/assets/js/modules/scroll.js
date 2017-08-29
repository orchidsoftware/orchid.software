$(function () {
    $(document).on('click', '[data-ride="scroll"]', function (e) {
        e.preventDefault();
        var $target = this.hash;
        $('html, body').stop().animate({
            'scrollTop': $($target).offset().top - 80
        }, 1000, function () {
            window.location.hash = $target;
        });
    });
});
