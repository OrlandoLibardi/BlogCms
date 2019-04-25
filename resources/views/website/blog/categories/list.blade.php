<div class="col-md-8">
      <div class="ibox float-e-margins">
          <div class="ibox-title">
              <h5>Categorias Cadastradas</h5>
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
                                  <td width="80"></td>
                                  <td width="200">Nome</td>
                                  <td>Alias</td>
                                  <td width="200">Categoria Parente</td>
                                  <td width="50">Status</td>
                                  <td width="50">Editar</td>
                              </tr>
                          </thead>
                          <tbody>
                              @php $i = 1 @endphp
                              @forelse($categories as $category)
                                  <tr>
                                      <td><input type="checkbox" name="exclude" value="{{ $category->id }}"> </td>
                                      <td>{{ $i }}</td>
                                      <td>{{ $category->name }}</td>
                                      <td>{{ $category->alias }}</td>
                                      <td> -- </td>
                                      <td>@include('admin.includes.btn_status', [ 'status' => $category->status, 'id' =>  $category->id])</td>
                                      <td class="text-center">
                                          @include('admin.includes.btn_edit', [ 'route' => route('blog-categories.edit', ['id' => $category->id]) ])
                                      </td>
                                  </tr>
                                  @if(count($category->childs) > 0)
                                    @include('admin.blog.categories.tr', ['childs' => $category->childs, 'i' => $i, 'parent_name' => $category->name])
                                  @endif
                                  @php $i++ @endphp
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
