<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Hash;
use App\User;

class AuthorController extends Controller
{
    public function index()
    {
     
        $author=User::authors()
          ->withCount('posts')
          ->withCount('comments')
          ->withCount('favourite_post')
          ->get();

    return view('admin.author',compact('author'));
    }

    public function delete($id)
    {
        $author=User::findOrFail($id);
        $author->delete();

        Toastr::success('Author deleted successfully','success');

        return redirect()->back();
    }

   

    public function create()
    {
        return view('admin.register');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'username'=>'required|unique:users',
            'email'=>'required|email|unique:users',
            'password' =>'required|confirmed'
        ]);

        $user =new User;

        $user->name =$request->name;
        $user->username=$request->username;
        $user->email =$request->email;
        $user->role_id=$request->role_id;
        $user->password=Hash::make($request->password);

        $user->save();

        Toastr::success('User created successfully','success');

        return redirect()->back();
    }
}
