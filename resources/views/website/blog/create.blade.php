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
            <li class="active">  @if(isset($blog)) Editar @else Criar @endif </li>
        </ol>
    </div>
    <div class="col-md-3 padding-btn-header text-right">
        <a href="javascript:saveBlog();" class="btn btn-primary btn-sm salvar">Salvar</a>
        <a href="{{ Route('blog.index') }}" class="btn btn-warning btn-sm">Voltar</a>
    </div>
</div>
@endsection @section('content')
<div class="row">
    <div class="col-md-6">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Dados da postagem</h5>
                <div class="ibox-tools">
                    <a class="collapse-link"> <i class="fa fa-chevron-up"></i> </a>
                </div>
            </div>
            <div class="ibox-content">
                <div class="row">
                    @if(isset($blog))
                    {!! Form::open(['route' => ['blog.update', 'id' => $blog->id], 'method' => 'PUT', 'id' =>
                    'form-blog']) !!}
                    {!! Form::hidden('id', $blog->id) !!}
                    @else
                    {!! Form::open(['route' => 'blog.store', 'method' => 'POST', 'id' => 'form-blog']) !!}
                    @endif
                    {!! Form::hidden('photo', null) !!}
                    {!! Form::hidden('categories', null) !!}
                    {!! Form::hidden('author', null) !!}
                    {!! Form::hidden('meta_title', null) !!}
                    {!! Form::hidden('meta_description', null) !!}
                    {!! Form::hidden('publish_at', null) !!}
                    {!! Form::hidden('unpublished_at', null) !!}
                    <div class="col-md-12">
                        <div class="form-group">
                            <label><span class="text-red">*</span> Nome</label>
                            {!! Form::text('title', isset($blog) ? $blog->title : null, ['placeholder' =>
                            'Título...','class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label><span class="text-red">*</span> Conteúdo</label>
                            {!! Form::textarea('content', isset($blog) ? $blog->content : null, ['placeholder' =>
                            'Escreva aqui...','class' => 'form-control', 'id' => 'content']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Categorias</h5>
                <div class="ibox-tools">
                    <a class="collapse-link"> <i class="fa fa-chevron-up"></i> </a>
                </div>
            </div>
            <div class="ibox-content">
                <div class="row">                    
                        @if(count($categories) > 0)
                        <div class="col-md-12">
                            <select name="categorie_temp" class="form-control">
                                <option value="">Selecione</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>  
                        <div class="col-md-12">
                            <div class="form-group" id="categories-selecteds">
                                
                            </div>
                        </div>
                        @else
                        <div class="col-md-12">
                            <div class="text-info text-center">
                                <br /><h3> Nenhuma Categoria encontrada!</h3><br />
                            </div>  
                        </div>          
                        @endif                        
                    
                </div>
            </div>
        </div>
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Autor</h5>
                <div class="ibox-tools">
                    <a class="collapse-link"> <i class="fa fa-chevron-up"></i> </a>
                </div>
            </div>
            <div class="ibox-content">
                <div class="row">
                    <div class="col-md-12">
                        @if(count($authors) > 0)
                            @php $author_selected = 0; @endphp   
                            
                            @if(isset($blog->author->author_id))  
                                @php $author_selected = $blog->author->author_id; @endphp 
                            @endif
                                
                            <select name="author_temp" class="form-control">
                                <option value="">Selecione</option>
                                @foreach($authors as $author)
                                    <option value="{{ $author->id }}" @if($author_selected == $author->id) selected="selected" @endif>{{ $author->name }}</option>
                                @endforeach
                            </select>
                        @else
                        <div class="text-info text-center">
                            <br /><h3> Nenhum Autor encontrado!</h3><br />
                        </div> 
                        @endif
                    </div>
                </div>
            </div>
        </div>
        
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Datas</h5>
                <div class="ibox-tools">
                    <a class="collapse-link"> <i class="fa fa-chevron-up"></i> </a>
                </div>
            </div>
            <div class="ibox-content">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Começar a exibir em:</label>
                            {!! Form::text('publish_at_temp', isset($blog) ? $blog->publish_at : null, ['placeholder' =>
                            'Exibir a partir de...','class' => 'form-control']) !!}
                            
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Deixar de exibir em:</label>
                            {!! Form::text('unpublished_at_temp', isset($blog) ? $blog->unpublished_at : null, ['placeholder' =>
                            'Exibira até a data...','class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Imagem de destaque</h5>
                <div class="ibox-tools">
                    <a class="collapse-link"> <i class="fa fa-chevron-up"></i> </a>
                </div>
            </div>
            <div class="ibox-content">
                <div class="row">
                    <div class="col-md-12">
                        @if(isset($blog->photo))
                        <div class="img-fake"> <img src="{{ $blog->photo->content }}"> </div>
                        <a href="javascript:;" class="btn btn-block btn-sm btn-danger text-uppercase"
                            id="remove-image">Remover a imagem</a>
                        @else
                        <div class="img-fake hollow"> </div>
                        <a href="javascript:;" class="btn btn-block btn-sm btn-danger text-uppercase hidden"
                            id="remove-image">Remover a imagem</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Meta Tags</h5>
                <div class="ibox-tools">
                    <a class="collapse-link"> <i class="fa fa-chevron-up"></i> </a>
                </div>
            </div>
            <div class="ibox-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label id="label_meta_title">Meta title</label>
                            {!! Form::text('meta_title_temp', isset($blog) ? $blog->meta->title : null, ['placeholder' =>
                            'Meta Title...','class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label id="label_meta_description">Meta Description</label>
                            {!! Form::text('meta_description_temp', isset($blog) ? $blog->meta->description : null, ['placeholder' =>
                            'Meta Description...','class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- modal files -->
@include('admin.files.modal');
<!-- inputs routes -->
{!! Form::hidden( 'url_return', Route('blog.index') ) !!}
{!! Form::hidden( 'url_files_get_all', Route('files-get-all') ) !!}
{!! Form::hidden( 'url_create_folder', Route('create-folder') ) !!}
{!! Form::hidden( 'url_send_files', Route('send-files') ) !!}
@endsection
@push('style')
<link rel="stylesheet" href="{{ asset('assets/theme-admin/css/plugins/OLForm/OLForm.css') }}">
<link rel="stylesheet" href="{{ asset('assets/theme-admin/js/plugins/summernote/summernote.css') }}">
<link rel="stylesheet" href="{{ asset('assets/theme-admin/css/blog.css') }}">
@endpush
@push('script')
<script src="{{ asset('assets/theme-admin/js/main.js') }}"></script>
<!-- form -->
<script src="{{ asset('assets/theme-admin/js/plugins/OLForm/OLForm.jquery.js') }}"></script>
<!-- images -->
<script src="{{ asset('assets/theme-admin/js/plugins/OLForm/OLFiles.jquery.js') }}"></script>
<!-- include summernote css/js -->
<script src="{{ asset('assets/theme-admin/js/plugins/summernote/summernote.js') }}"></script>
<script src="{{ asset('assets/theme-admin/js/plugins/summernote/lang/summernote-pt-BR.js') }}"></script>
<script src="{{ asset('assets/theme-admin/js/plugins/OLForm/imageSummerNote.js') }}"></script>
<!-- contables -->
<script src="{{ asset('assets/theme-admin/js/plugins/OLForm/OLInputCount.jquery.js') }}"></script>
<!-- blog -->
<script src="{{ asset('assets/theme-admin/js/blog-create.js') }}"></script>
@if(isset($blog->categories))
<script>
    @foreach( $blog->categories as $value )
        setCategorie("{{ $value->name }}", "{{ $value->id }}");
    @endforeach
</script>
@endif
@endpush