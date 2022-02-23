@extends('layouts.frontend.app')

@push('css')

	<link href="{{asset('asset/frontend/css/ionicons.css')}}" rel="stylesheet">
    <style>
        .favorite_posts{
            color: red!important;
        }
		ion-icon {
          font-size: 25px;
		  margin:3px;
        }

		li{
			font-weight: 700;
		}

		
    </style>
@endpush

@section('content')

<div class="main-slider">
		<div class="swiper-container position-static" data-slide-effect="slide" data-autoheight="false"
			data-swiper-speed="500" data-swiper-autoplay="10000" data-swiper-margin="0" data-swiper-slides-per-view="4"
			data-swiper-breakpoints="true" data-swiper-loop="true" >
			<div class="swiper-wrapper">
			@forelse($category as $category)
                    <div class="swiper-slide">
                        <a class="slider-category" href="{{route('category.post',$category->id)}}">
                            <div class="blog-image"><img src="{{asset('Storage/category/slider/' .$category->image) }}" alt="{{ $category->category_name }}"></div>

                            <div class="category">
                                <div class="display-table center-text">
                                    <div class="display-table-cell">
                                        <h3><b>{{ $category->category_name }}</b></h3>
                                    </div>
                                </div>
                            </div>

                        </a>
                    </div><!-- swiper-slide -->
                @empty
                    <div class="swiper-slide">
                        <strong>No Data Found :(</strong>
                    </div><!-- swiper-slide -->
                @endforelse

            </div><!-- swiper-wrapper -->

        </div><!-- swiper-container -->

    </div><!-- slider -->

	<section class="blog-area section">
		<div class="container">

			<div class="row">

				@foreach($posts as $post)

				<div class="col-lg-4 col-md-6">
					<div class="card h-100">
						<div class="single-post post-style-1">

							<div class="blog-image"><img src="{{asset('Storage/post/' .$post->image)}}" alt="{{$post->title}}"></div>

							<a class="avatar" href="{{route('author.profile' ,$post->user->name)}}"><img src="{{asset('Storage/profile/' .$post->user->image)}}" alt="Profile Image"></a>

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


			</div><!-- row -->

			{{$posts->links()}}

		</div><!-- container -->
	</section><!-- section -->

@endsection