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
                     @else   
                        {!! Form::open(['route' => 'blog-authors.store', 'method' => 'POST', 'id' => 'form-author']) !!}
                     @endif
                     {!! Form::hidden('image', null) !!}
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
                     <div class="col-md-12">
                        <div class="form-group">
                             <label><span class="text-red">*</span>  Foto de perfil</label>
                             <div class="input-group">
                                <input type="text" name="image_content" class="form-control" id="image_content" placeholder="Selecionar imagem...">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button" name="search-image"><i class="fa fa-search"></i></button>
                                </span>
                            </div>
                         </div>
                     </div>
                     {!! Form::close() !!}

              </div>
          </div>
      </div>
  </div>
<!-- modal para gerenciador de imagens -->
<div id="modal-files" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-lg">
            <div class="modal-body">
                <div class="row">

                    <div class="col-md-9">
                        <div class="ibox">
                            <div class="ibox-title">
                                <div class="row">
                                    <div class="col-md-8" id="OLFiles-list-dir">
                                    </div>
                                    <div class="col-md-4" id="OLFiles-form-folder">
                                    </div>
                                </div>
                            </div>
                            <div class="row" >
                                <div class="col-md-12" id="OLFiles-list-files" style="padding-top:15px;">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3" id="OLFiles-dropzone">

                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>