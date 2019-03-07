<?php

namespace OrlandoLibardi\BlogCms\app\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use OrlandoLibardi\BlogCms\app\BlogComment;
use OrlandoLibardi\BlogCms\app\Http\Requests\BlogCommentRequest;

class BlogCommentController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:list');
        $this->middleware('permission:create', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit', ['only' => ['edit', 'update', 'status']]);
        $this->middleware('permission:delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        
        $comments = BlogComment::where('parent_id', 0)->paginate(30);

        return view('admin.blog.comments.index', compact('comments'));

       
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() 
    {
       
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogCommentRequest $request) 
    {  
        $comment = BlogComment::create($request->all());
        $comment->blog()->attach($request->blog_id);
        return response()
        ->json(array(
            'message' => __('olcms::messages.create_success'),
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
        $comment = BlogComment::find($id);
        return view('admin.blog.comments.edit', compact('comment'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BlogCommentRequest $request, $id) 
    {
       $comment = BlogComment::find($id)->update($request->all());
       return response()
        ->json(array(
            'message' => __('olcms::messages.update_success'),
            'status'  =>  'success'
        ), 200);
    }


    public function status(BlogCommentRequest $request, $id)
    {
        BlogComment::find($id)->update($request->all());
        return response()
        ->json(array(
            'message' => __('olcms::messages.update_success'),
            'status'  =>  'success'
        ), 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(BlogCommentRequest $request, $id) {
        
        foreach(json_decode($request->id) as $id)
        {
            BlogComment::find($id)->delete();            
        }
          
        return response()
        ->json(array(
            'message' => __('olcms::messages.destroy_success'),
            'status'  =>  'success'
        ), 201);
    }

}
