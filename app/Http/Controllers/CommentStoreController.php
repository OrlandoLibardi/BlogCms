<?php

namespace OrlandoLibardi\BlogCms\app\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use OrlandoLibardi\BlogCms\app\Http\Requests\CommentRequest;
use OrlandoLibardi\BlogCms\app\BlogComment;

class CommentStoreController extends Controller
{
    public function store(CommentRequest $request)
    {
       $comment = BlogComment::create($request->all());
       $comment->blog()->attach($request->blog_id);
       return back()->with('success', [__('olcms::messages.create_success')]);    
    }

}
