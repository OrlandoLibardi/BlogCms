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
    @include('admin.blog.comments.list', [ 'comments' => $comments ] ) 
</div>

<div id="form-response" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Escrever uma Resposta</h4>
      </div>
      <div class="modal-body">
        {!! Form::open(['route' => 'blog-comments.store', 'method' => 'POST', 'id' => 'form-reply']) !!}
        {!! Form::hidden('parent_id') !!}
        {!! Form::hidden('blog_id') !!}
        {!! Form::hidden('status', 1) !!}
        <div class="row">
            <div class="modal-response"></div>
            <div class="col-md-6">
                <div class="form-group">
                <label><span class="text-red">*</span> Nome</label>
                {!! Form::text('name', Auth::user()->name, ['placeholder' => 'Nome...','class' => 'form-control']) !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                <label><span class="text-red">*</span> E-mail</label>
                {!! Form::text('email', Auth::user()->email, ['placeholder' => 'Nome...','class' => 'form-control']) !!}
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                <label><span class="text-red">*</span> Título</label>
                    {!! Form::text('title', null, ['placeholder' => 'Título...','class' => 'form-control']) !!}                    
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                <label><span class="text-red">*</span> Comentário</label>
                    {!! Form::textarea('comment', null, ['placeholder' => 'Comentário...','class' => 'form-control']) !!}                    
                </div>
            </div>
        </div>
        {!! Form::close() !!}
      </div>
      <div class="modal-footer">
      <a href="javascript:saveReply();" class="btn btn-primary btn-sm salvar">Salvar</a>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
{!! Form::hidden('update_route', Route('blog-comment-status', [ 'id' => false ])) !!}
{!! Form::hidden('destroy_route', Route('blog-comments.destroy', [ 'id' => 1 ]) ) !!}
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

@can('delete')
/*Exclude*/
$("#results").OLExclude({'action' : $("input[name=destroy_route]").val(), 'inputCheckName' : 'exclude', 'inputCheckAll' : 'excludeAll'});
@endcan

/* Formulário */
$("#form-reply").OLForm({btn : true, listErrorPosition: 'before', listErrorPositionBlock: '.modal-response', urlRetun : "{{ Route('blog-comments.index') }}" });

$(document).on("click", "a.reply", function(){
    $("#olform-error-list").remove();
    $("input[name=parent_id]").val($(this).attr("data-parent"));
    $('input[name=blog_id]').val($(this).attr("data-blog"));

    $("input[name=titel], textarea[name=comment]").val("");
    $("#form-response").modal('show');
});

function saveReply()
{
    $("#form-reply").submit();
}
/* Featured OR status */
$(document).on("click", "a.btn-status:not(.disabled)", function(){

    var $this, id, status, _n_status, data, method, css, title, data_name;
    $this = $(this); //this
    id = $this.attr("data-id"); //id
    css = 'btn-status';
    title = {'online' : 'Colocar Online?', 'offline' : 'Colocar Offline?'};
    data_name = 'data-status';
    status = $this.attr("data-status"); //real status
    _n_status = ( status == 1) ? 0 : 1; // new status 
    data = {'status' : _n_status}; //data send
       
    url = $("input[name=update_route").val() + "/" + id //url send
    method = 'PATCH';

    //Disable this
    $this.addClass("disabled"); 
    //send
    sendPutch(data, url, method);
    
    toggleStatus($this, status, css, title, data_name); 

    $this.removeClass("disabled");   
  
});


function sendPutch(data, url, method)
{
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr("content") } });
    $.ajax({
        data: data,
        method: method,
        url: url,
        success: function(exr) {
            console.log(exr);
            return true;
        },
        error: function(exr, sender) {
           console.log(exr);
           return false;
        }
    });
}

function toggleStatus($this, status, css, title, data_name)
{
    if(status == 1){
        $this.attr("class", "btn btn-default btn-sm " + css)
             .attr(data_name, 0)
             .attr("title", title['online']);
    }else{
        $this.attr("class", "btn btn-primary btn-sm " + css)
             .attr(data_name, 1)
             .attr("title", title['offline']);
    }
}

</script>
@endpush
