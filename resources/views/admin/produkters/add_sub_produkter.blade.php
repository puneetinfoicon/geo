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
                <li class="breadcrumb-item" aria-current="page"><a href="{{route('produktersLists')}}">Produkt menu</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$name}}</li>
                </ol>
            </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-header py-3">
                <h6 class="mb-0">Add Produkt under-menu</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-lg-4 d-flex">
                        <div class="card border shadow-none w-100">
                            <div class="card-body">
                                <form class="row g-3" action="{{route('submitSubProdukter')}}" method="post" enctype="multipart/form-data">

                                    @csrf
                                    <div class="col-12">
                                        <label class="form-label">Name</label>
                                        <input type="text" name = "name" class="form-control" placeholder="Name" required>
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Link</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon3">{{str_replace(request()->path(), "", url()->current())}}</span>
                                        </div>
                                        <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" name="link" value="">
                                    </div>
                                    <input type="hidden" name = "produkterId" class="form-control" value="{{$produkterId}}">

                                    <div class="col-12">
                                        <div class="d-grid">
                                            <button class="btn btn-primary">Add Sub-produkt</button>
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
                            @if(sizeof($categories) > 0)
                                <thead class="table-light">
                                    <tr>
                                        <!-- <th><input class="form-check-input" type="checkbox"></th> -->
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            @else
                                <thead class="table-light">
                                    <tr>
                                        <th>No data to show</th>
                                    </tr>
                                </thead>
                            @endif

                            <tbody>
                                @if(sizeof($categories) > 0)
                                    @foreach($categories as $key => $category)
                                        <tr>
                                            <!-- <td><input class="form-check-input" type="checkbox"></td> -->
                                            <td>#{{$category->id}}</td>
                                            <td>{{$category->name}}</td>
                                            <td>
                                                <div class="d-flex align-items-center gap-3 fs-6">

                                                    <a href="{{route('editSubProdukter', $category->id)}}" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Edit {{$category->name}}" aria-label="Edit">
                                                        <img src="{{asset('admin-assets/images/edit.png')}}" alt="">
                                                    </a>
                                                    <a href="{{route('deleteSubProdukter', $category->id)}}" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Delete {{$category->name}}" aria-label="Delete">
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
                                {{ $categories->links('pagination::bootstrap-4') }}
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
