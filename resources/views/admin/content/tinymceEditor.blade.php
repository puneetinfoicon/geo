<!doctype html>
<html lang="en" class="light-theme">

<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href=" {{ asset('admin-assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
    <link href=" {{ asset('admin-assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
    <link href=" {{ asset('admin-assets/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
    <link href=" {{ asset('admin-assets/plugins/vectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet" />
    <link href=" {{ asset('admin-assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
    <link href=" {{ asset('admin-assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href=" {{ asset('admin-assets/css/bootstrap-extended.css') }}" rel="stylesheet" />
    <link href=" {{ asset('admin-assets/css/style.css') }}" rel="stylesheet" />
    <link href=" {{ asset('admin-assets/css/icons.css') }}" rel="stylesheet" />
    <link href=" {{ asset('admin-assets/css/pace.min.css') }}" rel="stylesheet" />
    <link href=" {{ asset('admin-assets/css/dark-theme.css') }}" rel="stylesheet" />
    <link href=" {{ asset('admin-assets/css/light-theme.css') }}" rel="stylesheet" />
    <link href=" {{ asset('admin-assets/css/semi-dark.css') }}" rel="stylesheet" />
    <link href=" {{ asset('admin-assets/css/header-colors.css') }}" rel="stylesheet" />
    <title>Geo Admin</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha256-aAr2Zpq8MZ+YA/D6JtRD3xtrwpEz2IqOS+pWD/7XKIw=" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha256-OFRAJNoaD8L3Br5lglV7VyLRf0itmoBzWUoM+Sji4/8=" crossorigin="anonymous"></script>
