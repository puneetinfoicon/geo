@extends('admin.layout.master')
@section('title', 'Add Page')
@section('content')

    <!--start content-->
    <main class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3"><a href="{{route('adminHome')}}"><i class="bx bx-home-alt"></i></a> </div>
            <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item">eCommerce </li>
                <li class="breadcrumb-item active" aria-current="page">Areas</li>
                </ol>
            </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-header py-3">
                <h6 class="mb-0">Add Area</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-lg-4 d-flex">
                        <div class="card border shadow-none w-100">
                            <div class="card-body">
                                <form class="row g-3" action="{{route('submit_area')}}" method="post" enctype="multipart/form-data">

                                    @csrf
                                    <div class="col-12">
                                        <label class="form-label">Name</label>
                                        <input type="text" name = "name" class="form-control" placeholder="Area name">
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Rank</label>
                                        <input type="number" name = "rank" class="form-control" placeholder="Rank">
                                    </div>

                                    <label class="form-label">Description</label>
                                    <textarea name="description" id="description" class="form-control summernote" required></textarea>

                                    <!-- <div class="col-12">
                                        <label class="form-label">Icon</label>
                                        <input type="file" name = "icon" class="form-control" >
                                    </div> -->

                                    <div class="col-12">
                                        <div class="d-grid">
                                            <button class="btn btn-primary">Add Area</button>
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
                            @if(sizeof($areas) > 0)
                                <thead class="table-light">
                                    <tr>
                                        <!-- <th><input class="form-check-input" type="checkbox"></th> -->
                                        <th>Rank</th>
                                        <th>Name</th>
                                        <!-- <th>Icon</th> -->
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            @else
                                <thead class="table-light">
                                    <tr>
                                        <th>No Area to show</th>
                                    </tr>
                                </thead>
                            @endif

                            <tbody>
                                @if(sizeof($areas) > 0)
                                    @foreach($areas as $key => $category)
                                        <tr>
                                            <!-- <td><input class="form-check-input" type="checkbox"></td> -->
                                            <td>#{{$category->rank}}</td>
                                            <td>{{$category->name}}</td>
                                            <!-- <td><img src="{{ asset( imageCheck($category->image)) }}" width="100" height="100"></td> -->
                                            <td>
                                                <div class="d-flex align-items-center gap-3 fs-6">

                                                    <a href="{{route('edit_area', $category->id)}}" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Edit {{$category->name}}" aria-label="Edit">
                                                        <img src="{{asset('admin-assets/images/edit.png')}}" alt="">
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
                                {{ $areas->links('pagination::bootstrap-4') }}
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
@section('js')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>
    <script>
        $(document).ready(function () {
            $(".summernote").summernote({
                placeholder: "Write your content here",
                height: 200,
            });
        });
    </script>
@endsection
