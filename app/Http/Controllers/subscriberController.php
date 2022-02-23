<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\subscriber;
use Brian2694\Toastr\Facades\Toastr;

class subscriberController extends Controller
{
    public function store(Request $request)
    {


    
        $this->validate($request,[
            'email'=>'required|email|unique:subscribers'
        ]);

        $subscriber = new subscriber;
        $subscriber->email=$request->email;
        $subscriber->save();
        Toastr::success('post added successfully','success');
        return redirect()->back();
    }
     
}
