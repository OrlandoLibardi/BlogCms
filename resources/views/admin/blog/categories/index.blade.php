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
            <li class="active">Categorias </li>
        </ol>
    </div>
    <div class="col-md-3 padding-btn-header text-right">

    </div>
</div>
@endsection @section('content')
<div class="row">
    @if(!empty($categorie))      
        @include('admin.blog.categories.create', [ 'categories' => $categories, 'categorie' => $categorie ])        
    @else
        @include('admin.blog.categories.list', [ 'categories' => $categories ] )        
        @include('admin.blog.categories.create', [ 'categories' => $categories ])
    @endif
</div>
@endsection
@push('style')
<link rel="stylesheet" href="{{ asset('assets/theme-admin/css/plugins/OLForm/OLForm.css') }}">
@endpush
@push('script')
<script src="{{ asset('assets/theme-admin/js/plugins/OLForm/OLForm.jquery.js') }}"></script>
<!-- exclude -->
<script src="{{ asset('assets/theme-admin/js/plugins/OLForm/OLExclude.jquery.js') }}"></script>
<script>
/* Formulário */
$("#form-category").OLForm({btn : false, listErrorPosition: 'after', listErrorPositionBlock: '.page-heading', urlRetun : "{{ Route('blog-categories.index') }}" });
@can('delete')
/*Exclude*/
$("#results").OLExclude({'action' : "{{ Route('blog-categories.destroy', [ 'id' => 1 ]) }}", 'inputCheckName' : 'exclude', 'inputCheckAll' : 'excludeAll'});
@endcan
/*Status*/
$(document).on("click", "a.btn-status:not(.disabled)", function(){
    var $this = $(this),
    _id = $this.attr("data-id"),
    _url  = "{{ Route('blog-categories.update', [ 'id' => false ]) }}/" + _id,    
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
