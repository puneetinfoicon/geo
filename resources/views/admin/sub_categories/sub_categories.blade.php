@extends('admin.layout.master')
@section('title', 'Add Page')
@section('content') 

    <!--start content-->
    <main class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">eCommerce</div>
            <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{route('adminHome')}}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="{{route('categories')}}">Categories</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Subcategories</li>
                </ol>
            </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-header py-3">
                <h6 class="mb-0">Add Subcategory</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-lg-4 d-flex">
                        <div class="card border shadow-none w-100">
                            <div class="card-body">
                                <form class="row g-3" action="{{route('submit_sub_categories')}}" method="post" enctype="multipart/form-data">

                                    @csrf
                                    <div class="col-12">
                                        <label class="form-label">Name</label>
                                        <input type="text" name = "name" class="form-control" placeholder="Subcategory name">
                                        <input type="hidden" name = "id" value = "{{$category->id}}">
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Icon</label>
                                        <input type="file" name = "icon" class="form-control" >
                                    </div>

                                    <div class="col-12">
                                        <div class="d-grid">
                                            <button class="btn btn-primary">Add Subcategory</button>
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
                            <table class="table align-middle">
                            @if(sizeof($category->subcategoriess) > 0)
                                <thead class="table-light">
                                    <tr>
                                        <!-- <th><input class="form-check-input" type="checkbox"></th> -->
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Icon</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            @else
                                <thead class="table-light">
                                    <tr>
                                        <th>No Categories to show</th>
                                    </tr>
                                </thead>
                            @endif

                            <tbody>
                                @if(sizeof($category->subcategoriess) > 0)
                                    @foreach($category->subcategoriess as $key => $category)
                                        <tr>
                                            <!-- <td><input class="form-check-input" type="checkbox"></td> -->
                                            <td>#{{$category->id}}</td>
                                            <td>{{$category->name}}</td>
                                            <td><img src='{{ asset("$category->image") }}' width="100" height="100"></td>
                                            <td>
                                                <div class="d-flex align-items-center gap-3 fs-6">

                                                    <a href="{{route('edit_subcategories', $category->id)}}"
                                                     class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Edit {{$category->name}}" aria-label="Edit">
                                                     <i class="fas fa-pencil-alt"></i>
                                                    </a>

                                                    <!-- <a href="{{route('edit_categories', $category->id)}}" class="text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Delete" aria-label="Delete"><i class="fas fa-trash-alt"></i></a> -->
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                            </table>
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