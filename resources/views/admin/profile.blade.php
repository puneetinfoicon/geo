@extends('admin.layout.master')
@section('title', 'Profile')
@section('content')
<!--start content-->
<main class="page-content">

<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
  <div class="breadcrumb-title pe-3 "><a href="{{route('adminHome')}}"><i class="bx bx-home-alt"></i></a></div>
  <div class="ps-3">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb mb-0 p-0">
        <li class="breadcrumb-item active" aria-current="page">User Profile</li>
      </ol>
    </nav>
  </div>
</div>
<!--end breadcrumb-->

<!-- <div class="profile-cover bg-dark"></div>   -->

<div class="row">
  <div class="col-12 col-lg-8">
    <div class="card shadow-sm border-0">
        <form class="card-body" action="{{route('adminProfileUpdate')}}" method="post" enctype="multipart/form-data">
            @csrf
          <h5 class="mb-0">My Account</h5>
          <hr>
          <div class="card shadow-none border">
            <div class="card-header">
              <h6 class="mb-0">USER INFORMATION</h6>
            </div>
            <div class="card-body">
              <div class="row g-3">
                  <div class="col-6">
                    <label class="form-label">Username</label>
                    <input type="text" class="form-control" name ="name" value="{{$user->name}}" required>
                  </div>
                  <div class="col-6">
                    <label class="form-label">Email address</label>
                    <input type="text" class="form-control" name ="email" value="{{$user->email}}" required>
                  </div>

                  <div class="col-12">
                    <label class="form-label">Profile picture</label>
                    <input class="form-control" name = "image" type="file">
                  </div>
            </div>
          </div>
          <div class="card shadow-none">
            <div class="card-header">
              <h6 class="mb-0">CONTACT INFORMATION</h6>
            </div>
            <div class="card-body">
                <div class="col-12">
                  <label class="form-label">Address</label>
                  <input type="text" class="form-control" name ="address" value="{{$user->address}}" required>
                 </div>

                <div class="row">
                 <div class="col-6">
                    <label class="form-label">City</label>
                    <input type="text" class="form-control" name ="city" value="{{$user->city}}" required>
                 </div>
                 <div class="col-6">
                  <label class="form-label">Country</label>
                  <input type="text" class="form-control" name ="country" value="{{$user->country}}" required>
                </div>
                  <div class="col-6">
                    <label class="form-label">Pin Code</label>
                    <input type="text" class="form-control" name ="pincode" value="{{$user->pincode}}" required>
                </div>
                  <div class="col-6">
                    <label class="form-label">Phone</label>
                    <input type="text" class="form-control" name ="mobile" value="{{$user->mobile}}" required>
                </div>
                </div>

            </div>
          </div>
          <div class="text-start p-4">
            <button type="submit" class="btn btn-primary px-4">Save Changes</button>
          </div>
        </form>
    </div>
  </div>
</div>
  <div class="col-12 col-lg-4">
    <div class="card shadow-sm border-0 overflow-hidden">
      <div class="card-body">
          <div class="profile-avatar text-center">
            <img src='{{ asset("$user->image") }}' class="rounded-circle shadow" width="120" height="120" alt="">
          </div>
          <div class="text-center mt-4">
            <h4 class="mb-1">{{$user->name}}</h4>
            <p class="mb-0 text-secondary">{{isset($user->city)?$user->city . ", ": ''}}{{$user->country}}</p>
            <div class="mt-4"></div>
            <h6 class="mb-1">{{$user->roles[0]->name}}</h6>
          </div>
          <hr>
      </div>
    </div>
  </div>
</div><!--end row-->

</main>
<!--end page main-->
@endsection('content')
