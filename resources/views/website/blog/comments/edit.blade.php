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
            <li class="active">Comentários </li>
        </ol>
    </div>
    <div class="col-md-3 padding-btn-header text-right">
   
    </div>
</div>
@endsection @section('content')
<div class="row">   
    <div class="col-md-6">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Editar um comentário</h5>
                <div class="ibox-tools">
                    <a class="collapse-link"> <i class="fa fa-chevron-up"></i>  </a>
                </div>
            </div>
            <div class="ibox-content">
                {!! Form::open(['route' => ['blog-comments.update', 'id' => $comment->id], 'method' => 'PUT', 'id' => 'comment-form']) !!}
                
                {!! Form::hidden('id', $comment->id) !!}
                
                {!! Form::hidden('parent_id', $comment->parent_id) !!}

                @foreach($comment->blog as $blog)     
                    {!! Form::hidden('blog_id', $blog->id) !!}
                @endforeach

                {!! Form::hidden('status',  $comment->status) !!}
                {!! Form::hidden('name', $comment->name) !!}
                {!! Form::hidden('email', $comment->email) !!}
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                        <label><span class="text-red">*</span> Título</label>
                            {!! Form::text('title', $comment->title, ['placeholder' => 'Título...','class' => 'form-control']) !!}                    
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                        <label><span class="text-red">*</span> Comentário</label>
                            {!! Form::textarea('comment', $comment->comment, ['placeholder' => 'Comentário...','class' => 'form-control']) !!}                    
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
        </div>
    </div>
</div>

@endsection
@push('style')
<link rel="stylesheet" href="{{ asset('assets/theme-admin/css/plugins/OLForm/OLForm.css') }}">
<style>
.olform-error-list{
    margin-bottom:15px;
}
</style>
@endpush
@push('script')
<!-- exclude -->
<script src="{{ asset('assets/theme-admin/js/plugins/OLForm/OLExclude.jquery.js') }}"></script>
<!-- form -->
<script src="{{ asset('assets/theme-admin/js/plugins/OLForm/OLForm.jquery.js') }}"></script>
<script>


/* Formulário */
$("#comment-form").OLForm({btn : false, listErrorPosition: 'before', listErrorPositionBlock: '.modal-response', urlRetun : "{{ Route('blog-comments.index') }}" });


</script>
@endpush
