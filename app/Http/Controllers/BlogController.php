<?php

namespace OrlandoLibardi\BlogCms\app\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use OrlandoLibardi\BlogCms\app\Blog;
use OrlandoLibardi\BlogCms\app\BlogCategory;
use OrlandoLibardi\BlogCms\app\BlogAuthor;

use OrlandoLibardi\BlogCms\app\ServiceContent;

use OrlandoLibardi\BlogCms\app\Http\Requests\BlogRequest;

class BlogController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:list');
        $this->middleware('permission:create', ['only' => ['create', 'store', 'deleteImage', 'image']]);
        $this->middleware('permission:edit', ['only' => ['edit', 'update', 'status', 'featured']]);
        $this->middleware('permission:delete', ['only' => ['destroy']]);
                
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {    
       $blogs = Blog::paginate(10);
       return view('admin.blog.index', compact('blogs'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) 
    {
        $categories = BlogCategory::Categories(0);
        $authors    = BlogAuthor::all();
        return view('admin.blog.create', compact('categories', 'authors'));
        
    }
    public function show($id)
    {
        Blog::find($id);
        return view ('admin.blog.view', compact('blog'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogRequest $request) {
        
        $blog = Blog::create( $request->all() );

        if($request->photo){
            $blog->photo()->create([ 'content' => $request->photo ]);
        }
        
        $blog->author()->create(['author_id' => $request->author]);
        $blog->meta()->create(['title' => $request->meta_title, 'description' => $request->meta_description]);
        $blog->categories()->attach(json_decode($request->categories));

        return response()
        ->json(array(
            'message' => __('messages.create_success'),
            'status'  =>  'success'
        ), 200);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) 
    {
        $categories = BlogCategory::Categories(0);
        $authors    = BlogAuthor::all();
        $blog       = Blog::find($id);

        return view('admin.blog.create', compact('categories', 'authors', 'blog'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BlogRequest $request, $id) 
    {
        
        $blog = Blog::find($id);

        $blog->update( $request->all() );

        if($blog->photo)
        {
            $blog->photo->content = $request->photo;
            $blog->photo->save();
        }
        
        if($blog->author)
        {
            $blog->author->author_id = $request->author;
            $blog->author->save();
        }
        
        if( $blog->meta )
        {
            $blog->meta->title = $request->meta_title;
            $blog->meta->description = $request->meta_description;
            $blog->meta->save();
        }

        if($request->categories)
        {
            $blog->categories()->sync(json_decode($request->categories));
        }             

        return response()
        ->json(array(
            'message' => __('messages.update_success'),
            'status'  =>  'success'
        ), 201);
    }

    public function changeStatusOrFeatured(BlogRequest $request, $id)
    {
        Blog::find($id)->update($request->all());
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
    public function destroy(BlogRequest $request, $id) {
        
        foreach(json_decode($request->id) as $id)
        {
            \OrlandoLibardi\BlogCms\app\BlogContent::where('blog_id', $id)->delete();
            Blog::find($id)->delete();            
        }
          
        return response()
        ->json(array(
            'message' => __('messages.update_success'),
            'status'  =>  'success'
        ), 201);
    }

}
