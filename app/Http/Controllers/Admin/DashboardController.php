<?php

namespace App\Http\Controllers\Admin;

use App\Category;

use App\Post;
use App\Tag;
use App\User;
use App\subscriber;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $posts =Post::all();
        $popular_posts=Post::withCount('comments')
                            ->withCount('favourite_user')
                            ->orderBy('view_count','desc')
                            ->orderBy('comments_count','desc')
                            ->orderBy('favourite_user_count','desc')
                            ->take(5)->get();
        $total_pending_posts = Post::where('is_approved', false);
        $all_views=Post::sum('view_count');
        $author_count = User::where('role_id',2)->count();
        $new_authors_today=User::where('role_id',2) 
                                ->whereDate('created_at',Carbon::today())->count();
        $active_authors =User::where('role_id' ,2)
                               ->withCount('comments')
                               ->withCount('posts') 
                               ->withCount('favourite_post')  
                               ->orderBy('posts_count','desc')
                               ->orderBy('comments_count','desc')
                               ->orderBy('favourite_post_count','desc')
                               ->take(10)->get();   
                               
         $category_count  =Category::all()->count();
         $tag_count =Tag::all()->count(); 
         $user =User::all()->count(); 
         $subscriber = subscriber::all()->count();                   
       return view('admin' ,compact('posts' ,'popular_posts','total_pending_posts','all_views',
          'author_count' ,'new_authors_today','active_authors','category_count','tag_count','user','subscriber'
    
    ));
    }
}
