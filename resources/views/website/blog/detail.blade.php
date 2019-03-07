@if($item)


@if($item->meta)
    {{ $item->meta->title }}
    {{ $item->meta->description }}
@endif

@if($item->image_larger)
   <img src="{{ $item->image_larger }}">
@endif

<h1>{{ $item->title }}</h1>
<div>
    {!! $item->content !!}
</div>

{{ $item->publish_at }}

@if($item->author)
    {{ $item->author->name }}
    {!! $item->author->about !!}
    {{ $item->author->photo }}
@endif

    {!! OlCmsBlog::related(['exclude' => $item->id, 'categories' => $item->categories->pluck('id'), 'limit' => 10 ] ) !!}

    {!! OlCmsBlog::commentForm( $item->id ) !!}    
    {!! OlCmsBlog::commentList( $item->id ) !!}

@endif