@extends('layouts.backend.app')


@push('css')
<link href="{{asset('asset/backend/plugins/bootstrap-select/css/bootstrap-select.css')}}" rel="stylesheet" />
@endpush
@section('content')

<form action="{{route('author.post.update',$post->id)}}" method="post" enctype="multipart/form-data">
@csrf
@method('PUT')

<div class="row clearfix">
                <div class="col-lg-7 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                EDIT POST
                            </h2>
                          
                        </div>
                        <div class="body">
                           
                                @csrf
                                <label for="email_address">Title</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="email_address" value="{{$post->title}}" name="title" class="form-control" placeholder="Enter title">
                                    </div>
                                </div>
                               
                                
                                <label for="password">Image</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="file"  name="image" class="form-control" >
                                    </div>
                                </div>
                              
                                <div class="form-group">
                                <input type="checkbox" id="publish" class="filled-in"  name="status" value="1" {{$post->status == true ? 'checked' : ''}}>
                                <label for="publish">Publish</label>
                            </div>

                              
                             
                    
                        </div>
                    </div>
                </div>


                <div class="col-lg-5 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                categories and Tag
                            </h2>
                          
                        </div>
                        <div class="body">
                           
                
                                <div class="form-group form-float">
                                    <div class="form-line">
                                    <label for="email_address">Select category</label>
                                    <select name="categories[]" id="category" class="form-control show-tick" >
                                        <option value="">select</option>
                                        @foreach($category as $category)
                                        <option value="{{$category->id}}"
                                         @foreach($post->categories as $postcategory )
                                          {{$postcategory->id == $category->id ? 'selected':''}}
                                         @endforeach
                                        >{{$category->category_name}}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                </div>

                                <div class="form-group form-float">
                                    <div class="form-line">
                                    <label for="email_address">Select tag</label>
                                    <select name="tags[]" id="tag" class="form-control show-tick"  >
                                    <option value="">select</option>
                                        @foreach($tag as $tag)
                                        <option value="{{$tag->id}}" 
                                        @foreach($post->tags as $posttag)
                                          {{$posttag->id == $tag->id ? 'selected' : ''}}
                                        @endforeach
                                        >{{$tag->tag_name}}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                </div>
                                
                               

                              
                                <br>
                                <a href="{{route('author.post.index')}}" class="btn btn-danger m-t-15 m-r-3">Back</a>
                                <button type="submit" class="btn btn-primary m-t-15 waves-effect">Add</button>
                    
                        </div>
                    </div>
                </div>
    </div>


    <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                BODY
                            </h2>
                          
                        </div>
                        <div class="body">
                             <textarea name="body" id="tinymce"  >
                                {{$post->body}}
                             </textarea>  
                        </div>
                    </div>
                </div>
    </div>

</form>


@endsection

@push('js')
<script src="{{asset('asset/backend/plugins/bootstrap-select/js/bootstrap-select.js')}}"></script>

<script src="{{asset('asset/backend/plugins/tinymce/tinymce.js')}}"></script>
<script src="{{asset('asset/backend/plugins/ckeditor/ckeditor.js')}}"></script>

<script>

$(function () {


    //TinyMCE
    tinymce.init({
        selector: "textarea#tinymce",
        theme: "modern",
        height: 300,
        plugins: [
            'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            'searchreplace wordcount visualblocks visualchars code fullscreen',
            'insertdatetime media nonbreaking save table contextmenu directionality',
            'emoticons template paste textcolor colorpicker textpattern imagetools'
        ],
        toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        toolbar2: 'print preview media | forecolor backcolor emoticons',
        image_advtab: true
    });
    tinymce.suffix = ".min";
    tinyMCE.baseURL = '{{asset('asset/backend/plugins/tinymce')}}';
});
    
</script>
@endpush