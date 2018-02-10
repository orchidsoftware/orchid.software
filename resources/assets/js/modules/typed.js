document.addEventListener("turbolinks:load", function() {

    if($('.typed-cursor').length > 0){
        return;
    }

    $(".main-typed-element").typed({
        strings: ["Platform", "CMF","Admin", "CMS", "Package"],
        typeSpeed: 0,
        loop: true
    });
});
