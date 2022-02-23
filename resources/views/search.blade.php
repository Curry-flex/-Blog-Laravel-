@extends('layouts.frontend.app')



@push('css')
    <link href="{{ asset('asset/frontend/css/category/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/frontend/css/category/responsive.css') }}" rel="stylesheet">
    <style>
        .slider {
            height: 400px;
            width: 100%;
            background-image: url({{ asset('asset/frontend/images/slider-1.jpg') }});
            background-size: cover;
        }
        .favorite_posts{
            color: blue;
        }
    </style>
@endpush

@section('content')
    <div class="slider display-table center-text">
        <h1 class="title display-table-cell"><b>{{$posts->count()}} Results for {{ $query }}</b></h1>
    </div><!-- slider -->

    <section class="blog-area section">
        <div class="container">

   
        <div class="row">

        @if($posts->count()>0)

      @foreach($posts as $post)

        <div class="col-lg-4 col-md-6">
            <div class="card h-100">
                <div class="single-post post-style-1">

                    <div class="blog-image"><img src="{{asset('Storage/post/' .$post->image)}}" alt="{{$post->title}}"></div>

                    <a class="avatar" href="#"><img src="{{asset('Storage/profile/' .$post->user->image)}}" alt="Profile Image"></a>

                    <div class="blog-info">

                        <h4 class="title"><a href="{{ route('post.details',$post->id) }}"><b>{{$post->title}}</b></a></h4>
                        <ul class="post-footer">
									<li>
										@guest
										<a href="javascript:void(0);" onclick="toastr.info('To add favorite list. You need to login first.','Info',{
                                                    closeButton: true,
                                                    progressBar: true,
                                                })"><ion-icon name="heart-sharp"></ion-icon>{{ $post->favourite_user->count() }}</a>
                                        @else

										<a href="javascript:void(0);" onclick="document.getElementById('favorite-form-{{ $post->id }}').submit();"
										class="{{ !Auth::user()->favourite_post->where('pivot.post_id',$post->id)->count()  == 0 ? 'favorite_posts' : ''}}">
										
										<ion-icon  name="heart-sharp">

										</ion-icon>{{ $post->favourite_user->count() }}
										
										<form id="favorite-form-{{ $post->id }}" method="POST" action="{{ route('post.favourite',$post->id) }}" style="display: none;">
                                                    @csrf
                                             </form>
									</a>

										@endguest
								</li>
								
									<li><a href="#"><ion-icon name="chatbubble-sharp"></ion-icon>{{$post->comments->count()}}</a></li>
									<li><a href="#"><ion-icon name="eye-sharp"></ion-icon>{{$post->view_count}}</a></li>
								</ul>
                                
                    </div><!-- blog-info -->
                </div><!-- single-post -->
            </div><!-- card -->
        </div><!-- col-lg-4 col-md-6 -->
        @endforeach

        @else
        <div class="col-lg-12 col-md-12">
            <div class="card h-100">
                <div class="single-post post-style-1">

                   <div class="blog-info">

                        <h4 class="title">
                          <strong>Sorry no post found</strong>
                        </h4>

                        

                    </div><!-- blog-info -->
                </div><!-- single-post -->
            </div><!-- card -->
        </div><!-- col-lg-4 col-md-6 -->
        @endif

            </div><!-- row -->

         {{$posts->links()}}

        </div><!-- container -->
    </section><!-- section -->

@endsection

@push('js')

@endpush