<?php

namespace App\Http\Controllers\Author;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\Comment;
use App\User;
use App\Category;

class DashboardController extends Controller
{
    public function index()
    {
        
        $user=Auth::user();
      
        $post=$user->posts;
        $popular_post=$user->posts()
              ->withCount('comments')
              ->withCount('favourite_user')
              ->orderBy('view_count','desc')
              ->orderBy('comments_count')
              ->orderBy('favourite_user_count')
              ->take(5)->get();
        $authorpost=Auth::user()->posts;
        $pending =$authorpost->where('is_approved',false);
        $totalpendingPost =$post->where('is_approved',0)->count();
        $all_views =$post->sum('view_count');
        $categories=Category::all()->count();
        
        // $post->comments;
       // $post =Auth::user()->posts;
        
      
        
       return view('author' ,compact('post','popular_post','all_views','pending','favorite_post','categories'));
    }
}
