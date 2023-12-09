@props(['photopath','id','title','w','h','route'])

@if ($photopath != null)
@if ($route != '#')
<a href="{{ route($route, ['id' => $id]) }}">
    @endif
    <img class="{{ $w }} {{ $h }} mx-auto rounded-full"
        src="{{ Str::startsWith($photopath, 'http') ? $photopath : asset('storage/'.$photopath) }}"
        alt="{{ $title }}" title="{{ $title }}">
    </img>
    @if ($route != '#')
</a>
@endif
@else
@if ($route != '#')
<a href="{{ route($route, ['id' => $id]) }}">
    @endif
    <img src="/storage/profile-photos/emptyUser.jpg"
        class="{{ $w }} {{ $h }} bg-gray-300 rounded-full  shrink-0 mx-auto"
        title="{{ $title }}" alt="{{ $title }}">
    </img>
    @if ($route != '#')
</a>
@endif
@endif
