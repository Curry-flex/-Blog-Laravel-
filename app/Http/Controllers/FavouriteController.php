<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use Brian2694\Toastr\Facades\Toastr;

class FavouriteController extends Controller
{
    public function add($post)
    {
        $user =Auth::user();
        $isfavourite=$user->favourite_post()->where('post_id' ,$post)->count();

        if($isfavourite == 0)
        {
            $user->favourite_post()->attach($post);
            Toastr::success('Post successfully added to favourite list' ,'success');
            return redirect()->back();
        }
        else{
            $user->favourite_post()->detach($post);
            Toastr::success('Post successfully removed form your favorite list :)','Success');
            return redirect()->back();
        }

    
    }

    public function delete($post)
    {
        
    }
}
