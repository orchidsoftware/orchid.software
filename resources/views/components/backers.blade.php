<div class="avatars backers">
    @foreach($backers as $backer)
        <img src="{{ $backer['image'] ?? 'https://avatar.oxro.io/avatar.svg?name='.$backer['name'] }}" alt="{{ $backer['name'] }}"
             width="54" height="54" loading="lazy">
    @endforeach
</div>
