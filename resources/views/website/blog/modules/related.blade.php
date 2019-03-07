@if(isset($items))
    <h3>{{ __('titles.veja_tambem') }}</h3>

    @foreach($items as $item)

        @if($item->image_small)
            <img src="{{ $item->image_small }}"  alt="{{ $item->title }}">
        @endif 
        <h1> <a href="{{ Route('page-blog', ['alias' => $item->alias ]) }}" title="{{ $item->title }}">{{ $item->title }}</a> </h1>

        <p><a href="{{ Route('page-blog', ['alias' => $item->alias ]) }}" title="{{ $item->title }}">{{ $item->summary }}</a></p>
        
    @endforeach

    
@endif