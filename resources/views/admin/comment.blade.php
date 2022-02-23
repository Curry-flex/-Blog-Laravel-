@extends('layouts.backend.app')


@push('css')
<link href="{{ asset('asset/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">
@endpush
@section('content')

<div class="container-fluid">
            <div class="block-header">
             
            </div>
            <!-- Basic Examples -->
            
            <!-- #END# Basic Examples -->
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                ALL COMMENTS
                                <span class="badge bg-blue">{{$comment->count()}}</span>
                                
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                <tr>
                                   
                                    <th class="text-center">Comment info</th>
                                    <th class="text-center">Post info</th>
                                    <th class="text-center">Action</th>
                                  
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>

                                    <th class="text-center">Comment info</th>
                                    <th class="text-center">Post info</th>
                                    <th class="text-center">Action</th>
                                </tr>

                                </tfoot>
                                <tbody>
                                    @foreach($comment as $comment)
                                        <tr>
                                            <td>
                                             <div class="media">
                                                 <div class="media-left">
                                                     <a href="#">
                                                     <img src="{{asset('Storage/profile/' .$comment->user->image)}}" width="60" height="60" alt="User" />
                                                     </a>
                                                 </div>

                                                 <div class="media-body">
                                                    <h4 class="media-heading">{{$comment->user->name}}
                                                    <small>{{$comment->created_at->diffForHumans()}}</small>
                                                    </h4>
                                                    <p>{{$comment->comment}}</p>
                                                    <a target="_blank" href="{{route('post.details',$comment->post->id ,'#comment')}}"></a>
                                                    
                                                 </div>

                                             </div>
                                            </td>

                                            <td>
                                             <div class="media">
                                                 <div class="media-right">
                                                     <a target="_blank" href="{{route('post.details',$comment->post->id)}}">
                                                     <img src="{{asset('Storage/post/' .$comment->post->image)}}" width="60" height="60" alt="User" />
                                                     </a>
                                                 </div>

                                                 <div class="media-body">
                                                  <a target="_blank" href="{{route('post.details',$comment->post->id)}}">
                                                      
                                                  <h4 class="media-heading">{{str_limit($comment->post->title,'40')}}</h4>
                                                  <p>Posted by <strong>{{$comment->user->name}}</strong></p>
                                                  </a>
                                                    
                                                 </div>

                                             </div>
                                            </td>

                                            <td>
                                            <button class="btn btn-danger" 
                                                onclick="deletecomment({{$comment->id}})"
                                                >
                                                    <i class="material-icons">delete</i>
                                                </button>

                                                <form  id="delete-comment-{{$comment->id}}" action="{{route('admin.comment.destroy',$comment->id)}}" method="post" style="display:none;">
                                                  @csrf
                                                  @method('DELETE')

                                                </form>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
        </div>

@endsection

@push('js')

 <!-- Jquery DataTable Plugin Js -->
 <script src="{{ asset('asset/backend/plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('asset/backend/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>
    <script src="{{ asset('asset/backend/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('asset/backend/plugins/jquery-datatable/extensions/export/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('asset/backend/plugins/jquery-datatable/extensions/export/jszip.min.js') }}"></script>
    <script src="{{ asset('asset/backend/plugins/jquery-datatable/extensions/export/pdfmake.min.js') }}"></script>
    <script src="{{ asset('asset/backend/plugins/jquery-datatable/extensions/export/vfs_fonts.js') }}"></script>
    <script src="{{ asset('asset/backend/plugins/jquery-datatable/extensions/export/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('asset/backend/plugins/jquery-datatable/extensions/export/buttons.print.min.js') }}"></script>

    <script src="{{ asset('asset/backend/js/pages/tables/jquery-datatable.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.0/dist/sweetalert2.all.min.js"></script>
    <script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>

    

<script>
   
        function deletecomment($id) {
            swal({
                title: 'Are you sure?',
                text: "You want to approve this post ",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, approve it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('delete-comment-' + $id).submit();
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swal(
                        'Cancelled',
                        'The post remain pending :)',
                        'info'
                    )
                }
            })
        }
    </script>

@endpush