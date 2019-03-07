<?php

namespace OrlandoLibardi\BlogCms\app;

use Illuminate\Database\Eloquent\Model;

class BlogAuthor extends Model
{
    protected $fillable = [ 'name', 'email', 'about', 'photo' ];

}
