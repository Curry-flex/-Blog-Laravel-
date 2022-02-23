<?php

namespace App\Http\Controllers\Admin;


use Auth;
use App\User;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Brian2694\Toastr\Facades\Toastr;

class SettingController extends Controller
{
    public function index()
    {

        return view('admin.setting');
    }

    public function updateProfile(Request $request )
    {


        $this->validate($request,[
            'name'=>'required',
            'email'=>'required|email',
            'image' =>'required|image'
        ]);

        $image =$request->file('image');
        $slug =str_slug($request->name);
        $user =User::findOrfail(Auth::id());

        if($image)
        {
           $currentDate =Carbon::now()->toDateString();
           $imagename=$slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

           if(!Storage::disk('public')->exists('profile')){
               Storage::disk('public')->makeDirectory('profile');
           }

           //delete old image
           if(Storage::disk('public')->exists('profile/' .$user->image))
           {
               Storage::disk('public')->delete('profile/'.$user->image);
           }

           $imageResize =Image::make($image)->resize(500,500)->stream();
           Storage::disk('public')->put('profile/'.$imagename,$imageResize);
        }
        else{
            $imagename=$user->image;
        }

    
        $user->name=$request->name;
        $user->email=$request->email;
        $user->image=$imagename;

        $user->save();
       

        Toastr::success('profile updated successfully','success');

        return redirect()->back();
    }

    public function updatePassword(Request $request)
    {

        
        $this->validate($request,[
            'old_password'=>'required',
            'password'=>'required|confirmed'
        ]);

         $hashedPassword=Auth::user()->password;

        if(Hash::check($request->old_password,$hashedPassword))
        {
            if(! Hash::check($request->password ,$hashedPassword))
            {
                $user =User::find(Auth::id());
                $user->password=Hash::make($request->password);
                $user->save();
                Toastr::success('password updated successfully','success');
                Auth::logout();
                return redirect()->back();
            }
            else{
                Toastr::error('new password can not be the same as old password','error');
                return redirect()->back();

            }
        }
        else{
            Toastr::error('Current password not match.','Error');
            return redirect()->back();
        }
    }
}
