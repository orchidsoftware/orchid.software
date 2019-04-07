document.addEventListener("turbolinks:load", function() {
    $('.code-preview').hide();
    $('.show-code').click(function (e) {
        $(this).children('.name').toggle();
        $(this).children('.code-preview').toggle();
        e.stopPropagation();
        return false;
    });
    $("#quick-search").keyup(function () {
        var srch = $(this).val().trim().toLowerCase();
        $(".icon-preview-box").hide()
            .filter(function () {
                return $(this).html().trim().toLowerCase().indexOf(srch) != -1;
            }).show();
    });
});
