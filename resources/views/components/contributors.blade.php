<div class="d-block text-decoration-none">
    @foreach($contributors as $contributor)
        <img src="{{$contributor['avatar_url']}}" width="48px" height="48px"
             class="rounded-circle m-1 border border-dark shadow" loading="lazy">
    @endforeach
</div>
