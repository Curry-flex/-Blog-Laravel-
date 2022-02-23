<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Http\Controllers\Controller;

class FavouriteController extends Controller
{
    public function index()
    {
        $post = Auth::user()->favourite_post;
        return view('admin.favourite',compact('post'));
    }
    
}
