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
                <li class="breadcrumb-item" aria-current="page"><a href="{{route('subProdukter', $subProdukter->produkter_id)}}">Produkt under-menu</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Produkt under-menu</li>
                </ol>
            </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-header py-3">
                <h6 class="mb-0">Edit Produkter</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-lg-4 d-flex">
                        <div class="card border shadow-none w-100">
                            <div class="card-body">
                                <form class="row g-3" action="{{route('postSubProdukter')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-12">
                                        <label class="form-label">Name</label>
                                        <input type="text" name = "name" class="form-control" placeholder="Area name" value = "{{$subProdukter->name}}">
                                        <input type="hidden" name = "id" value = "{{$subProdukter->id}}">
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Link</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon3">{{str_replace(request()->path(), "", url()->current())}}</span>
                                        </div>
                                        <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" name="link" value="{{$subProdukter->url}}">
                                    </div>

                                    <div class="col-12">
                                        <div class="d-grid">
                                            <button class="btn btn-primary">Update</button>
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
