<?php

namespace OrlandoLibardi\BlogCms\app\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogImageController extends Controller
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
    public function store(Request $request) 
    {        
        

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
        
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) 
    {
       
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        
    }

}
