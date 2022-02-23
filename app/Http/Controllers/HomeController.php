<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::all();
        //$post =Post::latest()->approved()->published()->take(6)->get();
        $post =Post::latest()->approved()->published()->paginate(6);
       return view('welcome',['category'=>$category,'posts'=>$post]);
    }
}
