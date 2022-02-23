@extends('layouts.backend.app')


@push('css')

@endpush
@section('content')
<div class="container-fluid">
        <div class="block-header">
          <h2>AUTHOR</h2>
        </div>

        <!-- Widgets -->
        <div class="row clearfix">
          <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-green hover-expand-effect">
              <div class="icon">
                <i class="material-icons">playlist_add_check</i>
              </div>
              <div class="content">
                <div class="text">TOTAL POST</div>
                <div
                  class="number count-to"
                  data-from="0"
                  data-to="{{$post->count()}}"
                  data-speed="15"
                  data-fresh-interval="20"
                ></div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-cyan hover-expand-effect">
              <div class="icon">
                <i class="material-icons">apps</i>
              </div>
              <div class="content">
                <div class="text">Category</div>
                <div
                  class="number count-to"
                  data-from="0"
                  data-to="{{$categories}}"
                  data-speed="1000"
                  data-fresh-interval="20"
                ></div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-red hover-expand-effect">
              <div class="icon">
                <i class="material-icons">forum</i>
              </div>
              <div class="content">
                <div class="text">PENDING POST</div>
                <div
                  class="number count-to"
                  data-from="0"
                  data-to="{{$pending->count()}}"
                  data-speed="1000"
                  data-fresh-interval="20"
                ></div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-orange hover-expand-effect">
              <div class="icon">
                <i class="material-icons">visibility</i>
              </div>
              <div class="content">
                <div class="text">TOTAL VIEWS</div>
                <div
                  class="number count-to"
                  data-from="0"
                  data-to="{{$all_views}}"
                  data-speed="1000"
                  data-fresh-interval="20"
                ></div>
              </div>
            </div>
          </div>
        </div>
  

        <div class="row clearfix">
          <!-- Task Info -->
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="card">
              <div class="header">
                <h2>TOP 5 POPULAR POST</h2>
                <ul class="header-dropdown m-r--5">
                  <li class="dropdown">
                    <a
                      href="javascript:void(0);"
                      class="dropdown-toggle"
                      data-toggle="dropdown"
                      role="button"
                      aria-haspopup="true"
                      aria-expanded="false"
                    >
                      <i class="material-icons">more_vert</i>
                    </a>
                    <ul class="dropdown-menu pull-right">
                      <li><a href="javascript:void(0);">Action</a></li>
                      <li><a href="javascript:void(0);">Another action</a></li>
                      <li>
                        <a href="javascript:void(0);">Something else here</a>
                      </li>
                    </ul>
                  </li>
                </ul>
              </div>
              <div class="body">
                <div class="table-responsive">
                  <table class="table table-hover dashboard-task-infos">
                    <thead>
                      <tr>
                        <th>Rank List</th>
                        <th>Title</th>
                        <th>Views</th>
                        <th>Comment</th>
                        <th>Favourite</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                     @foreach($popular_post as $key=>$post)
                     <tr>
                       <td>{{$key + 1}}</td>
                       <td>{{str_limit($post->title,40)}}</td>
                        <td>{{$post->view_count}}</td>
                        <td>{{$post->comments_count}}</td>
                        <td>{{$post->favourite_user_count}}</td>
                        <td>
                           @if($post->status ==true)
                             <span class="label bg-green">Published</span>
                           @else
                           <span class="label bg-success">Pending</span>
                           @endif
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
      </div>

@endsection


@push('js')


    <!-- Jquery CountTo Plugin Js -->
    <script src="{{ asset('asset/backend/plugins/jquery-countto/jquery.countTo.js') }}"></script>

    <!-- Morris Plugin Js -->
    <script src="{{ asset('asset/backend/plugins/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('asset/backend/plugins/morrisjs/morris.js') }}"></script>

    <!-- ChartJs -->
    <script src="{{ asset('asset/backend/plugins/chartjs/Chart.bundle.js') }}"></script>

    <!-- Flot Charts Plugin Js -->
    <script src="asset/backend/plugins/flot-charts/jquery.flot.js"></script>
    <script src="asset/backend/plugins/flot-charts/jquery.flot.resize.js"></script>
    <script src="asset/backend/plugins/flot-charts/jquery.flot.pie.js"></script>
    <script src="asset/backend/plugins/flot-charts/jquery.flot.categories.js"></script>
    <script src="asset/backend/plugins/flot-charts/jquery.flot.time.js"></script>

    <!-- Sparkline Chart Plugin Js -->
    <script src="asset/backend/plugins/jquery-sparkline/jquery.sparkline.js"></script>
    <script src="{{ asset('asset/backend/js/pages/index.js') }}"></script>














@endpush