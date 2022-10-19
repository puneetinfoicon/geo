@extends('admin.layout.master')
@section('title', 'Profile')
@section('content') 
<!--start content-->
<main class="page-content">

<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
  <div class="breadcrumb-title pe-3 ">Pages</div>
  <div class="ps-3">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb mb-0 p-0">
        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
        </li>
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
          <h5 class="mb-0">Account</h5>
          <hr>
          <div class="card shadow-none border">
            <div class="card-header">
              <h6 class="mb-0">USER INFORMATION</h6>
            </div>
            <div class="card-body">
              <div class="row g-3">
                  <div class="profile-avatar text-center">
                    <img src="{{ asset( imageCheck($user->image)) }}" class="rounded-circle shadow" width="120" height="120" alt="">
                  </div>

                  <div class="col-6">
                    <label class="form-label">Username</label>
                    <input type="text" class="form-control" name ="name" value="{{$user->name}}" required disabled>
                  </div>
                  <div class="col-6">
                    <label class="form-label">Email address</label>
                    <input type="text" class="form-control" name ="email" value="{{$user->email}}" required disabled>
                  </div>
            </div>
          </div>
          <div class="card shadow-none">
            <div class="card-header">
              <h6 class="mb-0">CONTACT INFORMATION</h6>
            </div>
            <div class="row card-body">
                <div class="col-12">
                  <label class="form-label">Address</label>
                  <input type="text" class="form-control" name ="address" value="{{$user->address}}" required disabled>
                 </div>
                 <div class="col-md-6">
                    <label class="form-label">City</label>
                    <input type="text" class="form-control" name ="city" value="{{$user->city}}" required disabled>
                 </div>
                 <div class="col-md-6">
                  <label class="form-label">Country</label>
                  <input type="text" class="form-control" name ="country" value="{{$user->country}}" required disabled>
                </div>
                  <div class="col-md-6">
                    <label class="form-label">Pin Code</label>
                    <input type="text" class="form-control" name ="pincode" value="{{$user->pincode}}" required disabled>
                </div>
                  <div class="col-md-6">
                    <label class="form-label">Phone</label>
                    <input type="text" class="form-control" name ="mobile" value="{{$user->mobile}}" required disabled>
                </div>
                  <div class="col-md-6">
                    <label class="form-label">Phone</label>
                    <input type="text" class="form-control" name ="mobile" value="{{$user->mobile}}" required disabled>
                </div>
                @if($user->status == 1)

                  <p class="mt-3">Click <a href="{{route('userAdminUpdate', [$user->id, 2])}}">here</a> to block this user</p>

                @elseif($user->status == 0)

                  <p class="mt-3">Click <a href="{{route('userAdminUpdate', [$user->id, 1])}}">here</a> to activate this user</p>

                @else
                  <p class="mt-3">Click <a href="{{route('userAdminUpdate', [$user->id, 1])}}">here</a> to unblock this user</p>

                @endif
                
              
              
               



            </div>
          </div>
        </form>
    </div>
  </div>
</div>
</div><!--end row-->

</main>
<!--end page main-->
@endsection('content') 