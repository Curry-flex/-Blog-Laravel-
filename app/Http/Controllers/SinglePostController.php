<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Tag;

use Illuminate\Support\Facades\Session;

class SinglePostController extends Controller
{
    public function index()
    {
        $post =Post::latest()->approved()->published()->get();
        return  view('category',compact('post'));

        
    }


    public function details($id)
    {
        $post =Post::where('id',$id)->approved()->published()->first();
        $blogkey ='blog_'. $post->id;
        if(!Session::has($blogkey))
        {
            $post->increment('view_count');
            Session::put($blogkey,1);
        }
       $randompost=Post::approved()->published()->take(3)->inRandomOrder()->get();
        return view('postDetails',['post'=>$post,'randompost'=>$randompost]);
   
    }

    public function postByCategory($id)
    {
        $category =Category::where('id',$id)->first();
        $posts=$category->posts()->approved()->published()->paginate(3);
        return view('postByCategory',compact('category' ,'posts'));
    }

    public function postByTag($id)
    {
        $tag= Tag::where('id',$id)->first();
        $posts=$tag->posts()->approved()->published()->paginate(3);
        return view('postByTag',compact('tag','posts'));
    }
}
