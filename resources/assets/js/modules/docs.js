document.addEventListener("turbolinks:load", () => {
    $("#docs-search").keyup(function(){
        const srch = $(this).val().trim();

        if(srch.length < 1){
            $('#docs-search-result').addClass('hidden');
            return;
        }

        setTimeout(() => {

            console.log($("#docs-search").val().trim().toString(),srch);

            if($("#docs-search").val().trim().toString() !== srch){
                return;
            }

            axios({
                method: 'post',
                url: `/docs/search/${srch}`,
            }).then(response => {
                $('#docs-search-result').html(response.data).removeClass('hidden');
            });


        }, 340);

    });
});