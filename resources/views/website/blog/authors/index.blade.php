@extends('admin.layout.admin') @section( 'breadcrumbs' )
<!-- breadcrumbs -->
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9">
        <h2>Blog</h2>
        <ol class="breadcrumb">
            <li>
                <a href="/admin">Paínel de controle</a>
            </li>
            <li>Blog </li>
            <li class="active">Autores Cadastrados </li>
        </ol>
    </div>
    <div class="col-md-3 padding-btn-header text-right">
    <a href="{{ Route('blog-authors.create') }}" class="btn btn-success btn-sm">Novo</a>
    </div>
</div>
@endsection @section('content')
<div class="row">   
        @include('admin.blog.authors.list', [ 'authors' => $authors ] ) 
</div>
@endsection
@push('style')
<link rel="stylesheet" href="{{ asset('assets/theme-admin/css/plugins/OLForm/OLForm.css') }}">
@endpush
@push('script')
<!-- exclude -->
<script src="{{ asset('assets/theme-admin/js/plugins/OLForm/OLExclude.jquery.js') }}"></script>

<script>

@can('delete')
/*Exclude*/
$("#results").OLExclude({'action' : "{{ Route('blog-authors.destroy', [ 'id' => 1 ]) }}", 'inputCheckName' : 'exclude', 'inputCheckAll' : 'excludeAll'});
@endcan

</script>
@endpush
