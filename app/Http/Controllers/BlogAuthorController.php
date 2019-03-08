<?php

namespace OrlandoLibardi\BlogCms\app\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use OrlandoLibardi\BlogCms\app\Http\Requests\BlogAuthorRequest;
use OrlandoLibardi\BlogCms\app\BlogAuthor;

class BlogAuthorController extends Controller
{    

    public function __construct()
    {
        $this->middleware('permission:list');
        $this->middleware('permission:create', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete', ['only' => ['destroy']]);
       
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        $authors = BlogAuthor::all();
        return view('admin.blog.authors.index', compact('authors'));
        
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() 
    {
        return view('admin.blog.authors.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogAuthorRequest $request) 
    {        
      
      BlogAuthor::create( $request->all() );
        
       return response()
       ->json(array(
           'message' => __('messages.create_success'),
           'status'  =>  'success'
       ), 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) 
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) 
    {
       $author = BlogAuthor::find($id);
       $folder = config('blog.author_url');
       return view('admin.blog.authors.create', compact('author', 'folder'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BlogAuthorRequest $request, $id) 
    {
        BlogAuthor::find($id)
        ->update( $request->all() );

        return response()
        ->json(array(
            'message' => __('messages.update_success'),
            'status'  =>  'success'
        ), 201);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(BlogAuthorRequest $request) {

        $ids = json_decode($request->id);

        foreach($ids as $id){
            BlogAuthor::find($id)
            ->delete();
        }

        return response()
        ->json(array(
            'message' => __('messages.destroy_success'),
            'status'  =>  'success'
        ), 201);

    }

}
