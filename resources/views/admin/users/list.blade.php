@extends('admin.layout.master')
@section('title', 'Add Page')
@section('content')

<!--start content-->
    <main class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Users</div>
            <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Users List</li>
                </ol>
            </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-middle table-striped ecommerce-products-list">
                        <thead class="table-light">
                            <tr>
                                <th>User Id</th>
                                <th>Name</th>
                                <th>Photo</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Joining Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(sizeof($users) > 0)
                                @foreach($users as $user)
                                    @php
                                        //$image = $user->imagess[0]->url;

                                    @endphp
                                    <tr>

                                        <td class="productlist">
                                        <a class="d-flex align-items-center gap-2" href="#">
                                            <div>
                                                <h6 class="mb-0 product-title">{{$user->id}}</h6>
                                            </div>
                                        </a>
                                        </td>

                                        <td class="productlist">
                                        <a class="d-flex align-items-center gap-2" href="#">
                                            <div>
                                                <h6 class="mb-0 product-title">{{$user->name}}</h6>
                                            </div>
                                        </a>
                                        </td>

                                        <td class="productlist">
                                            <a class="d-flex align-items-center gap-2" href="#">
                                                <div class="product-box">

                                                    <img src="{{ asset( imageCheck($user->image)) }}" width="100" height="100" class="rounded-circle shadow">

                                                </div>
                                            </a>
                                        </td>

                                        <td class="productlist">
                                        <a class="d-flex align-items-center gap-2" href="#">
                                            <div>
                                                <h6 class="mb-0 product-title">{{$user->email}}</h6>
                                            </div>
                                        </a>
                                        </td>

                                        <td class="productlist">
                                        <a class="d-flex align-items-center gap-2" href="#">
                                            <div>
                                                @if($user->status == 0)
                                                    <h6 class="mb-0 product-title">Inactive</h6>
                                                @elseif($user->status == 0)
                                                    <h6 class="mb-0 product-title">Active</h6>
                                                @else
                                                    <h6 class="mb-0 product-title">Blocked</h6>
                                                @endif
                                            </div>
                                        </a>
                                        </td>

                                        <td><span>{{date('Y-m-d', strtotime($user->created_at))}}</span></td>

                                        <td>
                                            <div class="d-flex align-items-center gap-3 fs-6">
                                                <a href="{{route('viewUser', $user->id)}}" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Edit {{$user->name}}" aria-label="Views">
                                                    <img src="{{asset('admin-assets/images/view.png')}}" alt="">
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>

                <div class="d-flex">
                    <div class="mx-auto">
                        {{ $users->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>

    </main>
<!--end page main-->

@endsection
