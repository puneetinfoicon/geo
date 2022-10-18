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
             <div class="card">
            <div class="card-header py-3">
                <h4>Pages</h4>
            </div>
            <div class="card-header" style="text-align: right">
                <a href='{{url("admin/add")}}' class="btn btn-primary">
                    Add New Page
                </a>
            </div>
                 <div class="card-body">
                <div class="row">
                    @if(Session::has('message'))
                        <div class="alert alert-success">{{Session::get('message')}}</div>
                    @endif
                </div>
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered nowrap" width="100%" id="example">
                            <thead>
                            <tr>
                                <th scope="col">Sl.No.</th>
                                <th scope="col">Name</th>
                                <th scope="col">Page title</th>
                                <th scope="col">Url</th>
                                <th>Status</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $x= 1; @endphp
                            @foreach ($list as $key => $value)
                                <tr>
                                    <td class="dtr-control sorting_1 pos-rel" tabindex="0">{{ $x++ }}.</td>
                                    <td>{{ $value->name }}</td>
                                    <td>{{ $value->title }}</td>
                                    <td>{{ $value->route }}</td>
                                    <td><span class="badge rounded-pill alert-success">{{($value->status == 1)?'Active': 'Inactive'}}</span></td>

                                    <td class="actions">
                                        <a href='{{url("$value->route")}}' target="_blank" class="btn btn-light btn-sm">
                                            <span>View</span> <i class="fas fa-eye"></i>
                                        </a>
                                        <a href='{{url("admin/pages/build?page=$value->page_id")}}' class="btn btn-primary btn-sm">
                                            <span>Edit</span> <i class="fas fa-edit"></i>
                                        </a>
                                        <a href='{{url("admin/add?id=$value->page_id")}}' class="btn btn-info btn-sm">
                                            <span>Setting</span> <i class="fas fa-cog"></i>
                                        </a>
                                        <a href='{{url("admin/pages/copy/$value->page_id")}}' class="btn btn-success btn-sm">
                                            <span>Duplicate </span> <i class="fas fa-clone"></i>
                                        </a>
                                        <a href="#delModal{{$value->page_id}}" class="btn btn-danger btn-sm" data-toggle="modal">
                                            <span>Delete</span> <i class="fas fa-trash"></i>
                                        </a>
{{--                                        <a href='{{url("admin/delete_page/$value->page_id")}}' class="btn btn-danger btn-sm">--}}
{{--                                            <span>Delete</span> <i class="fas fa-trash"></i>--}}
{{--                                        </a>--}}
                                    </td>
                                </tr>
                                <!-- Modal HTML -->
                                <div id="delModal{{$value->page_id}}" class="modal fade ">
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
                                                <button type="button" class="btn btn-danger" onclick=" window.location.href='{{url("admin/delete_page/$value->page_id")}}'">Delete</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

    </main>
    <!--end page main-->
@endsection
@section('js')
    <script src="<?= phpb_asset('websitemanager/app.js') ?>"></script>
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
