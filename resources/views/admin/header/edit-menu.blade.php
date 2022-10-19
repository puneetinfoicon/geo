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
                        <li class="breadcrumb-item">Content </li>
                        <li class="breadcrumb-item"><a href="{{route('dynamic.header')}}">Dynamic Header</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{$details->name}}</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-header py-3">
                <h6 class="mb-0">Edit Menu</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-lg-4 d-flex">
                        <div class="card border shadow-none w-100">
                            <div class="card-body">
                                <form class="row g-3" action="{{route('update_menus',$details->id)}}" method="post" enctype="multipart/form-data">

                                    @csrf
                                    <div class="col-12">
                                        <label class="form-label">Name</label>
                                        <input type="text" name = "name" class="form-control" value="{{urldecode($details->name)}}" placeholder="Menu name" required>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Url</label>
                                        <input type="text" name = "url" class="form-control" value="{{urldecode($details->url)}}" placeholder="/example" required>
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Status</label>
                                        <select name="status" class="form-control" required>
                                            <option value="">Select Status</option>
                                            <option value="1" @if($details->status ==1) selected @endif>Active</option>
                                            <option value="0" @if($details->status ==0) selected @endif>Inactive</option>
                                        </select>
                                    </div>

                                    <div class="col-12">
                                        <div class="d-grid">
                                            <button class="btn btn-primary">Update Menu</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                 </div><!--end row-->
            </div>
        </div>

    </main>
    <!--end page main-->
@endsection
