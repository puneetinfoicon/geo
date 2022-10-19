@extends('admin.layout.master')
@section('title', 'Add Page')
@section('content')

    <!--start content-->
    <main class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3"><a href="{{route('adminHome')}}"><i class="bx bx-home-alt"></i></a></div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">Content</li>
                        <li class="breadcrumb-item"><a href="{{route('dynamic.header')}}">Dynamic Header</a></li>
                        <li class="breadcrumb-item"><a href="{{route('dynamic.header')}}">{{$details->name}}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Sub Menu List</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-header py-3">
                <h6 class="mb-0">Add Sub Menu ({{$details->name}})</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-lg-4 d-flex">
                        <div class="card border shadow-none w-100">
                            <div class="card-body">
                                <form class="row g-3" action="{{route('submit_submenus')}}" method="post" enctype="multipart/form-data">

                                    @csrf
                                    <div class="col-12">
                                        <label class="form-label">Name</label>
                                        <input type="text" name = "name" class="form-control" placeholder="Sub Menu name" required>
                                        <input type="hidden" name = "menu_id" class="form-control" value="{{$details->id}}" required>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Name</label>
                                        <input type="text" name = "url" class="form-control" placeholder="/example" required>
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Status</label>
                                        <select name="status" class="form-control" required>
                                            <option value="">Select Status</option>
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>

                                    <div class="col-12">
                                        <div class="d-grid">
                                            <button class="btn btn-primary">Add Menu</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-8 d-flex">
                        <div class="card border shadow-none w-100">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table align-middle ecommerce-products-categories">
                                        @if(isset($submenus))
                                            <thead class="table-light">
                                            <tr>
                                                <!-- <th><input class="form-check-input" type="checkbox"></th> -->
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                        @else
                                            <thead class="table-light">
                                            <tr>
                                                <th>No menus to show</th>
                                            </tr>
                                            </thead>
                                        @endif

                                        <tbody>
                                        @if(isset($submenus))
                                            @foreach($submenus as $key => $menu)
                                                <tr>
                                                    <!-- <td><input class="form-check-input" type="checkbox"></td> -->
                                                    <td>#{{$menu->id}}</td>
                                                    <td>{{$menu->name}}</td>
                                                    <td>@if($menu->status ==1) Active @else Inactive @endif</td>
                                                    <td>
                                                        <div class="d-flex align-items-center gap-3 fs-6">
{{--                                                            <a href="{{route('submenus.listing', $menu->id)}}" class="text-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="View {{$menu->name}}" aria-label="Views">--}}
{{--                                                                <img src="{{asset('admin-assets/images/view.png')}}" alt="">--}}
{{--                                                            </a>--}}

                                                            <a href="{{route('edit_submenu', $menu->id)}}" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Edit {{$menu->name}}" aria-label="Edit">
                                                                <img src="{{asset('admin-assets/images/edit.png')}}" alt="">
                                                            </a>
                                                            <a href="{{route('delete_submenu',[ $menu->id, $menu->menu_id])}}" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Delete {{$menu->name}}" aria-label="Delete">
                                                                <img src="{{asset('admin-assets/images/delete.png')}}" alt="">
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
                                        {{--                                        {{ $categories->links('pagination::bootstrap-4') }}--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--end row-->
            </div>
        </div>

    </main>
    <!--end page main-->
@endsection
