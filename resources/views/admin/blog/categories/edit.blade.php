<div class="col-md-4">
      <div class="ibox float-e-margins">
          <div class="ibox-title">
              <h5>Criar Categoria</h5>
              <div class="ibox-tools">
                  <a class="collapse-link"> <i class="fa fa-chevron-up"></i>  </a>
              </div>
          </div>
          <div class="ibox-content">
              <div class="row">

                     {!! Form::open(['route' => ['blog-categories.update', 'id' => $blogCategory->id], 'method' => 'PUT', 'id' => 'form-category']) !!}
                     <div class="col-md-12">
                         <div class="form-group">
                             <label><span class="text-red">*</span> Nome da Categoria</label>
                             {!! Form::text('nome', $blogCategory->name, ['placeholder' => 'Nome da Categoria','class' => 'form-control']) !!}
                         </div>
                     </div>
                     <div class="col-md-12">
                         <div class="form-group">
                             <label><span class="text-red">*</span> Categoria Parente</label>
                             @php $select_category = array_pluck($categories, 'name', 'id'); @endphp
                             {!! Form::select('categoria_parente', $select_category, $blogCategory->parent_id, ['placeholder' => 'Categoria parente','class' => 'form-control']) !!}
                         </div>
                     </div>
                     <div class="col-md-12">
                         <div class="form-group">
                             <label>Descrição da Categoria</label>
                             {!! Form::textarea('descricao', $blogCategory->comment, ['placeholder' => 'Uma breve descrição sobre a categoria...','class' => 'form-control']) !!}
                         </div>
                     </div>
                     {!! Form::close() !!}

              </div>
          </div>
      </div>
  </div>
