<div class="col-md-6">
      <div class="ibox float-e-margins">
          <div class="ibox-title">
              <h5>Autores Cadastrados</h5>
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
                                  <td width="120"></td>
                                  <td width="200">Nome</td>
                                  <td>Email</td>
                                  <td width="50">Editar</td>
                              </tr>
                          </thead>
                          <tbody>
                              
                              @forelse($authors as $author)
                                  <tr>
                                      <td><input type="checkbox" name="exclude" value="{{ $author->id }}"> </td>
                                      <td></td>
                                      <td>{{ $author->name }}</td>
                                      <td>{{ $author->email }}</td>
                                      <td class="text-center">
                                          @include('admin.includes.btn_edit', [ 'route' => route('blog-authors.edit', ['id' => $author->id]) ])
                                      </td>
                                  </tr>
                                  
                              @empty
                              <tr>
                                  <td colspan="5" class="text-info text-center">
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
