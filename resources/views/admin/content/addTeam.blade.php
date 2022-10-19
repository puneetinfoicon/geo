@extends('admin.layout.master')
@section('title', 'Add Page')
@section('content')
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <style>
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
                <li class="breadcrumb-item">Team</li>
                <li class="breadcrumb-item active" aria-current="page">Add Team</li>
                </ol>
            </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-header py-3">
                <h6 class="mb-0">Add Team</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-lg-4 d-flex">
                        <div class="card border shadow-none w-100">
                            <div class="card-body">
                                <form class="row g-3" action="{{route('postTeam')}}" method="post" enctype="multipart/form-data">

                                    @csrf
                                    <div class="col-12">
                                        <label class="form-label">Name</label>
                                        <input type="text" name = "name" class="form-control" placeholder="Name">
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Rank</label>
                                        <input type="number" name = "rank" class="form-control" placeholder="Rank">
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Image</label>
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

                                    <div class="col-12">
                                        <label class="form-label">Designation</label>
                                        <input type="text" name = "designation" class="form-control" placeholder="Designation">
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Contact</label>
                                        <input type="text" name = "contact" class="form-control" placeholder="Contact">
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Email</label>
                                        <input type="email" name = "email" class="form-control" placeholder="Email">
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Business Area</label>
                                        <select name="business_area" class="form-control" required>
                                            <option value="">Select Business Area</option>
                                            <option value="Administration">Administration</option>
                                            <option value="Landmåling">Landmåling</option>
                                            <option value="Landbrug">Landbrug</option>
                                            <option value="GPSnet.dk">GPSnet.dk</option>
                                        </select>
                                    </div>

                                    <div class="col-12">
                                        <div class="d-grid">
                                            <button class="btn btn-primary">Add Member</button>
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
                            <table class="table align-middle ecommerce-products-categories" width="100%" id="example">
                            @if(sizeof($teams) > 0)
                                <thead class="table-light">
                                    <tr>
                                        <!-- <th><input class="form-check-input" type="checkbox"></th> -->
                                        <th>Rank</th>
                                        <th>Name</th>
                                        <th>Image</th>
                                        <th>Designation</th>
                                        <th>Contact</th>
                                        <th>Email</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            @else
                                <thead class="table-light">
                                    <tr>
                                        <th>No Members to show</th>
                                    </tr>
                                </thead>
                            @endif

                            <tbody>
                                @if(sizeof($teams) > 0)
                                    @foreach($teams as $key => $team)
                                        <tr>
                                            <!-- <td><input class="form-check-input" type="checkbox"></td> -->
                                            <td>#{{$team->rank}}</td>
                                            <td>{{$team->name}}</td>
                                            <td><img src="{{ asset( imageCheck($team->image)) }}" width="100" height="100"></td>
                                            <td>{{$team->designation}}</td>
                                            <td>{{$team->contact}}</td>
                                            <td>{{$team->email}}</td>

                                            <td>
                                                <div class="d-flex align-items-center gap-3 fs-6">

                                                    <a href="{{route('editTeam', $team->id)}}"
                                                     class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Edit {{$team->name}}" aria-label="Edit">
                                                    <img src="{{asset('admin-assets/images/edit.png')}}" alt="">
                                                    </a>

                                                    <a href="#delModal{{$team->id}}" data-toggle="modal" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Delete {{$team->name}}" aria-label="Delete">
                                                        <img src="{{asset('admin-assets/images/delete.png')}}" alt="">
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- Modal HTML -->
                                        <div id="delModal{{$team->id}}" class="modal fade ">
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
                                                        <button type="button" class="btn btn-danger" onclick=" window.location.href='{{route('deleteTeam', $team->id)}}'">Delete</button>
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
                               {{-- {{ $teams->links('pagination::bootstrap-4') }}--}}
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
    <script>
        $(document).ready(function() {
            var table = $('#example').DataTable( {
                responsive: true,
            } );

            new $.fn.dataTable.FixedHeader( table );

            imgSelect();
            getAllImage();



            $("#exampleModal").click(function() {
                $("#exampleModal").modal("show");

               // $('body').append('<div class="modal-backdrop fade show"></div>');
            });
            $("#exampleModal").modal({
                show: true,
                backdrop: 'static'
            });

        } );
    </script>
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

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
@endsection