</head>
<body>


  <!--start wrapper-->
  <div class="wrapper">
    <!--start top header-->
    <header class="top-header">
      <nav class="navbar navbar-expand">
        <div class="mobile-toggle-icon d-xl-none">
          <i class="bi bi-list"></i>
        </div>
        <div class="top-navbar d-none d-xl-block">
          <!-- <ul class="navbar-nav align-items-center">
              <li class="nav-item">
              <a class="nav-link" href="index">Dashboard</a>
              </li>
              <li class="nav-item">
              <a class="nav-link" href="app-emailbox">Email</a>
              </li>
              <li class="nav-item">
              <a class="nav-link" href="javascript:;">Projects</a>
              </li>
              <li class="nav-item d-none d-xxl-block">
              <a class="nav-link" href="javascript:;">Events</a>
              </li>
              <li class="nav-item d-none d-xxl-block">
              <a class="nav-link" href="app-to-do">Todo</a>
              </li>
            </ul> -->
        </div>
        <!-- <div class="search-toggle-icon d-xl-none ms-auto">
              <i class="bi bi-search"></i>
            </div> -->
        <form class="searchbar d-none d-xl-flex ms-auto">
          <div class="position-absolute top-50 translate-middle-y search-icon ms-3"><i class="bi bi-search"></i></div>
          <!-- <input class="form-control" type="text" placeholder="Type here to search"> -->
          <div class="position-absolute top-50 translate-middle-y d-block d-xl-none search-close-icon"><i class="bi bi-x-lg"></i></div>
        </form>
        <div class="top-navbar-right ms-3">
          <ul class="navbar-nav align-items-center">
            <li class="nav-item dropdown dropdown-large">
              <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
                <div class="user-setting d-flex align-items-center gap-1">
                  <img src="{{asset( imageCheck(Auth::user()->image))}}" class="user-img" alt="">
                  <div class="user-name d-none d-sm-block">{{Auth::user()->name}}</div>
                </div>
              </a>
              <ul class="dropdown-menu dropdown-menu-end">
                <li>
                  <a class="dropdown-item" href="#">
                    <div class="d-flex align-items-center">
                      <img src="{{asset( imageCheck(Auth::user()->image))}}" alt="" class="rounded-circle" width="60" height="60">
                      <div class="ms-3">
                        <h6 class="mb-0 dropdown-user-name">{{Auth::user()->name}}</h6>
                        <small class="mb-0 dropdown-user-designation text-secondary">{{Auth::user()->roles[0]->name}}</small>
                      </div>
                    </div>
                  </a>
                </li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li>
                  <a class="dropdown-item" href="{{route('adminProfile')}}">
                    <div class="d-flex align-items-center">
                      <div class="setting-icon"><i class="bi bi-person-fill"></i></div>
                      <div class="setting-text ms-3"><span>Profile</span></div>
                    </div>
                  </a>
                </li>

                <li>
                  <a class="dropdown-item" href="{{url('/admin')}}">
                    <div class="d-flex align-items-center">
                      <div class="setting-icon"><i class="bi bi-speedometer"></i></div>
                      <div class="setting-text ms-3"><span>Dashboard</span></div>
                    </div>
                  </a>
                </li>

                <li>
                  <a class="dropdown-item" href="{{ route('adminLogout') }}">
                    <div class="d-flex align-items-center">
                      <div class="setting-icon"><i class="bi bi-lock-fill"></i></div>
                      <div class="setting-text ms-3"><span>Logout</span></div>
                    </div>
                  </a>
                </li>
              </ul>
            </li>

          </ul>
        </div>
      </nav>
    </header>
    <!--end top header-->

    <!--start sidebar -->
    <aside class="sidebar-wrapper" data-simplebar="true">
      <div class="sidebar-header">
        <div>
          <a href="{{url('/admin')}}"><img src="{{asset('assets/img/logo.png')}}" class="logo-icon" alt="logo icon"></a>
        </div>
        <div>
          <!-- <h4 class="logo-text">Skodash</h4> -->
        </div>
        <div class="toggle-icon ms-auto"><i class="bi bi-chevron-double-left"></i>
        </div>
      </div>
      <!--navigation-->
      <ul class="" id="menu">

        <li>
          <a href="{{url('/admin')}}" aria-expanded="false">
            <div class="parent-icon"><i class="bi bi-house-door"></i>
            </div>
            <div class="menu-title">Dashboard</div>
          </a>
        </li>


        <li class="">
          <a href="javascript:;" class="has-arrow" aria-expanded="false">
            <div class="parent-icon"><i class="bi bi-arrow-right-short"></i>
            </div>
            <div class="menu-title">Content</div>
          </a>

          <ul class="mm-collapse" style="height: 2px;">
            @php
            $staticPages = getAllStaticPages();
            @endphp
            @foreach ($staticPages as $key => $static)
            @if(isset($page) && $page == $static->page)
            <li class="mm-active grgf"> <a href="{{route('editStatic', $static->page)}}" aria-expanded="true"><i class="bi bi-arrow-right-short"></i>{{ucwords(str_replace("_", " ", $static->page))}}</a>
              @else
            <li> <a href="{{route('editStatic', $static->page)}}" aria-expanded="true"><i class="bi bi-arrow-right-short"></i>{{ucwords(str_replace("_", " ", $static->page))}}</a>
              @endif
              @endforeach
          </ul>

        </li>

        <li class="">
          <a href="javascript:;" class="has-arrow" aria-expanded="false">
            <div class="parent-icon"><i class="bi bi-arrow-right-short"></i>
            </div>
            <div class="menu-title">E-Commerce</div>
          </a>

          <ul class="mm-collapse" style="height: 2px;">
            <li> <a href="{{route('categories')}}" aria-expanded="true"><i class="bi bi-arrow-right-short"></i>Categories</a>
              <!-- <li> <a href="{{route('categories')}}" aria-expanded="true"><i class="bi bi-arrow-right-short"></i>Categories</a>
            <li> <a href="{{route('categories')}}" aria-expanded="true"><i class="bi bi-arrow-right-short"></i>Categories</a> -->
          </ul>

        </li>

        <li class="">
          <a href="javascript:;" class="has-arrow" aria-expanded="false">
            <div class="parent-icon"><i class="bi bi-arrow-right-short"></i>
            </div>
            <div class="menu-title">Users</div>
          </a>

          <ul class="mm-collapse" style="height: 2px;">
            <li> <a href="{{route('addTeam')}}" aria-expanded="true"><i class="bi bi-arrow-right-short"></i>Team</a>
              <!-- <li> <a href="{{route('categories')}}" aria-expanded="true"><i class="bi bi-arrow-right-short"></i>Categories</a>
            <li> <a href="{{route('categories')}}" aria-expanded="true"><i class="bi bi-arrow-right-short"></i>Categories</a> -->
          </ul>

        </li>


        <!-- <li> <a href="{{route('categories')}}"><i class="bi bi-arrow-right-short"></i>Categories</a>
        </li>

        <li> <a href="{{route('addProducts')}}"><i class="bi bi-arrow-right-short"></i>Add New Product</a>
        </li>

        <li> <a href="{{route('customerList')}}"><i class="bi bi-arrow-right-short"></i>Customers</a>
        </li>

        <li>
          <a href="javascript:;" class="has-arrow">
            <div class="parent-icon"><i class="bi bi-bag-check"></i>
            </div>
            <div class="menu-title">eCommerce</div>
          </a>
          <ul>
            <li> <a href="{{route('productsLists')}}"><i class="bi bi-arrow-right-short"></i>Products List</a>
            </li>
            <li> <a href="ecommerce-products-grid"><i class="bi bi-arrow-right-short"></i>Products Grid</a>
            </li>
            <li> <a href="{{route('categories')}}"><i class="bi bi-arrow-right-short"></i>Categories</a>
            </li>
            <li> <a href="ecommerce-orders"><i class="bi bi-arrow-right-short"></i>Orders</a>
            </li>
            <li> <a href="ecommerce-orders-detail"><i class="bi bi-arrow-right-short"></i>Order details</a>
            </li>
            <li> <a href="{{route('addProducts')}}"><i class="bi bi-arrow-right-short"></i>Add New Product</a>
            </li>
            <li> <a href="ecommerce-add-new-product-2"><i class="bi bi-arrow-right-short"></i>Add New Product 2</a>
            </li>
            <li> <a href="ecommerce-transactions"><i class="bi bi-arrow-right-short"></i>Transactions</a>
            </li>
          </ul>
        </li> -->

      </ul>
      <!--end navigation-->
    </aside>
    <!--end sidebar -->



    @if(Session::has('message'))
    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">

          <div class="modal-body text-center">
            <p class="mb-0"> <strong>{{htmlspecialchars_decode(Session::get('message'))}}</strong></p>
          </div>

        </div>

      </div>
    </div>
    @endif

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div id="showimages"></div>
            </div>
            <div class="col-md-6 offset-3 mt-5">
                <div class="card">
                    <div class="card-header bg-info">
                    </div>
                    <div class="card-body">
                        <form class="image-upload" method="post" action="" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="description" rows="50" cols="40" class="form-control tinymce-editor">{{$content}}</textarea>
                            </div>
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-success btn-sm">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="https://cdn.tiny.cloud/1/pfr1te3j9ruungzvxr80x7q43in0n7oau6hqxjl7iy7uqxgj/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>


    <script type="text/javascript">
        var uploadUrl = '{{ route("imgUpload") }}';

        tinymce.init({
            selector: 'textarea.tinymce-editor',
            images_upload_url: uploadUrl,

            plugins: [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table paste code help wordcount'
            ],
            toolbar: 'undo redo | formatselect | ' +
                'bold italic backcolor | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat | help',
            content_css: '//www.tiny.cloud/css/codepen.min.css'
        });
    </script>

