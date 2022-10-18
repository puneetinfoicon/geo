@extends('admin.layout.master')
@section('title', 'Add Page')
@section('content')

    <!--start content-->
    <main class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3"><a href="{{route('adminHome')}}"><i class="bx bx-home-alt"></i></a> </div>
            <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item">eCommerce</li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="{{route('context')}}">Content</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Content</li>
                </ol>
            </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-header py-3">
                <h6 class="mb-0">Edit Content</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-lg-4 d-flex">
                        <div class="card border shadow-none w-100">
                            <div class="card-body">
                                <form class="row g-3" action="{{route('update_context')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-12">
                                        <label class="form-label">Name</label>
                                        <input type="text" name = "name" class="form-control" placeholder="Category name" value = "{{$category->name}}">
                                        <input type="hidden" name = "id" value = "{{$category->id}}">
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Description</label>
                                        <input type="text" name = "description" class="form-control" placeholder="Enter description" value = "{{$category->description}}" required>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label class="form-label">Parent</label>
                                        <select class="form-select" name='parent_id' required>
                                            <option disabled>-Select Parent-</option>
                                            <option value="0" >Root</option>
                                            @foreach($allContext as $key => $context)
                                                <option value="{{$context->id}}" {{ ($category->parent_id == $context->id) ? 'selected': '' }}>{{$context->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <label class="form-label">Type</label>
                                        <select class="form-select type" name="type" id="type" required>
                                            <option value="manual" {{$category->type == 'manual' ? 'selected' : ''}} >Manual</option>
                                            <option value="guide" {{$category->type == 'guide' ? 'selected' : ''}} >Guide</option>
                                            <option value="video" {{$category->type == 'video' ? 'selected' : ''}} >Video</option>
                                            <option value="page" {{$category->type == 'page' ? 'selected' : ''}} >Page</option>
                                            <option value="link" {{$category->type == 'link' ? 'selected' : ''}} >Link</option>
                                            <option value="file" {{$category->type == 'file' ? 'selected' : ''}} >File</option>
                                        </select>
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Link</label>
                                        <input type="text" name = "link" class="form-control" placeholder="Enter link" value = "{{$category->link}}">
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Icon</label>
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

                                    <div class="col-12 col-md-12 d-none">
                                        <label class="form-label">Select Static Page</label>
                                        <select class="form-select type" name="page_id" id="type" >
                                            <option value="">Select Page Name</option>
                                            @foreach($pages as $page)
                                                <option value="{{$page->id}}">{{$page->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-12 mb-3 d-none">
                                        <label class="form-label">Areas</label>
                                        <select class="multiple-select" name='areas[]' data-placeholder="Choose anything" multiple="multiple">
                                        <option disabled>-Select Area-</option>
                                        @foreach($areas as $key => $category)
                                        <option value="{{$category->id}}" {{ (in_array($category->id, $productAreas)) ? 'selected': '' }}>{{$category->name}}</option>
                                        @endforeach
                                        </select>
                                    </div>

                                    <div class="col-12 mb-3 d-none">
                                        <label class="form-label">Product Categories</label>
                                        <select class="multiple-select" name='categories[]' data-placeholder="Choose anything" multiple="multiple" >
                                        <option disabled>-Select Category-</option>
                                        @foreach($categories as $key => $category)
                                        <option value="{{$category->id}}" {{ (in_array($category->id, $productCategories)) ? 'selected': '' }}>{{$category->name}}</option>
                                        @endforeach
                                        </select>
                                    </div>

                                    <div class="col-12 mb-3 d-none">
                                        <label class="form-label">Search Categories</label>
                                        <select class="multiple-select" name='searchCategories[]' data-placeholder="Choose anything" multiple="multiple" >
                                        <option disabled>-Select Categories-</option>
                                        @foreach($searchCategories as $key => $category)
                                        <option value="{{$category->id}}" {{ (in_array($category->id, $productSearchCategories))  ? 'selected': '' }}>{{$category->name}}</option>
                                        @endforeach
                                        </select>
                                    </div>

                                    <div class="col-12">
                                        <div class="d-grid">
                                            <button class="btn btn-primary">Update Content</button>
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
@section('js')

        <script>
            $(document).ready(function() {
                imgSelect();
                getAllImage();
                $("#exampleModal").click(function () {
                    $("#exampleModal").modal("show");
                });
                $("#exampleModal").modal({
                    show: true,
                    backdrop: 'static'
                });
            });
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
                var url = "{{ asset('/Ingen data/uploads/')}}"+'/'+result.server_file;
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
