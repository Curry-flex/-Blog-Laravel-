<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use Auth;
use Brian2694\Toastr\Facades\Toastr;

class CommentController extends Controller
{
    public function store(Request $request ,$post)
    {
           $this->validate($request,[
               'comment'=>'required'
           ]);

           $comment =new Comment;

           $comment->user_id =Auth::id();
           $comment->post_id=$post;
           $comment->comment=$request->comment;

           $comment->save();
           Toastr::success('Comment added successfully','succes');
           return redirect()->back();

        // $req=$request->comment;


        // echo $req;





    }
}
