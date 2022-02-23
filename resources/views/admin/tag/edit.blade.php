@extends('layouts.backend.app')


@push('css')

@endpush
@section('content')

<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                EDIT TAG
                            </h2>
                          
                        </div>
                        <div class="body">
                            <form action="{{route('admin.tag.update',$tagEdit->id)}}" method="post">
                                @csrf
                                @method('PUT')
                                <label for="email_address">Tag Name</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="email_address" value="{{$tagEdit->tag_name}}" name="tag_name" class="form-control" placeholder="Enter tag name">
                                    </div>
                                </div>
                                <label for="password">Description</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="password" value="{{$tagEdit->description}}" name="description" class="form-control" placeholder="Enter description">
                                    </div>
                                </div>

                              
                                <br>
                                <a href="{{route('admin.tag.index')}}" class="btn btn-danger m-t-15 m-r-3">Back</a>
                                <button type="submit" class="btn btn-primary m-t-15 waves-effect">Add</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

@endsection

@push('js')

@endpush