<div class="form-group">
    <label>{{$title}}</label>
   <ul id="sortable-{{$slug}}">


       @foreach($value as $key => $item)
           <li class="ui-state-default">
            <input type="text" name="{{$prefix}}[{{$lang}}][{{$tag}}][{{$slug}}][{{$key}}]" class="form-control pull-right" value="{{$value}}">
        </li>
       @endforeach
       <li class="ui-state-default">
           <input type="text" name="{{$prefix}}[{{$lang}}][{{$tag}}][{{$slug}}][]" class="form-control pull-right" value="">
       </li>
    </ul>
</div>
<div class="line line-dashed b-b line-lg"></div>
<script>
    $(function() {
        $( "#sortable-{{$slug}}" ).sortable({
            placeholder: "ui-sortable-placeholder",
            update:function(event,ui){
                $("#sortable-{{$slug}} li").each(function (li) {
                    $(this).find('input').attr({'name': '{{$prefix}}[{{$lang}}][{{$tag}}][{{$slug}}]['+li+']'})
                })
            }
        });
    });
</script>
