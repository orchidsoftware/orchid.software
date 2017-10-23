<script>
function popupCenter(url, title, w, h) {
    var left = (screen.width / 2) - (w / 2);
    var top = (screen.height / 2) - (h / 2);
    return window.open(url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);
}
</script>


<a onclick="popupCenter('http://vk.com/share.php?url={{url()->current()}}', '',600,400);"
   href="javascript:void(0);" class="btn btn-icon btn-rounded b"><i
            class="fa fa-vk"></i></a>

<a onclick="popupCenter('http://www.ok.ru/dk?st.cmd=addShare&st.s=1&st._surl={{url()->current()}}', '',600,400);"
   href="javascript:void(0);" class="btn btn-icon btn-rounded b"><i
            class="fa fa-odnoklassniki"></i></a>

<a onclick="popupCenter('http://www.facebook.com/sharer.php?u={{url()->current()}}', '',600,400);"
   href="javascript:void(0);" class="btn btn-icon btn-rounded b"><i
            class="fa fa-facebook"></i></a>

<a onclick="popupCenter('https://plus.google.com/share?url={{url()->current()}}', '',600,400);"
   href="javascript:void(0);" class="btn btn-icon btn-rounded b"><i
            class="fa fa-google-plus"></i></a>

<a onclick="popupCenter('https://twitter.com/share?url={{url()->current()}}', '',600,400);"
   href="javascript:void(0);" class="btn btn-icon btn-rounded b"><i
            class="fa fa-twitter"></i></a>
