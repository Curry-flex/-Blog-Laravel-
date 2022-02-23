<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Brian2694\Toastr\Facades\Toastr;
class CategoryController extends Controller

{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cat = Category::latest()->get();
      return view('admin.category.index',['cat'=>$cat]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('admin.category.create');
   
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
            "category_name"=>"required|unique:categories",
            "image" =>"required|mimes:jpeg,png,jpg"
        ]);

          $image = $request->file('image');
          $category_name =str_slug($request->category_name);

        

          if($image){

            //make image name unique
            $currentDate =carbon::now()->toDateString();
            $imagename=$category_name.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            //check category disk exisit

            if(!Storage::disk('public')->exists('category')){

                Storage::disk('public')->makeDirectory('category');
            }

            //resize image and upload
             $category=Image::make($image)->resize(1600,479)->save($imagename);
             Storage::disk('public')->put('category/'.$imagename,$category);
          

          if(!Storage::disk('public')->exists('category/slider')){

            Storage::disk('public')->makeDirectory('category/slider');
           }

              //resize image and upload
              $slider=Image::make($image)->resize(500,333)->save($imagename);
              Storage::disk('public')->put('category/slider/'.$imagename,$slider);

        }
        else{
            $imagename="default.png";

        }

        $category =new Category();
        $category->category_name=$request->category_name;
        $category->category_description=$request->description;
        $category->image=$imagename;

        $category->save();
        Toastr::success('Category added successfullt','success');
        return redirect()->route('admin.category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editCat =Category::find($id);

        return view('admin.category.edit',['edit' =>$editCat]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            "category_name"=>"required",
            "image" =>"mimes:jpeg,png,jpg"
        ]);

          $image = $request->file('image');
          $category_name =str_slug($request->category_name);

          $category=Category::find($id);

          if($image){

            //make image name unique
            $currentDate =carbon::now()->toDateString();
            $imagename=$category_name.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            //check category disk exisit

            if(!Storage::disk('public')->exists('category')){

                Storage::disk('public')->makeDirectory('category');
            }

            //delete old image
            if(Storage::disk('public')->exists('category/'.$category->image))
            {
                Storage::disk('public')->delete('category/'.$category->category_name);
            }

            //resize image and upload
             $categoryImage=Image::make($image)->resize(1600,479)->save($imagename);
             Storage::disk('public')->put('category/'.$imagename,$categoryImage);
          

          if(!Storage::disk('public')->exists('category/slider')){

            Storage::disk('public')->makeDirectory('category/slider');
           }

            //delete old image
            if(Storage::disk('public')->exists('category/slider/'.$category->image))
            {
                Storage::disk('public')->delete('category/slider/'.$category->category_name);
            }

              //resize image and upload
              $slider=Image::make($image)->resize(500,333)->save($imagename);
              Storage::disk('public')->put('category/slider/'.$imagename,$slider);

        }
        else{
            $imagename=$category->image;

        }

       
        $category->category_name=$request->category_name;
        $category->category_description=$request->description;
        $category->image=$imagename;

        $category->save();
        Toastr::success('Category added successfullt','success');
        return redirect()->route('admin.category.index');
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       

        $cat = Category::find($id);

        $cat->delete();

        return redirect()->route('admin.category.index');
    }
}
