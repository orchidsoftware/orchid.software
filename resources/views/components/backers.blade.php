<div class="mx-auto mb-4 text-center text-md-start">
    @foreach($backers as $backer)
        <img src="{{$backer['image'] ?? 'https://avatar.oxro.io/avatar.svg?name='.$backer['name'] }} "
             width="48px" height="48px" class="rounded-circle m-1 d-inline-block border" loading="lazy">
    @endforeach
</div>
