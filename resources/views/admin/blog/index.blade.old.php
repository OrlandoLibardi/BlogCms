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
            <li class="active"> Postagens Cadastradas </li>
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
                                <td width="200"></td>
                                <td>Título / Autor / Categorias</td>
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
                                    <table class="table table-bordered">
                                        <tr>
                                            <td width="100">Título: </td>
                                            <td>{{ $blog->title }} </td>
                                        </tr>
                                        <tr>
                                            <td width="100">Autor: </td>
                                            <td>{{ $blog->author->name }} </td>
                                        </tr>
                                        <tr>
                                            <td width="100">Categorias: </td>
                                            <td>
                                                @foreach($blog->categories as $categorie)
                                                    <span class="badge badge-info badge-lg">
                                                        {{ $categorie->name }}
                                                    </span>
                                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="100">Ações: </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ Route('blog.show', ['id' => $blog->id ]) }}" target="_view" class="btn btn-info btn-sm">
                                                        <i class="fa fa-share" aria-hidden="true"></i>
                                                    </a>
                                                    @include('admin.includes.btn_status', [ 'status' => $blog->status, 'id' => $blog->id ])
                                                    @include('admin.includes.btn_featured', [ 'featured' => $blog->featured, 'id' => $blog->id ])
                                                    @include('admin.includes.btn_edit', [ 'route' => route('blog.edit', ['id' => $blog->id]) ])
                                                </div>
                                            </td>
                                        </tr>
                                    </table>


                                         
                                        
                                    </td>
                                </tr>
                                
                            @empty
                            <tr>
                                <td colspan="3" class="text-info text-center">
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
$("#results").OLExclude({'action' : "{{ Route('blog.destroy', [ 'id' => 1 ]) }}", 'inputCheckName' : 'exclude', 'inputCheckAll' : 'excludeAll'});
@endcan
/*Status*/
$(document).on("click", "a.btn-status:not(.disabled)", function(){
    var $this = $(this),
    _id = $this.attr("data-id"),
    _url  = "{{ Route('blog.update', [ 'id' => false ]) }}/" + _id,    
    _status   = $this.attr("data-status"),
    _n_status = ( _status == 1) ? 0 : 1;
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr("content") } });
    $.ajax({
        data: {'status' : _n_status},
        method: 'PUT',
        url: _url,
        beforeSend: function() {
            $this.addClass("disabled");
        },
        success: function(exr) {
            toggleStatus($this, _status);
        },
        error: function(exr, sender) {
            console.log(exr);

        },
        complete: function() {
            //$this.removeClass("disabled");
        },
    });
});

function toggleStatus($this, status){
    if(status == 1){
        $this.attr("class", "btn btn-default btn-sm btn-status")
             .attr("data-status", 0)
             .attr("title", "Colocar Online?");
    }else{
        $this.attr("class", "btn btn-primary btn-sm btn-status")
             .attr("data-status", 1)
             .attr("title", "Colocar Offline?");
    }
}
</script>
@endpush
