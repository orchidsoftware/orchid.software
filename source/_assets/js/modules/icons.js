document.addEventListener("DOMContentLoaded", function() {
    $("#quick-search").keyup(function () {
        var srch = $(this).val().trim().toLowerCase();
        $(".icon-preview-box").hide()
            .filter(function () {
                return $(this).html().trim().toLowerCase().indexOf(srch) != -1;
            }).show();
    });
});
