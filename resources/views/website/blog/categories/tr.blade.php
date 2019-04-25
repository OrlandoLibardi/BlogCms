@php $ii = 1 @endphp
@foreach($childs as $category)
    <tr>
        <td><input type="checkbox" name="exclude" value="{{ $category->id }}"> </td>
        <td>{{ $i }}.{{$ii}}</td>
        <td>- {{ $category->name }}</td>
        <td>{{ $category->alias }}</td>
        <td>{{ $parent_name }}</td>
        <td>@include('admin.includes.btn_status', [ 'status' => $category->status, 'id' =>  $category->id])</td>
        <td class="text-center">
            @include('admin.includes.btn_edit', [ 'route' => route('blog-categories.edit', ['id' => $category->id]) ])
        </td>
    </tr>
@if(count($category->childs) > 0)
  @php $iii = $i . '.' .$ii; @endphp
  @include('admin.blog.categories.tr', ['childs' => $category->childs, 'i' => $iii, 'parent_name' => $category->name])
@endif
@php $ii++ @endphp
@endforeach
