<header>
		<div class="container-fluid position-relative no-side-padding">

			<a href="#" class="logo">CurryFlex Blog</a>

			<div class="menu-nav-icon" data-nav-menu="#main-menu"><i class="ion-navicon"></i></div>

			<ul class="main-menu visible-on-click" id="main-menu">
				<li><a href="{{route('home')}}">Home</a></li>
				@if(Auth::user())
				<li>
				<a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                         logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                     </a>
				</li>
				@else
				<li><a href="{{route('register')}}">Register</a></li>
				<li><a href="{{route('login')}}">Login</a></li>
				@endif
				
				
			</ul><!-- main-menu -->

			<div class="src-area">
				<form method="post" action="{{route('search')}}">
					@csrf
					<button class="src-btn" type="submit"><ion-icon name="search-sharp"></ion-icon></button>
					<input class="src-input" name="search" value="{{ isset($query)? $query : ''}}" type="text" placeholder="Type of search">
				</form>
			</div>

		</div><!-- conatiner -->
	</header>