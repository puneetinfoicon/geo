@extends('admin.layout.master')
@section('title', 'Add Page')
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--start content-->
    <main class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">eCommerce</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Add Variant Product</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="row">
            <div class="col-lg-12 mx-auto">
                <div class="card">
                    <div class="card-header py-3 bg-transparent">
                        <h5 class="mb-0">Add Variant Product</h5>
                    </div>
                    <div class="card-body">
                        @if(Session::has('success'))
                            <div class="alert alert-success" role="alert">{{Session::get('success')}}</div>
                        @elseif(Session::has('error'))
                            <div class="alert alert-danger" role="alert">{{Session::get('error')}}</div>
                        @endif
                        <div class="border p-3 rounded">
                            <form class="row g-3" action="{{route('submitVariantProduct')}}" method="post" enctype="multipart/form-data">

                                @csrf

                                <div class="col-12 mb-3">
                                    <label class="form-label">Product Number</label>
                                    <input type="text" name="api_id" class="form-control" value="{{getLastvarId()}}" required readonly>
                                </div>

                                <div class="col-12 mb-3">
                                    <label class="form-label">Product Name</label>
                                    <input type="text" name="api_name" class="form-control" value="{{old('api_name')}}" placeholder="Product Name" required >
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label">Meta Tag</label>
                                    <input type="text" name="meta_tag" class="form-control" value="{{old('meta_tag')}}" placeholder="Meta Tag" >
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label">Meta Description</label>
                                    <textarea name="meta_description" class="form-control" placeholder="Meta Description">{{old('meta_description')}}</textarea>
                                </div>

                                <div class="col-12 mb-3">
                                    <label class="form-label">Description</label>
                                    <textarea class="summernote" name="description">{{old('description')}}</textarea>
                                </div>

                                <div class="col-12 mb-3">
                                    <label class="form-label">Short Text</label>
                                    <textarea class="summernote" name="short_text">{{old('short_text')}}</textarea>
                                </div>

                                <div class="col-12 mb-3">
                                    <label class="form-label">Specifikationer</label>
                                    <input type="text" class="form-control" name="specification_title" value="@if(old('specification_title')) {{old('specification_title')}} @else Specifikationer @endif">
                                    <textarea class="form-control summernote" name="specfication" id="specfication" >{{old('specfication')}}</textarea>
                                </div>

                                <div class="col-12 mb-3">
                                    <label class="form-label">Indeholder (what is in the box)</label>
                                    <input type="text" class="form-control" name="inholder_title"  value="@if(old('inholder_title')) {{old('inholder_title')}} @else Indeholder @endif">
                                    <textarea class="form-control summernote" name="inholder" id="inholder" >{{old('inholder')}}</textarea>
                                </div>

                                <div class="col-12 mb-3">
                                    <label class="form-label">Specifikationer</label>
                                    <input type="text" class="form-control" name="specification2_title"  value="@if(old('specification2_title')) {{old('specification2_title')}} @else Specifikationer @endif">
                                    <textarea class="form-control summernote" name="specification2" id="specification2" >{{old('specification2')}}</textarea>
                                </div>

                                <div class="col-12 mb-3">
                                    <label class="form-label">Specifikationer</label>
                                    <input type="text" class="form-control" name="specification3_title" value="@if(old('specification3_title')) {{old('specification3_title')}} @else Specifikationer @endif">
                                    <textarea class="form-control summernote" name="specification3" id="specification3" >{{old('specification3')}}</textarea>
                                </div>

                                <div class="col-12 mb-3">
                                    <label class="form-label">Specifikationer</label>
                                    <input type="text" class="form-control" name="specification4_title"  value="@if(old('specification4_title')) {{old('specification4_title')}} @else Specifikationer @endif">
                                    <textarea class="form-control summernote" name="specification4" id="specification4" >{{old('specification3')}}</textarea>
                                </div>


                                <div class="col-12 mb-3">
                                    <label class="form-label">Areas</label>
                                    <select class="multiple-select" name="areas[]" data-placeholder="Choose anything" multiple="multiple">
                                        <option value="" disabled> Select Area</option>
                                        @if(sizeof($areas)>0)
                                            @foreach($areas as $area)
                                            <option value="{{$area->id}}" @if(old('areas')) {{ (in_array($area->id, old('areas')))? 'selected': '' }} @endif>{{$area->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label">Show product on these area front page</label>
                                    <select class="multiple-select" name="related_area[]" data-placeholder="Choose anything" multiple="multiple">
                                        <option value="" disabled> Select Area</option>
                                        @if(sizeof($areas)>0)
                                            @foreach($areas as $area)
                                            <option value="{{$area->id}}" @if(old('areas')) {{ (in_array($area->id, old('areas')))? 'selected': '' }} @endif>{{$area->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>

                                <div class="col-12 mb-3">
                                    <label class="form-label">Product Categories</label>
                                    <select class="multiple-select" name="categories[]" data-placeholder="Choose anything" multiple="multiple">
                                        <option value="" disabled> Select Product Categories</option>
                                        @if(sizeof($categories)>0)
                                            @foreach($categories as $category)
                                            <option value="{{$category->id}}" @if(old('categories')) {{ (in_array($category->id, old('categories')))? 'selected': '' }} @endif>{{$category->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>

                                <div class="col-12 mb-3">
                                    <label class="form-label">Search Categories</label>
                                    <select class="multiple-select" name="searchCategories[]" data-placeholder="Choose anything" multiple="multiple">
                                        <option value="" disabled> Select Product Categories</option>
                                        @if(sizeof($searchCategories)>0)
                                            @foreach($searchCategories as $searchCategory)
                                            <option value="{{$searchCategory->id}}" @if(old('searchCategories')) {{ (in_array($searchCategory->id, old('searchCategories')))? 'selected': '' }} @endif>{{$searchCategory->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>

                                <div class="col-12 mb-3">
                                    <label class="form-label">Mandatory Tilbehør</label>
                                    <select class="multiple-select" name="Mtilbehor[]" data-placeholder="Choose anything" multiple="multiple">
                                        <option value="" disabled> Select Tilbehør</option>
                                        @if(sizeof($allProducts)>0)
                                            @foreach($allProducts as $allProduct)
                                            <option value="{{$allProduct->id}}" @if(old('Mtilbehor')) {{ (in_array($allProduct->id, old('Mtilbehor')))? 'selected': '' }} @endif>({{$allProduct->api_id}}) - {{$allProduct->api_name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>

                                <div class="col-12 mb-3">
                                    <label class="form-label">Optional Tilbehør</label>
                                    <select class="multiple-select" name="tilbehor[]" data-placeholder="Choose anything" multiple="multiple">
                                        <option value="" disabled> Select Tilbehør</option>
                                        @if(sizeof($allProducts)>0)
                                            @foreach($allProducts as $allProduct)
                                            <option value="{{$allProduct->id}}" @if(old('tilbehor')) {{ (in_array($allProduct->id, old('tilbehor')))? 'selected': '' }} @endif>({{$allProduct->api_id}}) - {{$allProduct->api_name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>

                                <div class="col-12 mb-3">
                                    <label class="form-label">Passer til</label>
                                    <select class="multiple-select" name="passer[]" data-placeholder="Choose anything" multiple="multiple">
                                        <option value="" disabled> Select passer till</option>
                                        @if(sizeof($allProducts)>0)
                                            @foreach($allProducts as $allProduct)
                                            <option value="{{$allProduct->id}}" @if(old('passer')) {{ (in_array($allProduct->id, old('passer')))? 'selected': '' }} @endif>({{$allProduct->api_id}}) - {{$allProduct->api_name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" name="status" type="checkbox" value="1" id="flexCheckDefault1" {{ (old('status'))? 'checked': '' }}>
                                        <label class="form-check-label" for="flexCheckDefault1">Status</label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" name="hide_amount" type="checkbox" value="1" id="flexCheckDefault2" {{ (old('hide_amount'))? 'checked': '' }}>
                                        <label class="form-check-label" for="flexCheckDefault2">Hide Amount</label>
                                    </div>
                                </div>

                                <div class="col-12 mb-3">
                                    <label class="form-label">Contents</label>
                                    <select class="multiple-select" name="contexts[]" data-placeholder="Choose anything" multiple="multiple">
                                        <option value="" disabled> Select Contents</option>
                                        @if(sizeof($contexts)>0)
                                            @foreach($contexts as $context)
                                                <option value="{{$context->id}}" @if(old('contexts')) {{ (in_array($context->id, old('contexts')))? 'selected': '' }} @endif>{{$context->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>

                                <div class="col-12 mb-3">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label for=""> Add Label</label>
                                        </div>
                                        <div class="col-md-4">
                                            <label for=""> Select Subscription Product</label>
                                        </div>
                                        <div class="col-md-4">
                                            <label for=""> Select SIM</label>
                                        </div>
                                        <div class="col-md-2">

                                        </div>
                                    </div>
                                    @if(old('label_name'))
                                        @foreach(old('label_name') as $kk=>$oldLabel)
                                            @if($kk == 0)
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <input type="text" class="form-control" name="label_name[]" placeholder="Label Name" value="{{$oldLabel}}" required>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <select class="multiple-select required" name="varProductId[]" data-placeholder="Choose anything" required>
                                                            <option value="" disabled > Select Product</option>
                                                            @if(sizeof($allProducts)>0)
                                                                @foreach($allProducts as $allProduct)
                                                                    <option value="{{$allProduct->id}}" @if(old('varProductId')) {{ ($allProduct->id == old('varProductId')[$kk])? 'selected': '' }} @endif  >({{$allProduct->api_id}}) - {{$allProduct->api_name}}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <select class="multiple-select" name="sim[{{$kk}}][]" data-placeholder="Choose anything" multiple required>
                                                            @if(sizeof(getAllSim())>0)
                                                                @foreach(getAllSim() as $all_Product)
                                                                    <option value="{{$all_Product->api_id}}" @if(old('sim')) {{ (in_array($all_Product->api_id, old('sim')[$kk]))? 'selected': '' }} @endif >{{$all_Product->api_name}}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <a class="btn btn-primary" id="addRow"><span class="fa fa-plus"></span></a>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="row mt-2" id="phprow{{$kk}}">
                                                    <div class="col-md-2">
                                                        <input type="text" class="form-control" name="label_name[]" value="{{$oldLabel}}" placeholder="Label Name">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <select class="multiple-select" name="varProductId[]" data-placeholder="Choose anything">
                                                            <option value=""> </option>
                                                            @if(sizeof($allProducts)>0)
                                                                @foreach($allProducts as $allProduct)
                                                                    <option value="{{$allProduct->id}}" @if(old('varProductId')) {{ ($allProduct->id == old('varProductId')[$kk])? 'selected': '' }} @endif >({{$allProduct->api_id}}) - {{$allProduct->api_name}}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <select class="multiple-select" name="sim[{{$kk}}][]" data-placeholder="Choose anything" multiple required>
                                                            @if(sizeof(getAllSim())>0)
                                                                @foreach(getAllSim() as $all_Product)
                                                                    <option value="{{$all_Product->api_id}}" @if(old('sim')) {{ (in_array($all_Product->api_id, old('sim')[$kk]))? 'selected': '' }} @endif >{{$all_Product->api_name}}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <a class="btn btn-danger" onclick="delRowphp('{{$kk}}')"><span class="fa fa-times"></span></a>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach

                                    @else
                                        <div class="row">
                                            <div class="col-md-2">
                                                <input type="text" class="form-control" name="label_name[]" placeholder="Label Name" required>
                                            </div>
                                            <div class="col-md-4">
                                                <select class="multiple-select required" name="varProductId[]" data-placeholder="Choose anything" required>
                                                    <option value="" disabled > Select Product</option>
                                                    @if(sizeof($allProducts)>0)
                                                        @foreach($allProducts as $allProduct)
                                                            <option value="{{$allProduct->id}}">({{$allProduct->api_id}}) - {{$allProduct->api_name}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <select class="multiple-select" name="sim[0][]" data-placeholder="Choose anything" multiple>
                                                    @if(sizeof(getAllSim())>0)
                                                        @foreach(getAllSim() as $all_Product)
                                                            <option value="{{$all_Product->api_id}}" @if(old('sim')) {{ ($all_Product->api_id == old('sim')[$kk])? 'selected': '' }} @endif >{{$all_Product->api_name}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <a class="btn btn-primary" id="addRow"><span class="fa fa-plus"></span></a>
                                            </div>
                                        </div>
                                    @endif


                                    <div id="appendHtml" class="mt-2"></div>

                                </div>

                                <div class="row align-items-start mb-3 pos-relative">
                                    <div class="file-drop-area drop_drag_area">
                                        <span class="fake-btn">Add Images</span>
                                        <span class="file-msg">or drag and drop files here</span>
                                        <input class="file-input" name='images[]' type="file" multiple>
                                    </div>

                                <div class="col-md-2">
                                    <button type="button" class="btn btn-success allImg" data-bs-target="#exampleModal">Browse From Image Library</button>
                                </div>

                                    <div class="modal fade file_expoloer" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                </div>
                                        <div id="newInput"></div>
                                    <div class="col-12 text-center">
                                        <button class="btn btn-primary px-4">Submit Product</button>
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
@section('js')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>
    <script>
        $(document).ready(function () {
            $(".summernote").summernote({
                placeholder: "Write your content here",
                height: 200,
            });
        });
function customSelect(){
    $('.single-select').select2({
        theme: 'bootstrap4',
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
        placeholder: $(this).data('placeholder'),
        allowClear: Boolean($(this).data('allow-clear')),
    });
    $('.multiple-select').select2({
        theme: 'bootstrap4',
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
        placeholder: $(this).data('placeholder'),
        allowClear: Boolean($(this).data('allow-clear')),
    });
}
        $(document).ready(function(){
            var i = 0;
            $('#addRow').click(function (){
                i++;
                document.getElementsByClassName('inc').value = i+1;
                $('#appendHtml').append('<div class="row mt-2" id="roww'+i+'"><div class="col-md-2"></input><input type="text" class="form-control" name="label_name[]" placeholder="Label Name" required></div><div class="col-md-4"><select class="multiple-select" name="varProductId[]" data-placeholder="Choose anything" required><option value=""> </option>@if(sizeof($allProducts)>0) @foreach($allProducts as $allProduct)<option value="{{$allProduct->id}}">({{$allProduct->api_id}}) - {{$allProduct->api_name}}</option>@endforeach @endif </select></div><div class="col-md-4"><select class="multiple-select" name="sim['+i+'][]" data-placeholder="Choose anything" multiple> @if(sizeof(getAllSim())>0) @foreach(getAllSim() as $all_Product) <option value="{{$all_Product->api_id}}" @if(old('sim')) {{ ($all_Product->api_id == old('sim')[$kk])? 'selected': '' }} @endif >{{$all_Product->api_name}}</option> @endforeach @endif </select></div><div class="col-md-2"><a class="btn btn-danger" class="delRow" onclick="deleteRow('+i+')"><span class="fa fa-times"></span></a></div></div>');
                customSelect();
            })
        })

        function deleteRow(id){
            $('#roww'+id).remove();
        }
        function delRowphp(id)
        {
            $('#phprow'+id).remove();
        }
    </script>

    <script>
        $(document).ready(function (){
            imgSelect();
            getAllImage();

            $('.closeModel').click(function (){
                $('#newInput').empty();
                $('.imgs').removeClass('active');
            })
            $('.saveModel').click(function (){
                $('.imgs').removeClass('active');
            })
        })
        $(document).ready(function() {
            $("#exampleModal").modal({
                show: false,
                backdrop: 'static'
            });

            $("#exampleModal").click(function() {
                $("#exampleModal").modal("show");
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
                    $(this).addClass('active');
                    $('#newInput').append('<input type="hidden" name="productImages[]" id="image'+$(this).attr('id')+'" value="pagebuilder/uploads/'+$(this).attr('data-id')+'">' +
                        '<input type="hidden" name="altImages[]" id="alt'+$(this).attr('id')+'" value="'+$(this).attr('data-alt')+'">'+
                        '<input type="hidden" name="titleImages[]" id="title'+$(this).attr('id')+'" value="'+$(this).attr('data-title')+'">');
                }
            });
        }

        const getAllImage=()=> {
            $('.allImg').click(function () {
                //$('#exampleModal').toggle('modal');
                $('#exampleModal').toggle('modal').addClass('show');
                $("#exampleModal").trigger('click')
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
