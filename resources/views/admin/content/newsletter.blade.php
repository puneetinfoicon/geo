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
                        <li class="breadcrumb-item active" aria-current="page">Manage News letters</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card">
                    <div class="card-header py-3 bg-transparent">
                        <h5 class="mb-0">News Letters</h5>
                    </div>
                    <div class="card-body">
                        <div class="border p-3 rounded">
                            <form class="row g-3" action="{{route('update_newsletter')}}" method="post" enctype="multipart/form-data">
                                @csrf

                                <div class="row mt-3">
                                    <div class="col-md-12 mb-10">
                                        <label for="news_heading"><b>Newsletter Heading</b></label>
                                        <textarea name="news_heading" rows="5" class="form-control" id="news_heading" placeholder="">{{$news->news_heading}}</textarea>
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <label for="landburg_heading"><b> landburg Text</b></label>
                                        <input type="text" class="form-control" id="landburg_heading" name="landburg_heading" value="{{$news->landburg_heading}}">
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <label for="landmailing_heading"><b> Landmåling Text</b></label>
                                        <input type="text" class="form-control" id="landmailing_heading" name="landmailing_heading" value="{{$news->landmailing_heading}}">
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <label for="policy_link"><b> Privacy Policy Link</b></label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon3">{{url('/')}}</span>
                                            <input type="text" name="policy_link" class="form-control" id="policy_link-url" aria-describedby="basic-addon3" value="{{$news->policy_link}}">
                                        </div>
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
