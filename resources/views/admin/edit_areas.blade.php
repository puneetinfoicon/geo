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
                <li class="breadcrumb-item">eCommerce</li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="{{route('areas')}}">Areas</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Area</li>
                </ol>
            </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-header py-3">
                <h6 class="mb-0">Edit Area</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-lg-4 d-flex">
                        <div class="card border shadow-none w-100">
                            <div class="card-body">
                                <form class="row g-3" action="{{route('update_area')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-12">
                                        <label class="form-label">Name</label>
                                        <input type="text" name = "name" class="form-control" placeholder="Area name" value = "{{$category->name}}">
                                        <input type="hidden" name = "id" value = "{{$category->id}}">
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Rank</label>
                                        <input type="number" name = "rank" class="form-control" placeholder="Rank" value = "{{$category->rank}}">
                                    </div>

                                    <label class="form-label">Description</label>
                                    <textarea name="description" id="description" class="summernote" required>{{$category->description}}</textarea>

                                    <!-- <div class="col-12">
                                        <label class="form-label">Icon</label>
                                        <input type="file" name = "icon" class="form-control" >
                                    </div> -->

                                    <div class="col-12">
                                        <div class="d-grid">
                                            <button class="btn btn-primary">Update Area</button>
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
