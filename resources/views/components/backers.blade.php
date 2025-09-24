<div class="mx-auto text-center">
    @foreach($backers as $backer)
        <img src="{{$backer['image'] ?? 'https://avatar.oxro.io/avatar.svg?name='.$backer['name'] }} "
             width="54px" height="54px" class="rounded-circle m-2 d-inline-block shadow border border-dark" loading="lazy">
    @endforeach
</div>
