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

                    <li class="breadcrumb-item"><a href="{{route('addTeam')}}">Teams</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Team</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-header py-3">
            <h6 class="mb-0">Edit Team</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-lg-4 d-flex">
                    <div class="card border shadow-none w-100">
                        <div class="card-body">
                            <form class="row g-3" action="{{route('updateTeam')}}" method="post" enctype="multipart/form-data">

                                @csrf
                                <input type="hidden" name="id" value = "{{$member->id}}">
                                <div class="col-12">
                                    <label class="form-label">Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="Name" value = "{{$member->name}}">
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Rank</label>
                                    <input type="number" name = "rank" class="form-control" placeholder="Rank" value = "{{$member->rank}}">
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Image</label>
                                    <input type="file" name="icon" class="form-control">
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

                                <div class="col-12">
                                    <label class="form-label">Designation</label>
                                    <input type="text" name="designation" class="form-control" placeholder="Designation" value="{{$member->designation}}" >
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Contact</label>
                                    <input type="text" name="contact" class="form-control" placeholder="Contact" value="{{$member->contact}}">
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="Email" value="{{$member->email}}">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Business Area</label>
                                    <select name="business_area" class="form-control" required>
                                        <option value="">Select Business Area</option>
                                        <option value="Administration" @if($member->business_area == "Administration") selected @endif>Administration</option>
                                        <option value="Landmåling" @if($member->business_area == "Landmåling") selected @endif>Landmåling</option>
                                        <option value="Landbrug" @if($member->business_area == "Landbrug") selected @endif>Landbrug</option>
                                        <option value="GPSnet.dk" @if($member->business_area == "GPSnet.dk") selected @endif>GPSnet.dk</option>
                                    </select>
                                </div>

                                <div class="col-12">
                                    <div class="d-grid">
                                        <button class="btn btn-primary">Update Member</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--end row-->
        </div>
    </div>

</main>
<!--end page main-->
@endsection

@section('js')
    <script>
        $(document).ready(function (){
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
        })

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

    @endsection
