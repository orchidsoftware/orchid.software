<div class="avatars">
    @foreach($contributors as $contributor)
        <img src="{{ $contributor['avatar_url'] }}" alt="{{ $contributor['login'] }}"
             width="48" height="48" loading="lazy">
    @endforeach
</div>
