<?php

namespace OrlandoLibardi\BlogCms\app\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use OrlandoLibardi\BlogCms\app\Http\Requests\BlogCategorieRequest;
use OrlandoLibardi\BlogCms\app\BlogCategory;

class BlogCategoryController extends Controller
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
        $categories = BlogCategory::Categories(0);
        return view('admin.blog.categories.index', compact('categories'));
       
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
    public function store(BlogCategorieRequest $request) 
    {        
        
       BlogCategory::create( $request->all() );
        

       
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
       $categories = BlogCategory::Categories(0);
       $categorie = BlogCategory::find($id);
       return view('admin.blog.categories.index', compact('categorie', 'categories'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BlogCategorieRequest $request, $id) 
    {
        BlogCategory::find($id)
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
    public function destroy(BlogCategorieRequest $request) {

        $ids = json_decode($request->id);

        foreach($ids as $id){
            BlogCategory::find($id)
            ->delete();
        }

        return response()
        ->json(array(
            'message' => __('messages.destroy_success'),
            'status'  =>  'success'
        ), 201);

    }

}
