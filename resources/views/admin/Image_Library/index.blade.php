@extends('admin.layout.master')
@section('title', 'Add Page')
@section('content')
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <style>
        td a{
            margin: 5px;
        }
        /****** Model Box CSS *******/
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
        .productlist div img {
            height: 100px;
            width: 140px;
        }
        .lineHeight{
            line-height:100px;
        }
    </style>
    <!--start content-->
    <main class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb mb-3 d-flex justify-content-between">
            <div class=" d-none d-sm-flex align-items-center">
                <div class="breadcrumb-title pe-3"><a href="{{route('adminHome')}}"><i class="bx bx-home-alt"></i></a></div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item active">Image Library</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="right-btn"><a  data-toggle="modal" data-target="#exampleModalCenter" class="btn btn-primary">Add New File</a></div>
        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered nowrap" width="100%" id="example">
                        <thead class="table-light">
                        <tr>
                            <th>FIle</th>
                            <th>File Type</th>
                            <th>File Name</th>
                            <th>File Title</th>
                            <th>File Alt</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(sizeof($images) > 0)
                            @foreach($images as $image)
                                @php
                                    $expload = explode('.',$image->original_file);
                                    $exploade = end($expload);
                                @endphp
                                <tr>
                                    <td class="productlist">
                                        <div>
                                            @if($exploade == 'png' || $exploade == 'jpg' || $exploade == 'jpeg' || $exploade == 'gif')
                                                <img src="{{ asset('pagebuilder/uploads/'.$image->server_file)}}" alt="{{$image->original_file}}">
                                            @elseif($exploade == 'mp4' || $exploade == 'mpegURL' ||$exploade == 'mov' || $exploade == 'ogg' || $exploade == 'wmv')
                                                <img src="{{ asset('media/video.png')}}" alt="{{$image->original_file}}">
                                            @elseif($exploade == 'pdf')
                                                <img src="{{ asset('media/pdf.png')}}" alt="{{$image->original_file}}">
                                            @endif
                                        </div>
                                    </td>

                                    <td class="productlist"><div><h6 class="mb-0 product-title"> {{ $exploade }}</h6></div></td>

                                    <td><h6 class="mb-0 product-title"> {{ $image->original_file }}</h6>
                                        <p id="{{$image->public_id}}" style="display: none"><?= asset('pagebuilder/uploads/'.$image->server_file)?></p>
                                    </td>
                                    <td>{{$image->title_image}}</td>
                                    <td>{{$image->alt_image}}</td>
                                    <td class="lineHeight">
                                        <button class="btn btn-outline-primary" title="Update file" data-toggle="modal" data-target="#exampleModalCenter{{$image->public_id}}"><i class="fa fa-edit"></i></button>
                                        <a class="btn btn-outline-secondary" title="Download file" href="{{ asset('pagebuilder/uploads/'.$image->server_file)}}" target="_blank"><i class="fa fa-file-download"></i></a>
                                        <button class="btn btn-outline-success" title="Copy file Url" onclick="copyToClipboard('#{{$image->public_id}}')"><i class="fa fa-clone"></i></button>
                                        <a href="{{route('deleteImageLib', $image->id)}}" class="btn btn-outline-danger" title="Delete file"><i class="fa fa-trash"></i></a>

                                    </td>
                                </tr>



                                <!-- Modal -->
                                <div class="modal fade" id="exampleModalCenter{{$image->public_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <form action="{{route('updateFiles')}}" enctype="multipart/form-data" method="post" autocomplete="off">
                                            @csrf
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalCenterTitle">Update File  </h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-12 mb-3">
                                                            <label class="form-label">Old File Name</label>
                                                            <input type="text" name="old" class="form-control" value="{{$image->original_file}}" readonly>
                                                            <input type="hidden" name="old_serverFile" class="form-control" value="{{$image->server_file}}" readonly>
                                                        </div>
                                                        <div class="col-12 mb-3">
                                                            <label class="form-label">Alt Name</label>
                                                            <input type="text" name="alt" class="form-control" value="{{$image->alt_image}}" >
                                                        </div>
                                                        <div class="col-12 mb-3">
                                                            <label class="form-label">Title Name</label>
                                                            <input type="text" name="title" class="form-control" value="{{$image->title_image}}" >
                                                        </div>
                                                        <div class="col-12 mb-3">
                                                            <label class="form-label">Select File</label>
                                                            <input type="file" name="images" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="javascript;" class="btn btn-secondary" data-dismiss="modal">Close</a>
                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </main>
    <!--end page main-->
    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form action="{{route('uploadNewFile')}}" enctype="multipart/form-data" method="post" autocomplete="off">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Upload A New File  </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label class="form-label">Select File</label>
                                <input type="file" name="images" class="form-control" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">Alt Name</label>
                                <input type="text" name="alt" class="form-control" value="" >
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">Title Name</label>
                                <input type="text" name="title" class="form-control" value="" >
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="javascript;" class="btn btn-secondary" data-dismiss="modal">Close</a>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
@section('js')
    <script>
        $(document).ready(function () {
            var table = $('#example').DataTable({
                responsive: true,
            });

            new $.fn.dataTable.FixedHeader(table);
        });
    </script>
    <script>
        function copyToClipboard(selector) {
            var $temp = $("<div>");
            $("body").append($temp);
            $temp.attr("contenteditable", true)
                .html($(selector).html()).select()
                .on("focus", function() { document.execCommand('selectAll',false,null); })
                .focus();
            document.execCommand("copy");
            $temp.remove();
        }
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
@endsection
