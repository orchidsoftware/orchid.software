<!DOCTYPE html>
<html lang="{{ $locale }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $locale === 'ru' ? 'Документация Orchid' : 'Orchid documentation' }}</title>
    <link rel="canonical" href="{{ url(rtrim($target, '/')).'/' }}">
    <meta http-equiv="refresh" content="0;url={{ url(rtrim($target, '/')).'/' }}">
    <script>window.location.replace(@json($target) + window.location.search + window.location.hash);</script>
</head>
<body>
    <a href="{{ $target }}">{{ $locale === 'ru' ? 'Открыть документацию' : 'Open documentation' }}</a>
</body>
</html>
