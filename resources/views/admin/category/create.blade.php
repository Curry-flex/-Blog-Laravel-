@extends('layouts.backend.app')


@push('css')

@endpush
@section('content')

<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                ADD Category
                            </h2>
                          
                        </div>
                        <div class="body">
                            <form action="{{route('admin.category.store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <label for="email_address">Category Name</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="email_address" name="category_name" class="form-control" placeholder="Enter tag name">
                                    </div>
                                </div>
                                <label for="password">Description</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="password" name="description" class="form-control" placeholder="Enter description">
                                    </div>
                                </div>
                                
                                <label for="password">Image</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="file"  name="image" class="form-control" >
                                    </div>
                                </div>

                              
                                <br>
                                <a href="{{route('admin.category.index')}}" class="btn btn-danger m-t-15 m-r-3">Back</a>
                                <button type="submit" class="btn btn-primary m-t-15 waves-effect">Add</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

@endsection

@push('js')

@endpush