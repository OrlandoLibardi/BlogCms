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
                     @if(isset($categorie))
                        {!! Form::open(['route' => ['blog-categories.update', 'id' => $categorie->id], 'method' => 'PUT', 'id' => 'form-category']) !!}
                     @else   
                        {!! Form::open(['route' => 'blog-categories.store', 'method' => 'POST', 'id' => 'form-category']) !!}
                     @endif
                     <div class="col-md-12">
                         <div class="form-group">
                             <label><span class="text-red">*</span> Nome da Categoria</label>
                             {!! Form::text('name', isset($categorie) ? $categorie->name : null, ['placeholder' => 'Nome da Categoria','class' => 'form-control']) !!}
                         </div>
                     </div>
                     <div class="col-md-12">
                         <div class="form-group">
                             <label><span class="text-red">*</span> Categoria Parente</label>
                             @php                              
                                $temp = array_pluck($categories, 'name', 'id'); 
                                $temp[0] = 'Selecione';
                                ksort( $temp );
                             @endphp
                             {!! Form::select('parent_id', $temp, isset($categorie) ? $categorie->parent_id : 0, ['class' => 'form-control']) !!}
                         </div>
                     </div>
                     <div class="col-md-12">
                         <div class="form-group">
                             <label>Descrição da Categoria</label>
                             {!! Form::textarea('description', isset($categorie) ? $categorie->description : null, ['placeholder' => 'Uma breve descrição sobre a categoria...','class' => 'form-control']) !!}
                         </div>
                     </div>
                     {!! Form::close() !!}

              </div>
          </div>
      </div>
  </div>
