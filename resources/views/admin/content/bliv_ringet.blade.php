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
                        <li class="breadcrumb-item active" aria-current="page">Manage Bliv ringet op </li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card">
                    <div class="card-header py-3 bg-transparent">
                        <h5 class="mb-0"> Bliv ringet op </h5>
                    </div>
                    <div class="card-body">
                        <div class="border p-3 rounded">
                            <form class="row g-3" action="{{route('update_bliv_ringet_modal')}}" method="post" enctype="multipart/form-data" autocomplete="off">
                                @csrf
                                <div class="row mt-3">

                                    <div class="col-md-12 mb-10">
                                        <label for="{{$details[1]->name}}"><b>Texts</b></label>
                                        <textarea name="{{$details[1]->name}}" rows="5" class="form-control" id="{{$details[1]->name}}" placeholder="">{{$details[1]->data}}</textarea>
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <label for="{{$details[2]->name}}"><b> Button Name</b></label>
                                        <input type="text" class="form-control" id="{{$details[2]->name}}" name="{{$details[2]->name}}" value="{{$details[2]->data}}">
                                    </div>
                                </div>
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
