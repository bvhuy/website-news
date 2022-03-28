
@foreach ($menus as $menu)
<li>
    <a title="{{ $menu->name }}" href="{{ $menu->ancestorsAndSelf($menu->id)->pluck('slug')->implode('/') }}">{{ $menu->name }}</a>
    @if (count($menu->children))
    <ul>
        @include('pages.components.menu-item', [
            'menus' => $menu->children,
        ])
    </ul>
    @endif
</li>
@endforeach

