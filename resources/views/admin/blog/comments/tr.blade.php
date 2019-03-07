@php $ii = 1 @endphp
@foreach($childs as $comment)

    <tr>
        <td><input type="checkbox" name="exclude" value="{{ $comment->id }}"> </td>
        <td>{{ $i }}.{{$ii}}</td>
        <td>
        @php $blog_id = ""; @endphp
        @foreach($comment->blog as $blog)
            {{ $blog->title }}
            @php $blog_id = $blog->id @endphp
        @endforeach
        </td>
        <td>{{ $comment->name }}<br /> {{ $comment->email }}</td>                                      
        <td>{{ $comment->created_at }}</td>
        <td>
        {{ $comment->title }}<br />
        {{ $comment->comment }}
        </td>
        <td class="text-center">
            <a href="javascript:;" data-parent="{{ $comment->id }}" data-blog="{{ $blog_id }}" title="Responder" class="btn btn-info btn-sm reply">
                 <i class="fa fa-reply" aria-hidden="true"></i>
            </a>
        </td>
        <td class="text-center">
            @include('admin.includes.btn_status', ['status' => $comment->status, 'id' => $comment->id])
        </td>
        <td class="text-center">
            @include('admin.includes.btn_edit', [ 'route' => route('blog-comments.edit', ['id' => $comment->id]) ])
        </td>
    </tr>
@if(count($comment->reply) > 0)
  @php $iii = $i . '.' .$ii; @endphp
  @include('admin.blog.comments.tr', ['childs' => $comment->reply, 'i' => $iii])
@endif
@php $ii++ @endphp
@endforeach
