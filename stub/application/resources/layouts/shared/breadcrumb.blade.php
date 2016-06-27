<ul>
    @foreach($path as $crumb)
        <li><a href="{{ $crumb->url }}">{{ $crumb->title }}</a></li>
    @endforeach
</ul>
