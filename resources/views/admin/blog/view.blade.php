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
            
        </ol>
    </div>
    <div class="col-md-3 padding-btn-header text-right">
        <a href="{{ Route('blog.create') }}" class="btn btn-success btn-sm">Nova Postagem</a>
    </div>
</div>
@endsection @section('content')
<div class="row">
    <div class="col-md-10">
    <div class="ibox float-e-margins">
          <div class="ibox-title">
              <h5>Postagens Cadastradas</h5>
              <div class="ibox-tools">
                  <a class="collapse-link"> <i class="fa fa-chevron-up"></i>  </a>
              </div>
          </div>
          <div class="ibox-content">
              <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered table-striped" id="results">
                        <thead>
                            <tr>
                                <td width="10"><input type="checkbox" name="excludeAll"></td>
                                <td width="150"></td>
                                <td>Título / Autor / Categorias</td>
                                <td>Datas</td>
                                <td width="50">Visualizar</td>
                                <td width="50">Status</td>
                                <td width="50">Destaque</td>
                                <td width="50">Editar</td>
                            </tr>
                        </thead>
                        <tbody>                            
                            @forelse($blogs as $blog)
                                <tr>
                                    <td><input type="checkbox" name="exclude" value="{{ $blog->id }}"> </td>
                                    <td>
                                        <img src="{{ $blog->photo->content }}"  class="img-responsive">
                                    </td>
                                    <td>
                                    <p>{{ $blog->title }}</p>
                                    <p>{{ $blog->author->name }}</p>
                                    @foreach($blog->categories as $categorie)
                                        <span class="badge badge-info badge-lg">
                                            {{ $categorie->name }}
                                        </span>
                                    @endforeach                          
                                    </td>
                                    <td>
                                    <p> Atualizado em: {{ $blog->updated_at }}</p>
                                    <p>Exibir em: {{ $blog->publish_at }}</p>
                                    <p>Exibir até: {{ $blog->unpublished_at }}</p>                                    
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ Route('blog.show', ['id' => $blog->id ]) }}" target="_view" title="Visualizar" class="btn btn-info btn-sm">
                                            <i class="fa fa-share" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        @include('admin.includes.btn_status', [ 'status' => $blog->status, 'id' => $blog->id ])
                                    </td>
                                    <td class="text-center">
                                        @include('admin.includes.btn_featured', [ 'featured' => $blog->featured, 'id' => $blog->id ])
                                    </td>
                                    <td class="text-center">
                                        @include('admin.includes.btn_edit', [ 'route' => route('blog.edit', ['id' => $blog->id]) ])
                                    </td>
                                </tr>
                                
                            @empty
                            <tr>
                                <td colspan="8" class="text-info text-center">
                                    <br /><br /><h3> Nenhum resultado encontrado! </h3><br />
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
              </div>
          </div>
      </div>
    </div>
</div>

<!-- inputs -->
{!! Form::hidden('update_route', Route('blog-status', [ 'id' => false ])) !!}
{!! Form::hidden('destroy_route', Route('blog.destroy', [ 'id' => 1 ]) ) !!}
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
$("#results").OLExclude({'action' : $("input[name=destroy_route]").val(), 'inputCheckName' : 'exclude', 'inputCheckAll' : 'excludeAll'});
@endcan
/* Featured OR status */
$(document).on("click", "a.btn-featured:not(.disabled), a.btn-status:not(.disabled)", function(){
    var $this, id, status, _n_status, data, method, css, title, data_name;
    $this = $(this); //this
    id = $this.attr("data-id"); //id

    if($this.hasClass('btn-featured'))
    {
        css = 'btn-featured';
        title = {'online' : 'Destacar?', 'offline' : 'Remover destaque?'};
        data_name = 'data-fetaured';
        status = $this.attr("data-featured"); //real status
        _n_status = ( status == 1) ? 0 : 1; // new status 
        data = {'featured' : _n_status}; //data send
    }else
    {
        css = 'btn-status';
        title = {'online' : 'Colocar Online?', 'offline' : 'Colocar Offline?'};
        data_name = 'data-status';
        status = $this.attr("data-status"); //real status
        _n_status = ( status == 1) ? 0 : 1; // new status 
        data = {'status' : _n_status}; //data send
    }
       
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
