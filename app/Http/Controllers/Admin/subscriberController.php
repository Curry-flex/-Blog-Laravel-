<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\subscriber;

class subscriberController extends Controller
{
    public function index()
    {
        $subscriber =subscriber::latest()->get();

        return view('admin.subscriber',['subscriber'=>$subscriber]);
    }

    public function destroy($id)
    {

        $subscriber =subscriber::findOrFail($id);
        $subscriber->delete();
        
        Toastr::success('subscriber deleted successfully','success');

        return redirect()->back();
    }
}
