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
                    <li class="breadcrumb-item active" aria-current="page"><a href="{{route('search_categories')}}">Search Categories</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Search Category</li>
                </ol>
            </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-header py-3">
                <h6 class="mb-0">Edit Search Category</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-lg-4 d-flex">
                        <div class="card border shadow-none w-100">
                            <div class="card-body">
                                <form class="row g-3" action="{{route('update_search_categories')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-12">
                                        <label class="form-label">Name</label>
                                        <input type="text" name = "name" class="form-control" placeholder="Category name" value = "{{$category->name}}">
                                        <input type="hidden" name = "id" value = "{{$category->id}}">
                                    </div>

                                    <!-- <div class="col-12">
                                        <label class="form-label">Icon</label>
                                        <input type="file" name = "icon" class="form-control" >
                                    </div> -->

                                    <div class="col-12">
                                        <div class="d-grid">
                                            <button class="btn btn-primary">Update Category</button>
                                        </div>
                                    </div>
                                </form>
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