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
            <li class="active">Autores </li>
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
              <h5>@if(isset($author)) Editar @else Criar @endif um Autor</h5>
              <div class="ibox-tools">
                  <a class="collapse-link"> <i class="fa fa-chevron-up"></i>  </a>
              </div>
          </div>
          <div class="ibox-content">
              <div class="row">
                     @if(isset($author))
                        {!! Form::open(['route' => ['blog-authors.update', 'id' => $author->id], 'method' => 'PUT', 'id' => 'form-author']) !!}
                        {!! Form::hidden('id', $author->id) !!}
                     @else   
                        {!! Form::open(['route' => 'blog-authors.store', 'method' => 'POST', 'id' => 'form-author']) !!}
                     @endif
                     {!! Form::hidden('photo', null) !!}
                     <div class="col-md-6">
                         <div class="form-group">
                             <label><span class="text-red">*</span> Nome</label>
                             {!! Form::text('name', isset($author) ? $author->name : null, ['placeholder' => 'Nome...','class' => 'form-control']) !!}
                         </div>
                     </div>
                     <div class="col-md-6">
                         <div class="form-group">
                             <label><span class="text-red">*</span> E-mail</label>
                             {!! Form::text('email', isset($author) ? $author->email : null, ['placeholder' => 'E-mail...','class' => 'form-control']) !!}
                         </div>
                     </div>
                     <div class="col-md-12">
                         <div class="form-group">
                             <label> Sobre</label>
                             {!! Form::textarea('about', isset($author) ? $author->about : null, ['placeholder' => 'Fale sobre...','class' => 'form-control', 'id' => 'about']) !!}
                         </div>
                     </div>
                     {!! Form::close() !!}

              </div>
          </div>
      </div>
    </div>
    <div class="col-md-4">
    <div class="ibox float-e-margins">
          <div class="ibox-title">
              <h5>Foto de Perfil</h5>
              <div class="ibox-tools">
                  <a class="collapse-link"> <i class="fa fa-chevron-up"></i>  </a>
              </div>
          </div>
          <div class="ibox-content">
              <div class="row">
                    <div class="col-md-12">
                        @if(isset($author->photo))
                        <div class="img-fake"> <img src="{{ $folder . $author->photo }}"> </div>
                        <a href="javascript:;" class="btn btn-block btn-sm btn-danger text-uppercase" id="remove-image">Remover a imagem</a>
                        @else
                        <div class="img-fake hollow"> </div>
                        <a href="javascript:;" class="btn btn-block btn-sm btn-danger text-uppercase hidden" id="remove-image">Remover a imagem</a>
                        @endif
                    </div>
              </div>
          </div>
      </div>
    </div>

</div>
@include('admin.files.modal')
@endsection
@push('style')
<link rel="stylesheet" href="{{ asset('assets/theme-admin/css/plugins/OLForm/OLForm.css') }}">
<link href="{{ asset('assets/theme-admin/js/plugins/summernote/summernote.css') }}" rel="stylesheet">
<style>
    .img-fake{
        display:block;
        width:100%;
        height:120px;
        margin-bottom:15px;
    }
    .img-fake > img{
        display:block;
        width:120px;
        height:120px;
        margin:0 auto;
        border-radius:50%;  
    }
   
    .img-fake.hollow:before{
        position: relative;
        float: left;
        width: 120px;
        height: 120px;
        font-family: 'FontAwesome';
        font-size: 6vh;
        text-align: center;
        content: "\f03e";
        background: #f3f3f4;
        line-height: 12vh;
        color: #676a6c; 
        border-radius:50%;     
        left: 50%;
        margin-left: -60px;
        cursor:pointer;
    }
</style>
@endpush
@push('script')
<!-- form -->
<script src="{{ asset('assets/theme-admin/js/plugins/OLForm/OLForm.jquery.js') }}"></script>
<!-- images -->
<script src="{{ asset('assets/theme-admin/js/plugins/OLForm/OLFiles.jquery.js') }}"></script>
<!-- include summernote css/js -->
<script src="{{ asset('assets/theme-admin/js/plugins/summernote/summernote.js') }}"></script>
<script src="{{ asset('assets/theme-admin/js/plugins/summernote/lang/summernote-pt-BR.js') }}"></script>

<script>
/* Formulário */
$("#form-author").OLForm({btn : false, listErrorPosition: 'after', listErrorPositionBlock: '.page-heading', urlRetun : "{{ Route('blog-authors.index') }}" });
/* Textarea */
$('#about').summernote({lang: 'pt-BR', toolbar: [ ['style', ['bold', 'italic', 'underline', 'clear']], ['font', ['fontsize', 'color']], ['para', ['table', 'paragraph']], ['misc', ['undo', 'redo', 'style', 'codeview']] ]});
/* Images */
/*Gerenciador de imagens*/
$("body").OLFiles({
    actionListFolders : "{{ Route('files-get-all') }}",
    actionCreateFolder : "{{ Route('create-folder') }}",
    actionOpenFile : changeImage,
    actionSendFile : "{{ Route('send-files') }}",
    initialFolder : "public/"
});
/*Open images list */
$(document).on("click", '.img-fake', function(){
    $("#modal-files").modal('show');
});
$(document).on("click", '#remove-image', function(){
    $("input[name=photo]").val('');
    $(".img-fake").addClass("hollow").html('');
    $(this).addClass("hidden");
});
/*Alterar a imagem*/
function changeImage(a){
    $("input[name=photo]").val(a);
    $(".img-fake").removeClass("hollow").html('<img src="'+a+'">');
    $("#remove-image").removeClass("hidden");
    $("#modal-files").modal('hide');
}

</script>
@endpush
