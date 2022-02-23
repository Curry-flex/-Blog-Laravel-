<?php

namespace App\Http\Controllers\Author;

use App\Post;


use Auth;
use App\Notifications\NewPostApproval;
use Illuminate\Support\Facades\Notification;
use App\User;
use App\Tag;
use App\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post =Auth::user()->posts()->latest()->get();

        return view('author.post.index',['post'=>$post]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category=Category::all();
        $tag=Tag::all();
        return view('author.post.create',['tag'=>$tag,'category'=>$category]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required',
            'image'=>'required',
            'categories'=>'required',
            'tags'=>'required',
            'body'=>'required'
        ]);

        $image =$request->file('image');
        $title =str_slug($request->title);

        if($image)
        {
           $currentDate =Carbon::now()->toDateString();
           $imagename=$title.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

           if(!Storage::disk('public')->exists('post')){
               Storage::disk('public')->makeDirectory('post');
           }

           $imageResize =Image::make($image)->resize(1600,1066)->stream();
           Storage::disk('public')->put('post/'.$imagename,$imageResize);
        }
        else{
            $imagename="default.png";
        }

        $post = new Post;
        $post->title=$request->title;
        $post->user_id=Auth::id();
        if(isset($request->status))
        {
            $post->status=true;
        }

        else{
            $post->status=false;

        }
        $post->image=$imagename;
        $post->is_approved=false;
        $post->body=$request->body;
        $post->save();

        $post->categories()->attach($request->categories);
        $post->tags()->attach($request->tags);

       // $user=User::where('role_id',1)->get();

       // Notification::send($user ,new NewPostApproval($post));

        Toastr::success('post added successfully','success');

        return redirect()->route('author.post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        if($post->user_id != Auth::id())
        {
            Toastr::error('your not athorized to access this post','error');

            return redirect()->back();
        }
        return view('admin.post.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if($post->user_id != Auth::id())
        {
            Toastr::error('your not athorized to access this post','error');

            return redirect()->back();
        }
        $category=Category::all();
        $tag=Tag::all();
        return view('author.post.edit',compact('category','tag','post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        if($post->user_id != Auth::id())
        {
            Toastr::error('your not athorized to access this post','error');

            return redirect()->back();
        }
        $this->validate($request,[
            'title'=>'required',
            'image'=>'image',
            'categories'=>'required',
            'tags'=>'required',
            'body'=>'required'
        ]);

        $image =$request->file('image');
        $title =str_slug($request->title);
        

        if($image)
        {
           $currentDate =Carbon::now()->toDateString();
           $imagename=$title.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

           if(!Storage::disk('public')->exists('post')){
               Storage::disk('public')->makeDirectory('post');
           }

           //delete old image
           if(Storage::disk('public')->exists('post/' .$post->image))
           {
               Storage::disk('public')->delete('post/'.$post->image);
           }

           $imageResize =Image::make($image)->resize(1600,1066)->stream();
           Storage::disk('public')->put('post/'.$imagename,$imageResize);
        }
        else{
            $imagename=$post->image;
        }

    
        $post->title=$request->title;
        $post->user_id=Auth::id();
        if(isset($request->status))
        {
            $post->status=true;
        }

        else{
            $post->status=false;

        }
        $post->image=$imagename;
        $post->is_approved=false;
        $post->body=$request->body;
        $post->save();

        $post->categories()->sync($request->categories);
        $post->tags()->sync($request->tags);

        Toastr::success('post updated successfully','success');

        return redirect()->route('author.post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
      
        if(Storage::disk('public')->exists('post/'.$post->image))
        {
            Storage::disk('public')->delete('post/'.$post->image);
        }

        $post->categories()->detach();
        $post->tags()->detach();
        $post->delete();
         Toastr::success('deleted successfully','success');
        return redirect()->route('admin.post.index');
    }
}
