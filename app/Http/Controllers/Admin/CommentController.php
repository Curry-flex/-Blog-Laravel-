<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Comment;
use Brian2694\Toastr\Facades\Toastr;

class CommentController extends Controller
{
public function index()
{
    $comment =Comment::latest()->get();

    return view('admin.comment' ,compact('comment'));
}

public function destroy($id)
{
    $comment =Comment::findOrFail($id);
    $comment->delete();

    Toastr::success('comment successfully Deleted','success');

    return redirect()->back();


}
}
