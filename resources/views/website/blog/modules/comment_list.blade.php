@if(isset($comments))
    @foreach($comments as $comment)
        <h3>{{ $comment->title }}</h3>
        <h5>{{ $comment->name }} {{ $comment->email }}</h5>
        <h6>{{ $comment->created_at }} </h6>
        <p>{!! $comment->comment !!}</p>
    @endforeach
@endif