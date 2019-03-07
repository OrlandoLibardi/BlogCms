@if($items)

    @foreach($items as $item)
        @if($item->image_small)
            <img src="{{ $item->image_small }}"  alt="{{ $item->title }}">
        @endif 
        <h1> <a href="{{ Route('page-blog', ['alias' => $item->alias ]) }}" title="{{ $item->title }}">{{ $item->title }}</a> </h1>
        <p><a href="{{ Route('page-blog', ['alias' => $item->alias ]) }}" title="{{ $item->title }}">{{ $item->summary }}</a></p>
    @endforeach

    @if(method_exists($items,'links') )
        {{ $items->links() }}
    @endif
    
@endif