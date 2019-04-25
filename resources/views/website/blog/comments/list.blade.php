<div class="col-md-10">
      <div class="ibox float-e-margins">
          <div class="ibox-title">
              <h5>Comentários Cadastrados</h5>
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
                                  <td>Postagem:</td>
                                  <td>Comentado por:</td>                                  
                                  <td>Comentário:</td>   
                                  <td>Comentado em:</td>
                                  <td width="50">Responder</td>
                                  <td width="50">Status</td>                               
                                  <td width="50">Editar</td>
                              </tr>
                          </thead>
                          <tbody>
                             @php $i = 1 @endphp
                              @forelse($comments as $comment)
                                  <tr>
                                      <td><input type="checkbox" name="exclude" value="{{ $comment->id }}"> </td>
                                      <td>{{ $i }}</td>
                                      <td>
                                        @php $blog_id = ""; @endphp
                                        @foreach($comment->blog as $blog)
                                            {{ $blog->title }}
                                            @php $blog_id = $blog->id @endphp
                                        @endforeach
                                      </td>
                                      <td>{{ $comment->name }}<br /> {{ $comment->email }}</td>                                      
                                      <td>{{ $comment->created_at }}</td>
                                      <td>
                                        {{ $comment->title }}<br />
                                        {{ $comment->comment }}
                                      </td>
                                      <td class="text-center">
                                        <a href="javascript:;" data-parent="{{ $comment->id }}" data-blog="{{ $blog_id }}" title="Responder" class="btn btn-info btn-sm reply">
                                            <i class="fa fa-reply" aria-hidden="true"></i> 
                                        </a>
                                      </td>
                                      <td class="text-center">
                                          @include('admin.includes.btn_status', ['status' => $comment->status, 'id' => $comment->id])
                                      </td>
                                      <td class="text-center">
                                          @include('admin.includes.btn_edit', [ 'route' => route('blog-comments.edit', ['id' => $comment->id]) ])
                                      </td>
                                  </tr>
                                  @if(count($comment->reply) > 0)
                                    @include('admin.blog.comments.tr', ['childs' => $comment->reply, 'i' => $i])
                                  @endif
                                  @php $i++ @endphp
                              @empty
                              <tr>
                                  <td colspan="6" class="text-info text-center">
                                      <br /><br /><h3> Nenhum resultado encontrado! </h3><br />
                                  </td>
                              </tr>
                              @endforelse
                          </tbody>
                      </table>
                      {{ $comments->links() }}
                  </div>
              </div>
          </div>
      </div>
  </div>
