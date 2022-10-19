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
            <div class="breadcrumb-title pe-3"><a href="{{route('adminHome')}}"><i class="bx bx-home-alt"></i></a> </div>
            <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item">eCommerce </li>
                <li class="breadcrumb-item active" aria-current="page">Content</li>
                </ol>
            </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-header py-3">
                <h6 class="mb-0">Add Content</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-lg-4 d-flex">
                        <div class="card border shadow-none w-100">
                            <div class="card-body">
                                <form class="row g-3" action="{{route('submit_context')}}" method="post" enctype="multipart/form-data">

                                    @csrf
                                    <div class="col-12">
                                        <label class="form-label">Title</label>
                                        <input type="text" name = "name" class="form-control" placeholder="Content title" required>
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Description</label>
                                        <input type="text" name = "description" class="form-control" placeholder="Enter description" required>
                                    </div>

                                    <div class="col-12 mb-3 d-none">
                                        <label class="form-label">Parent</label>
                                        <select class="form-select" name='parent_id' required>
                                            <option disabled>-Select Parent-</option>
                                            <option value="0" selected>Root</option>
                                            @foreach($allContext as $key => $context)
                                                <option value="{{$context->id}}" >{{$context->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <label class="form-label">Type</label>
                                        <select class="form-select type" name="type" id="type"   required>
                                            <option value="manual" selected>Manual</option>
                                            <option value="guide">Guide</option>
                                            <option value="video">Video</option>
                                            <option value="page">Page</option>
                                            <option value="link">Link</option>
                                            <option value="file">File</option>
                                        </select>
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Link</label>
                                        <input type="text" name = "link" class="form-control" placeholder="Enter link">
                                    </div>

                                    <div class="col-12">
                                        <input type="file" name = "icon" class="form-control" >
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Or</label>
                                        <a class="btn btn-success allImg" data-bs-target="#exampleModal">Browse From Image Library</a>
                                        <div class="modal fade file_expoloer"  id="exampleModal">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Image Library</h5>
                                                        <input type="text" name="filter" placeholder="Search File" class="form-control searchData" onkeyup="searchFile()" style="max-width: 30%;">
                                                        <button type="button" class="closeModel" data-bs-dismiss="modal"><i class="fa fa-times"></i></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row_gallery"></div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary closeModel" data-bs-dismiss="modal">Cancel</button>
                                                        <button type="button" class="btn btn-primary saveModel" data-bs-dismiss="modal">Save</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="newInput"></div>
                                    </div>

                                    <div class="col-12 col-md-12 static-guide getGuide d-none">
                                        <label class="form-label">Select Static Page</label>
                                        <select class="form-select type" name="page_id" id="guideType" ></select>
                                    </div>


                                    <div class="col-12 mb-3 d-none">
                                        <label class="form-label">Areas</label>
                                        <select class="multiple-select" name='areas[]' data-placeholder="Choose anything" multiple="multiple">
                                        <option disabled>-Select Area-</option>
                                        @foreach($areas as $key => $category)
                                        <option value="{{$category->id}}" >{{$category->name}}</option>
                                        @endforeach
                                        </select>
                                    </div>

                                    <div class="col-12 mb-3 d-none">
                                        <label class="form-label">Product Categories</label>
                                        <select class="multiple-select" name='categories[]' data-placeholder="Choose anything" multiple="multiple">
                                            <option disabled>-Select Category-</option>
                                            @foreach($categories as $key => $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-12 mb-3 d-none">
                                        <label class="form-label">Search Categories</label>
                                        <select class="multiple-select" name='searchCategories[]' data-placeholder="Choose anything" multiple="multiple">
                                            <option disabled>-Select Categories-</option>
                                            @foreach($searchCategories as $key => $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-12">
                                        <div class="d-grid">
                                            <button class="btn btn-primary">Add Content</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-8 d-flex">
                    <div class="card border shadow-none w-100">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table align-middle ecommerce-products-categories"  width="100%" id="example">
                            @if(sizeof($contexts) > 0)
                                <thead class="table-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Type</th>
                                        <th>File/Type</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            @else
                                <thead class="table-light">
                                    <tr>
                                        <th>No Content to show</th>
                                    </tr>
                                </thead>
                            @endif

                            <tbody>
                                @if(sizeof($contexts) > 0)
                                    @foreach($contexts as $key => $category)
                                        <tr>
                                            <!-- <td><input class="form-check-input" type="checkbox"></td> -->
                                            <td>#{{$category->id}}</td>
                                            <td>{{ucfirst($category->name)}}</td>
                                            <td>{{ucfirst($category->type)}}</td>
                                            <td>
                                                @if($category->type == 'page' || $category->type == 'link')
                                                    <div class="link-down"><a href="{{ $category->link }}" target="_blank" style="font-size: 24px;color: #004f83;"><i class="bx bx-link"></i></a></div>
                                                @else
                                                    <div class="link-down"><a href="{{ asset($category->file_url)}}" download style="font-size: 24px;color: #004f83;"><i class="bx bxs-file-pdf"></i></a></div>
                                                @endif
                                            </td>
                                            <!-- <td><img src="{{ asset( imageCheck($category->image)) }}" width="100" height="100"></td> -->
                                            <td>
                                                <div class="d-flex align-items-center gap-3 fs-6">
                                                    <a href="{{route('edit_context', $category->id)}}"
                                                     class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Edit {{$category->name}}" aria-label="Edit">
                                                    <img src="{{asset('admin-assets/images/edit.png')}}" alt="">
                                                    </a>

                                                    <a href="#delModal{{$category->id}}" data-toggle="modal" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Delete {{$category->name}}" aria-label="Delete">
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
                                                        <button type="button" class="btn btn-danger" onclick=" window.location.href='{{route('delete_context', $category->id)}}'">Delete</button>
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
                                {{ $contexts->links('pagination::bootstrap-4') }}
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
    <script>
        function getGuide()
        {
            var pageType  = $('.type').val();
            $('.getGuide').addClass('d-none');
            $('#guideType').empty();
            if (pageType == "page" || pageType=="guide"){
                $.ajax({
                    type: "POST",
                    url: "<?= url('admin/getGuidePage')?>",
                    data: "type=" + pageType + '&_token={{ csrf_token() }}',
                    success: function (data) {
                       // console.log(data)
                      $('.getGuide').removeClass('d-none');
                        data.forEach(function (item) {
                            $('#guideType').append('<option value="'+item.id+'">'+item.name+'</option>')
                        })
                    }

                })
            }
        }
    </script>
@endsection
@section('js')
    <script>
        function searchFile()
        {
            var value = $('.searchData').val();
            $.ajax({
                type: "post",
                url: "{{url('admin/fileSearch')}}",
                data: "name="+value+'&_token={{ csrf_token() }}',
                success: function (data) {
                    $('.row_gallery').empty();
                    $.each(data, function(index, result) {
                        if(result.mime_type == 'image/png' || result.mime_type == 'image/jpg' || result.mime_type == 'image/jpeg' || result.mime_type == 'image/gif'){
                            var url = "{{ asset('pagebuilder/uploads/')}}"+'/'+result.server_file;
                            $('.row_gallery').append('<div class="imgs" id="'+result.id+'" data-id="'+result.server_file+'" data-alt="'+result.alt_image+'" data-title="'+result.title_image+'"><img src="'+url+'" alt="'+result.original_file+'"  data-bs-toggle="tooltip" data-bs-placement="top" title="'+result.original_file+'" >');
                        }
                        if(result.mime_type == 'image/mp4' || result.mime_type == 'image/mpegURL' ||result.mime_type == 'image/mov' || result.mime_type == 'image/ogg' || result.mime_type == 'image/wmv'){
                            var url = "{{ asset('media/video.png')}}";
                            $('.row_gallery').append('<div class="imgs" id="'+result.id+'" data-id="'+result.server_file+'" data-alt="'+result.alt_image+'" data-title="'+result.title_image+'"><img src="'+url+'" alt="'+result.original_file+'"  data-bs-toggle="tooltip" data-bs-placement="top" title="'+result.original_file+'" >');
                        }
                        if(result.mime_type == 'image/pdf'){
                            var url = "{{ asset('media/pdf.png')}}";
                            $('.row_gallery').append('<div class="imgs" id="'+result.id+'" data-id="'+result.server_file+'" data-alt="'+result.alt_image+'" data-title="'+result.title_image+'"><img src="'+url+'" alt="'+result.original_file+'"  data-bs-toggle="tooltip" data-bs-placement="top" title="'+result.original_file+'" >');
                        }
                    })
                    imgSelect();
                    $('.imgs img').tooltip();
                }

            })

        }

        const imgSelect=()=>{
            $('.imgs').click(function (){
                if ( $(this).hasClass("active") ) {
                    $(this).removeClass('active');
                    $('#image'+$(this).attr('id')).remove();
                    $('#alt'+$(this).attr('id')).remove();
                    $('#title'+$(this).attr('id')).remove();
                }else{
                    $('.imgs').removeClass('active');
                    $('#newInput').empty();
                    $(this).addClass('active');
                    $('#newInput').append('<input type="hidden" name="productImages[]" id="image'+$(this).attr('id')+'" value="pagebuilder/uploads/'+$(this).attr('data-id')+'">' +
                        '<input type="hidden" name="altImages[]" id="alt'+$(this).attr('id')+'" value="'+$(this).attr('data-alt')+'">'+
                        '<input type="hidden" name="titleImages[]" id="title'+$(this).attr('id')+'" value="'+$(this).attr('data-title')+'">');
                }
            });
        }
        const getAllImage=()=> {
            $('.allImg').click(function () {
                $('#exampleModal').toggle('modal').addClass('show');
                $("#exampleModal").trigger('click')
                // $('#exampleModal').modal('show');
                $.ajax({
                    type: "post",
                    url: "{{url('admin/fileSearch')}}",
                    data: '_token={{ csrf_token() }}',
                    success: function (data) {
                        $('.row_gallery').empty();
                        $.each(data, function(index, result) {
                            if(result.mime_type == 'image/png' || result.mime_type == 'image/jpg' || result.mime_type == 'image/jpeg' || result.mime_type == 'image/gif'){
                                var url = "{{ asset('pagebuilder/uploads/')}}"+'/'+result.server_file;
                                $('.row_gallery').append('<div class="imgs" id="'+result.id+'" data-id="'+result.server_file+'" data-alt="'+result.alt_image+'" data-title="'+result.title_image+'" ><img src="'+url+'" alt="'+result.original_file+'"  data-bs-toggle="tooltip" data-bs-placement="top" title="'+result.original_file+'" >');
                            }
                            if(result.mime_type == 'image/mp4' || result.mime_type == 'image/mpegURL' ||result.mime_type == 'image/mov' || result.mime_type == 'image/ogg' || result.mime_type == 'image/wmv'){
                                var url = "{{ asset('media/video.png')}}";
                                $('.row_gallery').append('<div class="imgs" id="'+result.id+'" data-id="'+result.server_file+'" data-alt="'+result.alt_image+'" data-title="'+result.title_image+'"><img src="'+url+'" alt="'+result.original_file+'"  data-bs-toggle="tooltip" data-bs-placement="top" title="'+result.original_file+'" >');
                            }
                            if(result.mime_type == 'image/pdf'){
                                var url = "{{ asset('media/pdf.png')}}";
                                $('.row_gallery').append('<div class="imgs" id="'+result.id+'" data-id="'+result.server_file+'" data-alt="'+result.alt_image+'" data-title="'+result.title_image+'"><img src="'+url+'" alt="'+result.original_file+'"  data-bs-toggle="tooltip" data-bs-placement="top" title="'+result.original_file+'" >');
                            }
                        })
                        imgSelect();
                        $('.imgs img').tooltip();
                    }
                })

            })
        }
    </script>

    <script>
        $(document).ready(function() {
            imgSelect();
            getAllImage();
            $("#exampleModal").click(function() {
                $("#exampleModal").modal("show");
            });
            $("#exampleModal").modal({
                show: true,
                backdrop: 'static'
            });


            var table = $('#example').DataTable( {
                responsive: true,
            } );

            new $.fn.dataTable.FixedHeader( table );
        } );
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
@endsection
