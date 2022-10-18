@extends('admin.layout.master')
@section('title', 'Add Page')
@section('content')
    <style>
        .form-check {
            display: inline-block !important;
        }
    </style>
    <!--start content-->
    <main class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3"><a href="{{route('adminHome')}}"><i class="bx bx-home-alt"></i></a></div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">Content</li>
                        <li class="breadcrumb-item"><a href="{{route('dynamicPages')}}">Dynamic Content List</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Footer</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card">
                    <div class="card-header py-3 bg-transparent">
                        <h5 class="mb-0">Edit Footer</h5>
                    </div>
                    <div class="card-body">
                        <div class="border p-3 rounded">
                            <form class="row g-3" action="{{route('update.footer')}}" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-5"><label class="form-label ml-5"><strong>Heading</strong></label></div>
                                    <div class="col-md-5"><label class="form-label ml-5"><strong>Url</strong></label></div>
                                    <div class="col-md-2"><label class="form-label ml-5"><strong>Status</strong></label></div>
                                </div>
                                @csrf
                                @foreach($footer as $data)
                                <div class="row mt-3">
                                    <div class="col-md-4">
                                        <input type="text" name="heading[]" value="{{$data->heading}}" class="form-control" placeholder="content title" required>
                                        <input type="hidden" name="id[]" value="{{$data->id}}" class="form-control" required>
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" name="url[]" value="{{$data->url}}" class="form-control" placeholder="content title" required>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status{{$data->id}}" id="flexRadioDefault{{$data->id}}" value="1" @if($data->status == 1) checked @endif>
                                            <label class="form-check-label" for="flexRadioDefault{{$data->id}}">
                                                Enabled
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status{{$data->id}}" id="flexRadioDefaultt{{$data->id}}" value="0"  @if($data->status == 0) checked @endif>
                                            <label class="form-check-label" for="flexRadioDefaultt{{$data->id}}">
                                                Disabled
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                <div class="col-12">
                                    <button class="btn btn-primary px-4">Update</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end row-->

    </main>
    <!--end page main-->

@endsection
