@extends('layouts.backend.app')



@push('css')

@endpush

@section('content')
    <div class="container-fluid">
           <!-- Vertical Layout | With Floating Label -->
           <a href="{{ route('admin.post.index') }}" class="btn btn-danger waves-effect">BACK</a>
        @if($post->is_approved == false)
            @if(Request::is('author*'))
            <button type="button" disabled class="btn btn-danger waves-effect pull-right" onclick="approvePost({{ $post->id }})">
                <i class="material-icons"></i>
                <span>pending</span>
            </button>
            @else
            <button type="button" class="btn btn-success waves-effect pull-right" onclick="approvePost({{ $post->id }})">
                <i class="material-icons">done</i>
                <span>Approve</span>
            </button>
            @endif


            <form method="post" action="{{route('admin.post.approve',$post->id)}}" id="approval-form" style="display: none">
                @csrf
                @method('PUT')
            </form>
        @else
            <button type="button" class="btn btn-success pull-right" disabled>
                <i class="material-icons">done</i>
                <span>Approved</span>
            </button>
        @endif
    
        <br>
            <div class="row clearfix">
                <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                              {{ $post->title }}
                                <small>Posted By <strong> <a href="">{{ $post->user->name }}</a></strong> on {{ $post->created_at->toFormattedDateString() }}</small>
                            </h2>
                        </div>
                        <div class="body">
                            {!! $post->body !!}
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header bg-cyan">
                            <h2>
                                Categoryies
                            </h2>
                        </div>
                        <div class="body">
                            @foreach($post->categories as $category)
                                <span class="label bg-cyan">{{ $category->category_name }}</span>
                            @endforeach
                        </div>
                    </div>
                    <div class="card">
                        <div class="header bg-green">
                            <h2>
                                Tags
                            </h2>
                        </div>
                        <div class="body">
                            @foreach($post->tags as $tag)
                                <span class="label bg-green">{{ $tag->tag_name }}</span>
                            @endforeach
                        </div>
                    </div>
                    <div class="card">
                        <div class="header bg-amber">
                            <h2>
                                Featured Image
                            </h2>
                        </div>
                        <div class="body">
                            <img class="img-responsive thumbnail" src="{{asset('Storage/post/' .$post->image)}}" alt="{{$post->image}}">
                        </div>
                    </div>

                </div>
            </div>
    </div>
@endsection

@push('js')
    <!-- Select Plugin Js -->
    <script src="{{ asset('asset/backend/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>
    <!-- TinyMCE -->
    <script src="{{ asset('asset/backend/plugins/tinymce/tinymce.js') }}"></script>
    <script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>
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
            tinyMCE.baseURL = '{{ asset('asset/backend/plugins/tinymce') }}';
        });
        function approvePost(id) {
            swal({
                title: 'Are you sure?',
                text: "You went to approve this post ",
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
                    document.getElementById('approval-form').submit();
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