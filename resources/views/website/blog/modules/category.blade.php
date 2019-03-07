@if($items)
    <ul>
    @foreach($items as $item)
        <li> <a href="{{ Route('page-blog', ['alias' => $item->alias ]) }}" title="{{ $item->name }}"> {{ $item->name }} </a> </li>
    @endforeach
    </ul>
@endif