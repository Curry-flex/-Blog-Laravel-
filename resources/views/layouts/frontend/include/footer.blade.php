<footer>

		<div class="container">
			<div class="row">

				<div class="col-lg-4 col-md-6">
					<div class="footer-section">

						
						<p class="copyright">CurryFlex blog @ 2022. All rights reserved.</p>
						<p class="copyright">Developed by  <strong>CurryFlex_Tz</strong></p>
						<ul class="icons">
							<li><a href="#"><ion-icon name="logo-facebook" ></ion-icon></i></a></li>
							<li><a href="#"><ion-icon name="logo-twitter"></ion-icon></a></li>
							<li><a href="#"><ion-icon name="logo-instagram"></ion-icon></a></li>
							<li><a href="#"><ion-icon name="logo-linkedin"></ion-icon></a></li>
							<li><a href="#"><ion-icon name="logo-whatsapp"></ion-icon></a></li>
						</ul>

					</div><!-- footer-section -->
				</div><!-- col-lg-4 col-md-6 -->

				<div class="col-lg-4 col-md-6">
						<div class="footer-section">
						<h4 class="title"><b>CATAGORIES</b></h4>
						<ul>
							@foreach($categories as $categories)
							<li><a href="{{route('category.post' ,$categories->id)}}">{{$categories->category_name}}</a></li>
							@endforeach
						</ul>
						
					</div><!-- footer-section -->
				</div><!-- col-lg-4 col-md-6 -->

				<div class="col-lg-4 col-md-6">
					<div class="footer-section">

						<h4 class="title"><b>SUBSCRIBE</b></h4>
						<div class="input-area">
							<form action="{{route('subscriber.store')}}" method="post">
								@csrf
								<input class="email-input" name="email" type="text" placeholder="Enter your email">
								<button class="submit-btn" type="submit"><ion-icon name="search-sharp"></ion-icon></button>
							</form>
						</div>

					</div><!-- footer-section -->
				</div><!-- col-lg-4 col-md-6 -->

			</div><!-- row -->
		</div><!-- container -->
	</footer>