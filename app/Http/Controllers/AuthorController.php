<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class AuthorController extends Controller
{
    public function profile($name)
    {
        $author=User::where('name',$name)->first();
        $posts=$author->posts()->approved()->published()->paginate(2);

     return view('profile',compact('author','posts'));
    }
}
