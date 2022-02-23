<?php

namespace App\Http\Controllers\Author;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;

class FavouriteController extends Controller
{
    public function favouriteindex()
    {
      
        $posts = Auth::user()->favourite_post;
       
        return view('author.favourite',compact('posts'));
    }
    
}