</div>







<style>
  .modal-body h1 {
    font-weight: 900;
    font-size: 2.3em;
    text-transform: uppercase;
  }

  .modal-body a.pre-order-btn {
    color: #000;
    background-color: gold;
    border-radius: 1em;
    padding: 1em;
    display: block;
    margin: 2em auto;
    width: 50%;
    font-size: 1.25em;
    font-weight: 6600;
  }

  .modal-body a.pre-order-btn:hover {
    background-color: #000;
    text-decoration: none;
    color: gold;
  }
</style>

<script src="{{ asset('admin-assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('admin-assets/js/jquery.min.js') }}"></script>
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<script src="{{ asset('admin-assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
<script src="{{ asset('admin-assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
<!-- <script src="{{ asset('admin-assets/plugins/easyPieChart/jquery.easypiechart.js') }}"></script> -->
<script src="{{ asset('admin-assets/plugins/peity/jquery.peity.min.js') }}"></script>
<!-- <script src="{{ asset('admin-assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script> -->
<script src="{{ asset('admin-assets/js/pace.min.js') }}"></script>
<!-- <script src="{{ asset('admin-assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js') }}"></script> -->
<!-- <script src="{{ asset('admin-assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js') }}"></script> -->
<!-- <script src="{{ asset('admin-assets/plugins/apexcharts-bundle/js/apexcharts.min.js') }}"></script> -->
<script src="{{ asset('admin-assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin-assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
<script src="{{ asset('admin-assets/js/app.js') }}"></script>
<script src="{{ asset('admin-assets/js/index.js') }}"></script>
<script>
  $(document).ready(function() {
    $('#myModal').modal('show');
  });
</script>


<script>
  //  new PerfectScrollbar(".best-product")
  //  new PerfectScrollbar(".top-sellers-list")
</script>

</body>

</html>
