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
                        <li class="breadcrumb-item active" aria-current="page">Edit Login & Register</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card">
                    <div class="card-header py-3 bg-transparent">
                        <h5 class="mb-0">Edit Login & Register Page</h5>
                    </div>
                    <div class="card-body">
                        <div class="border p-3 rounded">

                            <form class="row g-3" action="{{route('update_login_reg')}}" method="post" enctype="multipart/form-data">
                                @csrf
                               @isset($details[0])
                                    <div class="row mt-3">
                                        <div class="col-md-12">
                                            <label for="{{$details[0]->name}}"><b>{{ucwords(str_replace('_',' ',$details[0]->name))}} Content</b></label>
                                            <textarea name="{{$details[0]->name}}" rows="3" class="form-control" placeholder="{{$details[0]->name}} Content">{{$details[0]->data}}</textarea>
                                        </div>

                                    </div>
                               @endisset

                               @isset($details[1])
                                    <div class="row mt-3">
                                        <div class="col-md-12">
                                            <label for="{{$details[1]->name}}"><b>{{ucwords(str_replace('_',' ',$details[1]->name))}} Content</b></label>
                                            <textarea name="{{$details[1]->name}}" rows="3" class="form-control" placeholder="{{$details[1]->name}} Content">{{$details[1]->data}}</textarea>
                                        </div>
                                    </div>
                               @endisset

                                @isset($details[3])
                                    <div class="col-md-12 mt-3">
                                        <label for="policy_link"><b> Signup footer link</b></label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon3"><?= url('')?></span>
                                            <input type="text" name="{{$details[3]->name}}" class="form-control"  aria-describedby="basic-addon3" value="{{$details[3]->data}}">
                                        </div>
                                    </div>
                                @endisset

                               @isset($details[2])
                                    <div class="row mt-3">
                                        <div class="col-md-12">
                                            <label for="{{$details[2]->name}}"><b>{{ucwords(str_replace('_',' ',$details[2]->name))}} Content</b></label>
                                            <textarea name="{{$details[2]->name}}" rows="3" class="form-control" placeholder="{{$details[2]->name}} Content">{{$details[2]->data}}</textarea>
                                        </div>
                                    </div>
                               @endisset

                               @isset($details[4])
                                    <div class="col-md-12 mt-3">
                                        <label for="policy_link"><b> Signup footer content link</b></label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon3"><?= url('')?></span>
                                            <input type="text" name="{{$details[4]->name}}" class="form-control"  aria-describedby="basic-addon3" value="{{$details[4]->data}}">
                                        </div>
                                    </div>
                               @endisset
                               @isset($forgot[0])
                                    <div class="row mt-3">
                                        <div class="col-md-12">
                                            <label for="{{$forgot[0]->name}}"><b>{{ucwords(str_replace('_',' ',$forgot[0]->name))}} </b></label>
                                            <textarea name="{{$forgot[0]->name}}" rows="3" class="form-control" placeholder="{{$forgot[0]->name}} Content">{{$forgot[0]->data}}</textarea>
                                        </div>
                                    </div>
                               @endisset

                               @isset($forgot[1])
                                    <div class="col-md-12 mt-3">
                                        <label for="policy_link"><b> Forgot Password link</b></label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon3"><?= url('')?></span>
                                            <input type="text" name="{{$forgot[1]->name}}" class="form-control"  aria-describedby="basic-addon3" value="{{$forgot[1]->data}}">
                                        </div>
                                    </div>
                               @endisset
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
