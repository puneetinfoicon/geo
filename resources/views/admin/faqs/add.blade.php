@extends('admin.layout.master')
@section('title', 'Add Page')
@section('content')
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <style>
        table.dataTable.dtr-inline.collapsed>tbody>tr>td.dtr-control:before, table.dataTable.dtr-inline.collapsed>tbody>tr>th.dtr-control:before {
            top: 50%;
            left: 5px;
            height: 1em;
            width: 1em;
            margin-top: -9px;
            display: block;
            position: absolute;
            color: white;
            border: 0.15em solid white;
            border-radius: 1em;
            box-shadow: 0 0 0.2em #444;
            box-sizing: content-box;
            text-align: center;
            text-indent: 0 !important;
            font-family: "Courier New",Courier,monospace;
            line-height: 1em;
            content: "+";
            background-color: #337ab7;
        }
        td{
            vertical-align: middle;
        }
        table.table-bordered.dataTable th, table.table-bordered.dataTable td {
            border-left-width: 0;
            position: relative;
        }
        td.dtr-control.pos-rel.sorting_1 {
            position: relative;
            padding-left: 30px;
        }









        .modal-confirm {
            color: #636363;
            width: 400px;
        }
        .modal-confirm .modal-content {
            padding: 20px;
            border-radius: 5px;
            border: none;
            text-align: center;
            font-size: 14px;
        }
        .modal-confirm .modal-header {
            border-bottom: none;
            position: relative;
        }
        .modal-confirm h4 {
            text-align: center;
            font-size: 26px;
            margin: 30px 0 -10px;
        }
        .modal-confirm .close {
            position: absolute;
            top: -5px;
            right: -2px;
        }
        .modal-confirm .modal-body {
            color: #999;
        }
        .modal-confirm .modal-footer {
            border: none;
            text-align: center;
            border-radius: 5px;
            font-size: 13px;
            padding: 10px 15px 25px;
        }
        .modal-confirm .modal-footer a {
            color: #999;
        }
        .modal-confirm .icon-box {
            width: 80px;
            height: 80px;
            margin: 0 auto;
            border-radius: 50%;
            z-index: 9;
            text-align: center;
            border: 3px solid #f15e5e;
        }
        .modal-confirm .icon-box i {
            color: #f15e5e;
            font-size: 46px;
            display: inline-block;
            margin-top: 13px;
        }
        .modal-confirm .btn, .modal-confirm .btn:active {
            color: #fff;
            border-radius: 4px;
            background: #60c7c1;
            text-decoration: none;
            transition: all 0.4s;
            line-height: normal;
            min-width: 120px;
            border: none;
            min-height: 40px;
            border-radius: 3px;
            margin: 0 5px;
        }
        .modal-confirm .btn-secondary {
            background: #c1c1c1;
        }
        .modal-confirm .btn-secondary:hover, .modal-confirm .btn-secondary:focus {
            background: #a8a8a8;
        }
        .modal-confirm .btn-danger {
            background: #f15e5e;
        }
        .modal-confirm .btn-danger:hover, .modal-confirm .btn-danger:focus {
            background: #ee3535;
        }
        .trigger-btn {
            display: inline-block;
            margin: 100px auto;
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
                <li class="breadcrumb-item active" aria-current="page">FAQs</li>
                </ol>
            </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-header py-3">
                <h6 class="mb-0">Add FAQs</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-lg-6 d-flex">
                        <div class="card border shadow-none w-100">
                            <div class="card-body">
                                <form class="row g-3" action="{{route('submitFaqs')}}" method="post" enctype="multipart/form-data">

                                    @csrf

                                    <div class="col-12">
                                        <label class="form-label">Question</label>
                                        <textarea id="editor0" class="form-control summernote" name="question" placeholder="" rows="4" cols="4" required></textarea>
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Answer</label>
                                        <textarea id="editor1" class="form-control summernote" name="answer" placeholder="" rows="4" cols="4" required></textarea>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label class="form-label">Areas</label>
                                        <select class="multiple-select" name='areas[]' data-placeholder="Choose anything" multiple="multiple" required>
                                        <option disabled>-Select Area-</option>
                                        @foreach($areas as $key => $category)
                                        <option value="{{$category->id}}" {{ (in_array($category->id, $productAreas)) ? 'selected': '' }}>{{$category->name}}</option>
                                        @endforeach
                                        </select>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" name="status" type="checkbox" value="1" id="flexCheckDefault2" checked>
                                        <label class="form-check-label" for="flexCheckDefault2">Status</label>
                                    </div>

                                    <div class="col-12">
                                        <div class="d-grid">
                                            <button class="btn btn-primary">Add</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 d-flex">
                    <div class="card border shadow-none w-100">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table align-middle ecommerce-products-categories" width="100%" >
                            @if(sizeof($categories) > 0)
                                <thead class="table-light">
                                    <tr>
                                        <!-- <th><input class="form-check-input" type="checkbox"></th> -->
                                        <th>Sno</th>
                                        <th>Question</th>
                                        <th>Status</th>
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
                                    @php
                                        $count++;
                                    @endphp
                                        <tr>
                                            <!-- <td><input class="form-check-input" type="checkbox"></td> -->
                                            <!-- <td>#{{$category->rank}}</td> -->
                                            <td>{{ $count }}</td>
                                            <td>{!! $category->question !!}</td>
                                            <td><span class="badge rounded-pill alert-success">{{($category->status == 1)?'Active': 'Inactive'}}</span></td>
                                            <td>
                                                <div class="d-flex align-items-center gap-3 fs-6">

                                                    <a href="{{route('editFaq', $category->id)}}" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Edit" aria-label="Edit">
                                                        <img src="{{asset('admin-assets/images/edit.png')}}" alt="">
                                                    </a>
                                                    <a href="#delModal{{$category->id}}" data-toggle="modal" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Delete" aria-label="Delete">
                                                        <img src="{{asset('admin-assets/images/delete.png')}}" alt="">
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    <!-- Modal HTML -->
                                    <div id="delModal{{$category->id}}" class="modal fade ">
                                        <div class="modal-dialog modal-confirm">
                                            <div class="modal-content">
                                                <div class="modal-header flex-column">
                                                    <div class="icon-box">
                                                        <i class="material-icons">&#xE5CD;</i>
                                                    </div>
                                                    <h4 class="modal-title w-100">Are you sure?</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Do you really want to delete this record? </p>
                                                </div>
                                                <div class="modal-footer justify-content-center">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                    <button type="button" class="btn btn-danger" onclick=" window.location.href='{{route('deleteFaq', $category->id)}}'">Delete</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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

@section('js')

    <script src="{{asset('ckeditor/ckeditor.js')}}"></script>
    <script>

        //initSample();
        CKEDITOR.replace( 'editor0', {
            // customConfig: '/custom/ckeditor_config.js'
            height: 200
        });
        CKEDITOR.replace( 'editor1', {
            //customConfig: '/custom/ckeditor_config.js'
            height: 200
        });
    </script>
    <script>
        $(document).ready(function() {
            var table = $('#example').DataTable( {
                responsive: true,
            } );

            new $.fn.dataTable.FixedHeader( table );
        } );
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
@endsection
