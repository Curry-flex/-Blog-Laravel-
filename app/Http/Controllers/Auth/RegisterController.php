<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Brian2694\Toastr\Facades\Toastr;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo;

    public function redirectTo()
    {
        switch(Auth::user()->role->id)
        {
            case 1:
                $this->redirectTo ='/admin/dashboard';
                return $this->redirectTo;
                break;
            case 2:
                $this->redirectTo ='/author/dashboard';
                return $this->redirectTo;
                break;
            default:
            $this->redirectTo ='/';
            return $this->redirectTo; 
            break;   

        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    //    // $this->middleware()
    //     if (Auth::check() && Auth::user()->role->id == 1)
    //     {
    //         $this->redirectTo = route('admin.dashboard');
    //     } else {
    //         $this->redirectTo = route('author.dashboard');
    //     }
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'image' =>'required|image',
        
        ]);

        Toastr::success('Profile created successfully','success');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $request = request();
        $image =$request->file('image');
        $title =str_slug($request->name);

        if($image)
        {
           $currentDate =Carbon::now()->toDateString();
           $imagename=$title.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

           if(!Storage::disk('public')->exists('profile')){
               Storage::disk('public')->makeDirectory('profile');
           }

           $imageResize =Image::make($image)->resize(500,500)->stream();
           Storage::disk('public')->put('profile/'.$imagename,$imageResize);
        }
        else{
            $imagename="default.png";
        }

        return User::create([
            'role_id' => 3,
            'name' => $data['name'],
            'username' => str_slug($data['username']),
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'image' =>$imagename,
    
        ]);
    }
}
