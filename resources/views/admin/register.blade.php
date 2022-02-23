@extends('layouts.backend.app')


@push('css')

@endpush
@section('content')

<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                ADD AUTHOR
                            </h2>
                          
                        </div>
                        <div class="body">
                            <form action="{{route('admin.author.store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <label for="email_address">Name</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="email_address" name="name" class="form-control" placeholder="Enter author name">
                                    </div>
                                </div>
                                <label for="password">Username</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="password" name="username" class="form-control" placeholder="Enter author username">
                                    </div>
                                </div>

                                <label for="password">Email</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="email" id="password" name="email" class="form-control" placeholder="Enter author email">
                                    </div>
                                </div>

                                <div class="form-group form-float">
                                    <div class="form-line">
                                    <label for="email_address">Select Role</label>
                                    <select name="role_id"  class="form-control show-tick"  >
                                        <option value="">select</option>
                                        <option value="1" style="padding-left:10px">1</option>
                                        <option value="2" style="padding-left:10px">2</option>
                                        
                                    </select>
                                    </div>
                                </div>

                                <label for="password">Pasword</label>
                                <div class="form-group">
                                    <div class="form-line">
                                         <input type="password" id="password" class="form-control" placeholder="Enter your new password" name="password">
                                    </div>
                                </div>

                                <label for="password">Confirm Password</label>
                                <div class="form-group">
                                    <div class="form-line">
                                    <input type="password" id="confirm_password" class="form-control" placeholder="Enter your new password again" name="password_confirmation">
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