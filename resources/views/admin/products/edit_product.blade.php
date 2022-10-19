
@extends('admin.layout.master')
@section('title', 'Add Page')
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .dragdrop .card {
            height: 300px;
            text-align: center;
            overflow: hidden;
        }

        .ui-state-hover {
            background: lightyellow;
        }

        .ui-state-active {
            background: lightgray
        }
        .subsss_checkRadio {
            display: flex;
            gap: 50px;
            align-items: center;
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
                        <li class="breadcrumb-item">products</li>
                        <li class="breadcrumb-item active" aria-current="page">Update Product</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="row">
            <div class="col-lg-12 mx-auto">
                <div class="card">
                    <div class="card-header py-3 bg-transparent">
                        <h5 class="mb-0">Update Product</h5>
                    </div>
                    <div class="card-body">
                        @if(Session::has('success'))
                            <div class="alert alert-success" role="alert">{{Session::get('success')}}</div>
                        @elseif(Session::has('error'))
                            <div class="alert alert-danger" role="alert">{{Session::get('error')}}</div>
                        @endif
                        <div class="border p-3 rounded">
                            <form class="row g-3" action="{{route('updateProducts')}}" method="post"
                                  enctype="multipart/form-data">

                                @csrf
                                <input type="hidden" name="id" id="id" value='{{ $product->id }}' required>

                                <label class="form-label">Product Number</label>
                                <input type="text" name="api_id" id="api_id" value="{{ $product->api_id }}" disabled>

                                <label class="form-label">Product Name</label>
                                <input type="text" name="api_name" id="api_name" value="{{ $product->api_name }}"
                                       disabled>

                                    <label class="form-label">Meta Tag</label>
                                    <input type="text" name="meta_tag" class="form-control" value="@if(old('meta_tag')) {{old('meta_tag')}} @else {{ $product->meta_tag }} @endif" placeholder="Meta Tag" >

                                    <label class="form-label">Meta Description</label>
                                    <textarea name="meta_description" class="form-control" placeholder="Meta Description">@if(old('meta_description')) {{old('meta_description')}} @else {{ $product->meta_description }} @endif</textarea>


                                <label class="form-label">Description</label>

                                <textarea id="" class="form-control summernote" name="description"
                                          placeholder="Full description" rows="4"
                                          cols="4">@if(old('description')) {{old('description')}} @else {{ $product->description }} @endif</textarea>

                                <label class="form-label">Short text</label>
                                <textarea class="form-control summernote" name="short_text"
                                          id="short_text">@if(old('short_text')) {{old('short_text')}} @else {{ $product->short_text }} @endif</textarea>

                                <label class="form-label">Specifications</label>
                                <input type="text" name="specification_title"
                                       value="@if(old('specification_title')) {{ old('specification_title') }}  @else {{ $product->specification_title }} @endif">
                                <textarea class="form-control summernote" name="specfication"
                                          id="specfication">@if(old('specfication')) {{ old('specfication') }}  @else {{ $product->specfication }} @endif</textarea>


                                <label class="form-label">Indeholder (what is in the box)</label>
                                <input type="text" name="inholder_title" value="@if(old('inholder_title'))  {{ old('inholder_title') }}  @else {{ $product->inholder_title }} @endif">
                                <textarea class="form-control summernote" name="inholder"
                                          id="inholder">@if(old('inholder'))  {{ old('inholder') }} @else {{ $product->inholder }} @endif</textarea>


                                <label class="form-label">Specifications</label>
                                <input type="text" name="specification2_title"
                                       value="@if(old('specification2_title')) {{ old('specification2_title') }} @else {{ $product->specification2_title }} @endif">
                                <textarea class="form-control summernote"
                                          name="specification2">@if(old('specification2')) {{ old('specification2') }} @else {{ $product->specification2 }} @endif</textarea>


                                <label class="form-label">Specifications</label>
                                <input type="text" name="specification3_title"
                                       value="@if(old('specification3_title')) {{ old('specification3_title') }} @else {{ $product->specification3_title }} @endif">
                                <textarea class="form-control summernote"
                                          name="specification3">@if(old('specification3')) {{ old('specification3') }} @else {{ $product->specification3 }} @endif</textarea>


                                <label class="form-label">Specifications</label>
                                <input type="text" name="specification4_title"
                                       value="@if(old('specification4_title')) {{ old('specification4_title') }} @else {{ $product->specification4_title }} @endif">
                                <textarea class="form-control summernote"
                                          name="specification4">@if(old('specification4')) {{ old('specification4') }} @else {{ $product->specification4 }} @endif</textarea>

                                <div class="col-12 mb-3">
                                    <label class="form-label">Areas</label>
                                    <select class="multiple-select" name='areas[]' data-placeholder="Choose anything"
                                            multiple="multiple" required>
                                        <option disabled>-Select Area-</option>
                                        @foreach($areas as $key => $category)
                                            <option
                                                value="{{$category->id}}"  @if(old('areas')) {{ (in_array($category->id, old('areas')))? 'selected': '' }} @else {{ (in_array($category->id, $productAreas)) ? 'selected': '' }} @endif >{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-12 mb-3">
                                    <label class="form-label">Show product on these area front page</label>
                                    <select class="multiple-select" name="related_area[]" data-placeholder="Choose anything" multiple="multiple">
                                        <option value="" disabled> Select Area</option>
                                        @if(sizeof($areas)>0)
                                            @foreach($areas as $area)
                                                <option value="{{$area->id}}" @if(old('areas')) {{ (in_array($area->id, old('areas')))? 'selected': '' }} @else {{ (in_array($area->id, $relatedArea)) ? 'selected': '' }}  @endif>{{$area->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>

                                <div class="col-12 mb-3">
                                    <label class="form-label">Product Categories</label>
                                    <select class="multiple-select" name='categories[]'
                                            data-placeholder="Choose anything" multiple="multiple" required>
                                        <option disabled>-Select Category-</option>
                                        @foreach($categories as $key => $category)
                                            <option value="{{$category->id}}" @if(old('categories')) {{ (in_array($category->id, old('categories')))? 'selected': '' }} @else {{ (in_array($category->id, $productCategories)) ? 'selected': '' }} @endif>{{$category->name}}  </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-12 mb-3">
                                    <label class="form-label">Search Categories</label>
                                    <select class="multiple-select" name='searchCategories[]'
                                            data-placeholder="Choose anything" multiple="multiple" required>
                                        <option disabled>-Select Categories-</option>
                                        @foreach($searchCategories as $key => $category)
                                            <option
                                                value="{{$category->id}}" @if(old('searchCategories')) {{ (in_array($category->id, old('searchCategories')))? 'selected': '' }} @else {{ (in_array($category->id, $productSearchCategories))  ? 'selected': '' }} @endif >{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label">Mandatory Tilbehør</label>
                                    <select class="multiple-select" name="Mtilbehor[]" data-placeholder="Choose anything" multiple="multiple">
                                        <option value="" disabled> Select Tilbehør</option>
                                        @if(sizeof($allProducts)>0)
                                            @foreach($allProducts as $allProduct)
                                                <option
                                                    value="{{$allProduct->id}}"  @if(old('Mtilbehor')) {{ (in_array($allProduct->id, old('Mtilbehor')))? 'selected': '' }} @else {{ (in_array($allProduct->id, $productMtilbehors)) ? 'selected': '' }} @endif >
                                                    ({{$allProduct->api_id}}) - {{$allProduct->api_name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label">Optional Tilbehør</label>
                                    <select class="multiple-select" name='tilbehor[]' data-placeholder="Choose anything"
                                            multiple="multiple">
                                        <option disabled>-Select Tilbehør-</option>
                                        @foreach($allProducts as $key => $pro)
                                            <option
                                                value="{{$pro->id}}"  @if(old('tilbehor')) {{ (in_array($pro->id, old('tilbehor')))? 'selected': '' }} @else {{ (in_array($pro->id,$productTilbehors)) ? 'selected': '' }} @endif >
                                                ({{$pro->api_id}}) - {{$pro->api_name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-12 mb-3">
                                    <label class="form-label">Passer til</label>
                                    <select class="multiple-select" name='passer[]' data-placeholder="Choose anything"
                                            multiple="multiple">
                                        <option disabled>-Select Passer til-</option>
                                        @foreach($allProducts as $key => $pro)
                                            <option
                                                value="{{$pro->id}}" @if(old('passer')) {{ (in_array($pro->id, old('passer')))? 'selected': '' }} @else {{ (in_array($pro->id, $productPassers)) ? 'selected': '' }} @endif >
                                                ({{$pro->api_id}}) - {{$pro->api_name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" name="status" type="checkbox" value="1"
                                               id="flexCheckDefault1" @if((old('status'))) {{ (old('status'))? 'checked': '' }} @else  {{ ($product->status == 1) ? 'checked': '' }} @endif>
                                        <label class="form-check-label" for="flexCheckDefault1">Status</label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" name="hide_amount" type="checkbox" value="1"
                                               id="flexCheckDefault2" @if(old('hide_amount')) {{ (old('hide_amount'))? 'checked': '' }} @else {{ ($product->hide_amount == 1) ? 'checked': '' }} @endif>
                                        <label class="form-check-label" for="flexCheckDefault2">Hide Amount</label>
                                    </div>

                                </div>

                                <div class="col-12 mb-3">
                                    <label class="form-label">Contents</label>
                                    <select class="multiple-select" name='contexts[]' data-placeholder="Choose anything"
                                            multiple="multiple">
                                        @foreach($contexts as $key => $content)
                                            <option
                                                value="{{$content->id}}"  @if(old('contexts')) {{ (in_array($content->id, old('contexts')))? 'selected': '' }} @else {{ (in_array($content->id, $productContexts)) ? 'selected': '' }} @endif >{{$content->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                    @if($product->is_subscription == 1)
                                    <input class="d-none" type="checkbox" name="is_subscription" value="1" checked>
                                    <div class="col-12 mb-3">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label for=""> Add Label</label>
                                            </div>
                                            <div class="col-md-4">
                                                <label for=""> Select Subscription Product</label>
                                            </div>
                                            <div class="col-md-4">
                                                <label for=""> Select Sim</label>
                                            </div>
                                            <div class="col-md-2">

                                            </div>
                                        </div>

                                        <?php
                                        if (sizeof(getVariants($product->id))>0){
                                            foreach (getVariants($product->id) as $key=>$variant){
                                                if ($key == 0){
                                        ?>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <input type="text" class="form-control" name="label_name[]" placeholder="Label Name" value="{{$variant->label_name}}" multiple required>
                                            </div>
                                            <div class="col-md-4">
                                                <select class="multiple-select required" name="varProductId[]" data-placeholder="Choose anything" required>
                                                    <option value="" disabled > Select Product</option>
                                                    @if(sizeof($allProducts)>0)
                                                        @foreach($allProducts as $allProduct)
                                                            <option value="{{$allProduct->id}}" @if($allProduct->id == $variant->product_id) selected @endif>({{$allProduct->api_id}}) - {{$allProduct->api_name}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <select class="multiple-select required" name="sim[{{$key}}][]" data-placeholder="Choose anything" multiple>
                                                    <option value="" disabled > Select Product</option>
                                                        @if(sizeof(getAllSim())>0)
                                                        @foreach(getAllSim() as $kk=>$all_Product)
                                                            <option value="{{$all_Product->api_id}}"  @if(old('sim')) {{ (in_array($all_Product->api_id, old('sim')[$key]))? 'selected': '' }}
                                                                @else {{ (in_array($all_Product->api_id, explode(',',$variant->sims))) ? 'selected': '' }} @endif>{{$all_Product->api_name}}</option>
                                                        @endforeach
                                                        @endif
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <a class="btn btn-primary" id="addRow"><span class="fa fa-plus"></span></a>
                                            </div>
                                        </div>
                                        <?php }else{?>
                                        <div class="row mt-2" id="phprow{{$variant->product_id}}">
                                            <div class="col-md-2">
                                                <input type="text" class="form-control" name="label_name[]" value="{{$variant->label_name}}" placeholder="Label Name">
                                            </div>
                                            <div class="col-md-4">
                                                <select class="multiple-select" name="varProductId[]" data-placeholder="Choose anything">
                                                    <option value=""> </option>
                                                    @if(sizeof($allProducts)>0)
                                                        @foreach($allProducts as $allProduct)
                                                            <option value="{{$allProduct->id}}"  @if($allProduct->id == $variant->product_id) selected @endif>({{$allProduct->api_id}}) - {{$allProduct->api_name}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <select class="multiple-select required" name="sim[{{$key}}][]" data-placeholder="Choose anything" multiple >
                                                    <option value="" disabled > Select Product</option>
                                                    @if(sizeof(getAllSim())>0)
                                                        @foreach(getAllSim() as $all_Product)
                                                            <option value="{{$all_Product->api_id}}"  @if(old('contexts')) {{ (in_array($all_Product->api_id, old('sim')[$key]))? 'selected': '' }}
                                                                @else {{ (in_array($all_Product->api_id, explode(',',$variant->sims))) ? 'selected': '' }} @endif>{{$all_Product->api_name}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <a class="btn btn-danger" onclick="delRowphp('{{$variant->product_id}}')"><span class="fa fa-times"></span></a>
                                            </div>
                                        </div>
                                        <?php }}}?>
                                        <div id="appendHtml" class="mt-2"></div>

                                    </div>
                                     @endif


                                <div class="row align-items-start mb-3 pos-relative1">

                                   <div class="btn_upload">
                                       <div class="section_custom file-drop-area drop_drag_area">
                                           <span class="fake-btn">Add Images</span>
                                           <span class="file-msg">or drag and drop files here</span>
                                           <input class="file-input" name='images[]' type="file" multiple>
                                       </div>

                                       <div class="section_custom update-delete">
                                           <a class="btn btn-success allImg" data-bs-target="#exampleModal">Browse From Image Library</a>

                                           <a href="javascript:;" class="btn btn-primary" onclick="recall()" >
                                               <label class=" px-5" > update Sequence</label>
                                           </a>

                                           <a class="input-file add-image-btn deleteAll">
                                               <label class="btn btn-danger px-5"> Delete All Images</label>
                                           </a>
                                       </div>
                                   </div>

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


                                    <div class="col-12 mb-3">
                                        <div class="row loopImg">
                                            @if(sizeof($productImages) > 0)
                                                @foreach ($productImages as $key => $image)
                                                    <div class="col-md-3 dragdrop" id="{{$image->id}}"
                                                         data_value="{{$image->url}}" data_type="{{$image->type}}">
                                                        <div class="card card-with-close">
                                                            <button type="button" class="btn-close"
                                                                     aria-label="Close"></button>
                                                            <img src="{{ asset(''. $image->url) }}" class="card-img-top"
                                                                 alt="{{$image->alt_image}}" title="{{$image->title_image}}" height="100%">
                                                        </div>
                                                        <input type="hidden" class="form-control smImg" name="img[]" value="{{$image->url}}" id="{{$image->type}}" >
                                                    </div>

                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                        {{-- <span class="countImage"></span>--}}
                                  </div>

                                    <div class="row align-items-start mb-3">
                                        <button class="btn btn-primary px-4">Update Product</button>
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
            $('.deleteAll').click(function (){
                $.ajax({
                    type: "post",
                    url: "{{url('admin/deleteAllImage')}}",
                    data: "productId={{$product->id}}"+ '&_token={{ csrf_token() }}',
                    success: function (data) {
                        if (data.success == 1){
                            $('.dragdrop').remove();
                        }
                    }
                })
            })


            $(".btn-close").click(function () {
                // $(this).parents(".col-md-3").remove();
                var id = $(this).parents(".col-md-3").attr("id")
                var url = "{{url('admin/deleteProductImage')}}";
                // console.log(id);
                $.ajax({
                    url: url,
                    headers: {
                        'X-CSRF-TOKEN': '{{csrf_token()}}'
                    },
                    type: "POST",
                    data: {
                        'id': id
                    },
                    context: this,
                    success: function (response, status, jqXHR) {
                        console.log(response)
                        if (response.result.success == 1) {
                            $(this).parents(".col-md-3").remove();
                        } else {
                            alert("Something went wrong");
                        }
                    },
                    error: function (error) {
                        console.log(error.responseText);
                    }
                });
            });

            $("#files").on("change", function (e) {
                var numFiles = e.target.files.length;
                $(".countImage").html(numFiles + " files selected");

            });
        });


    </script>

    <script>
        $(document).ready(function () {
            $(".summernote").summernote({
                placeholder: "Write your content here",
                height: 200,
            });
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <script>
            jQuery.fn.swap = function (b) {
            // method from: http://blog.pengoworks.com/index.cfm/2008/9/24/A-quick-and-dirty-swap-method-for-jQuery
            b = jQuery(b)[0];
            var a = this[0];

            var t = a.parentNode.insertBefore(document.createTextNode(''), a);
            b.parentNode.insertBefore(a, b);
            t.parentNode.insertBefore(b, t);
            t.parentNode.removeChild(t);
            return this;
        };


        $(".dragdrop").draggable({revert: true, helper: "clone"});

        $(".dragdrop").droppable({
            accept: ".dragdrop",
            activeClass: "ui-state-hover",
            hoverClass: "ui-state-active",
            drop: function (event, ui) {

                var draggable = ui.draggable, droppable = $(this),
                    dragPos = draggable.position(), dropPos = droppable.position();

                draggable.css({
                    left: dropPos.left + 'px',
                    top: dropPos.top + 'px'
                });

                droppable.css({
                    left: dragPos.left + 'px',
                    top: dragPos.top + 'px'
                });
                draggable.swap(droppable);
            }
        });

        function recall(){
            var myAssociativeArr = [];
            var arrayType = [];

            $(".smImg").each(function (index, element) {

                var newElement = {};
                newElement = element.value;
                myAssociativeArr.push(newElement);


                var newElement1 = {};
                newElement1 = element.id;
                arrayType.push(newElement1);
            });

            console.log(myAssociativeArr);

            $.ajax({
                type: "post",
                url: "{{url('admin/changeImage')}}",
                data: "img=" + JSON.stringify(myAssociativeArr) + '&_token={{ csrf_token() }}&productId={{$product->id}}&type='+ JSON.stringify(arrayType),
                success: function (data) {
                    console.log(data)
                    $('.loopImg').empty();

                    data.forEach(function (item) {
                        location.reload();
                        //var imgUrl = "{{url('')}}/"+item.url;
                        //$('.loopImg').append('<div class="col-md-3 dragdrop ui-draggable ui-draggable-handle ui-droppable"> <div class="card card-with-close"> <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>  <img src="'+imgUrl+'" class="card-img-top" alt="..." height="100%"> </div> <input type="text" class="form-control smImg" name="img[]" value="'+imgUrl+'" id="'+item.type+'" > </div>');
                    })
                }
            });
        }




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
                    $('#appendHtml').append('<div class="row mt-2" id="roww'+i+'"><div class="col-md-2"></input><input type="text" class="form-control" name="label_name[]" placeholder="Label Name" required></div><div class="col-md-4"><select class="multiple-select" name="varProductId[]" data-placeholder="Choose anything" required><option value=""> </option>@if(sizeof($allProducts)>0) @foreach($allProducts as $allProduct)<option value="{{$allProduct->id}}">({{$allProduct->api_id}}) - {{$allProduct->api_name}}</option>@endforeach @endif </select></div><div class="col-md-4"><select class="multiple-select" name="sim['+i+'][]" data-placeholder="Choose anything" multiple> @if(sizeof(getAllSim())>0) @foreach(getAllSim() as $all_Product) <option value="{{$all_Product->api_id}}" @if(old('sim')) {{ ($all_Product->api_id == old('sim'))? 'selected': '' }} @endif >{{$all_Product->api_name}}</option> @endforeach @endif </select></div><div class="col-md-2"><a class="btn btn-danger" class="delRow" onclick="deleteRow('+i+')"><span class="fa fa-times"></span></a></div></div>');
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
        });

        $(document).ready(function() {
            $("#exampleModal").modal({
                show: false,
                backdrop: 'static'
            });

            $("#exampleModal").click(function() {
                $("#exampleModal").modal("show");
            });
        });
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
