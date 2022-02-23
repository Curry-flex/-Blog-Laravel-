<?php

namespace App\Http\Controllers\Author;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Comment;
use Auth;
use Brian2694\Toastr\Facades\Toastr;

class CommentController extends Controller
{
    public function index()
{
    $post =Auth::user()->posts;

    return view('author.comment' ,compact('post'));
}

public function destroy($id)
{
    $comment =Comment::findOrFail($id);
    
    if($comment->post->user_id == Auth::id())
    {
        $comment->delete();

        Toastr::success('comment successfully Deleted','success');
    
        return redirect()->back();
    }
    else{
        
        Toastr::error('your not authorized to delete this comment ','error');
        return redirect()->back();

    }
    


}
}
