# {{ $name }}

{{ $description }}

@foreach ($navigation as $section => $items)

## {{ $section }}
@foreach ($items as $title => $url)
- [{{ $title }}]({{ $url }})
@endforeach

@endforeach
