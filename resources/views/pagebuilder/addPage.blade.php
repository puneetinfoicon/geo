@extends('admin.layout.master')
@section('title', 'Add Page')
@section('content')



    <main class="page-content">
        <div class="py-5 text-center">

            <h2><?= phpb_trans('website-manager.title') ?></h2>
        </div>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <style>
            .btn-check:active + .btn-primary, .btn-check:checked + .btn-primary, .btn-primary.active, .btn-primary:active, .show > .btn-primary.dropdown-toggle {
                color: #fff;
                background-color: #004f83 !important;
                border-color: #004f83 !important;
            }

            .input-group > :not(:first-child):not(.dropdown-menu):not(.valid-tooltip):not(.valid-feedback):not(.invalid-tooltip):not(.invalid-feedback) {
                margin-left: -12px;
                border-top-left-radius: 0;
                border-bottom-left-radius: 0;
                /* border: none; */
                padding-left: 0px;
            }
        </style>
        <style>
            .tree, .tree ul {
                margin: 0;
                padding: 0;
                list-style: none
            }

            .tree ul {
                margin-left: 1em;
                position: relative
            }

            .tree ul ul {
                margin-left: .5em
            }

            .tree ul:before {
                content: "";
                display: block;
                width: 0;
                position: absolute;
                top: 0;
                bottom: 0;
                left: 0;
                border-left: 1px solid
            }

            .tree li {
                margin: 0;
                padding: 0 15px;
                line-height: 30px;
                color: #369;
                font-weight: 400;
                position: relative;
                font-size: 15px;
                cursor: pointer;
            }

            .tree li span {
                font-size: 20px;
                display: inline-block;
                margin-left: 10px;
                position: relative;
                top: 4px;
            }

            .tree li span a {
                padding: 0 2px;
            }

            .tree ul li:before {
                content: "";
                display: block;
                width: 10px;
                height: 0;
                border-top: 1px solid;
                margin-top: -1px;
                position: absolute;
                top: 1em;
                left: 0
            }

            .tree ul li:last-child:before {
                background: #fff;
                height: auto;
                top: 1em;
                bottom: 0
            }

            .indicator {
                margin-right: 5px;
            }

            .tree li a {
                text-decoration: none;
                color: #369;
            }

            .tree li button, .tree li button:active, .tree li button:focus {
                text-decoration: none;
                color: #369;
                border: none;
                background: transparent;
                margin: 0px 0px 0px 0px;
                padding: 0px 0px 0px 0px;
                outline: 0;
            }
        </style>
        <div class="container">
            <div class="row">
                <div class="col-12">

                    <div class="manager-panel">
                        <form action="{{route('pagebuilder.add_pages')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @if(isset($list->id))
                                <div class="text-center"><h4>Update page </h4></div>

                            @else
                                <h4>Add new page </h4>

                            @endif

                            @if(isset($list->id))
                                <input type="hidden" class="form-control" id="name" name="id" value="{{$list->id}}"
                                       required="">
                            @endif

                            <div class="form-group">
                                <label for="flexRadioDefault1">
                                    Create a Guide or a Page ?
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input guide1" type="radio" name="guide" id="flexRadioDefault1"
                                       value="1" {{ (isset($list->guide) && $list->guide == 1) ? 'checked': '' }}>
                                <label class="form-check-label" for="flexRadioDefault1">Guide</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input guide2" type="radio" name="guide" id="flexRadioDefault2"
                                       value="0"
                                       {{ (isset($list->guide) && $list->guide == 0) ? 'checked': '' }} @if(!isset($list->guide)) checked @endif>
                                <label class="form-check-label" for="flexRadioDefault2">Page</label>
                            </div>

                            <div class="main-spacing">

                                <div class="form-group required">
                                    <label for="name">
                                        Name <span class="text-muted">(visible in page overview)</span>
                                    </label>
                                    <input type="text" class="form-control" id="name" name="name"
                                           value="{{isset($list->name) ? $list->name : '' }}" required="">
                                </div>

                                <div class="form-group required">
                                    <label for="page-title">Page title</label>
                                    <input type="text" class="form-control" id="page-title" name="title"
                                           value="{{isset($list->title) ? $list->title : '' }}" required="">
                                </div>
                                <div class="hidden {{ (isset($list->guide) && $list->guide == 1) ? '': 'd-none' }}">
                                    <div class="input-group required">
                                        <label for="area">Please Select Area Name</label>
                                    </div>
                                    @foreach($areas as $a=>$area)
                                        <input type="checkbox" class="btn-check area_btn" value="{{$area->id}}"
                                               name='areas[]' id="option{{$area->id}}"
                                               onclick="getArea({{$area->id}})" {{ (in_array($area->id, getArray($areaId,'area_id'))) ? 'checked': '' }}>
                                        <label class="btn btn-primary" id="lbl{{$area->id}}"
                                               for="option{{$area->id}}">{{$area->name}}</label>
                                    @endforeach
                                </div>


                                <div class="input-group required">
                                    <label for="route">URL</label>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1"
                                          style="border-right: none">{{url('/')}}</span>

                                    <span class="input-group-text" id="basic-addon2"
                                          style="border-left: none"><?php if (isset($list->guide) && $list->guide == 1){ ?>/service-support<?php } ?>@isset($StaticContent[0])@endisset</span>

                                    <input type="text" class="form-control" name="route" id="basic-url"
                                           aria-describedby="basic-addon3" value="<?php if (isset($list->route)) {
                                        $explode = explode('/', $list->route);
                                        echo '/' . end($explode);
                                    } ?>">
                                </div>
                                <input type="hidden" name="prefix" id="prefix"
                                       value="">


                                {{--                            <div class="form-group required">--}}
                                {{--                                <label for="route">URL</label>--}}
                                {{--                                <input type="text" class="form-control" id="route" name="route"--}}
                                {{--                                       value="{{isset($list->route) ? $list->route : '' }}" required="">--}}
                                {{--                            </div>--}}

                                <div class="form-check">
                                    <input class="form-check-input" name="status" type="checkbox" value="1"
                                           id="flexCheckDefault2" {{ (isset($list->status) && $list->status == 1) ? 'checked': '' }}>
                                    <label class="form-check-label" for="flexCheckDefault2">Active</label>
                                </div>

                                <div class="form-group">
                                    <label for="route">Meta Keyword</label>
                                    <input type="text" name="meta_keyword" class="form-control" value="{{isset($list->meta_keyword) ? $list->meta_keyword : '' }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="route">Meta Descriptions</label>
                                    <textarea name="meta_description" class="form-control" required>{{isset($list->meta_description) ? $list->meta_description : '' }}</textarea>
                                </div>

                                <div
                                    class="hidden {{ (isset($list->guide) && $list->guide == 0) ? 'd-none': '' }}  @if(!isset($list->guide)) d-none @endif">
                                    <div class="form-group d-none">
                                        <label for="route">Static Content</label>
                                        <textarea name="static_content"
                                                  class="form-control summernote"><?php if (isset($list->static_content)) {
                                                echo $list->static_content;
                                            } ?></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="route">Parent</label>
                                        <select class="multiple-select" name='context_id'
                                                data-placeholder="Choose anything">
                                            <option value="0">Root</option>
                                            @foreach($contexts as $context)$categoryId
                                            <option
                                                value="{{$context->id}}" {{ (in_array($context->id, getArray($StaticContent,'parent_id'))) ? 'selected': '' }}>{{$context->name}}</option>
                                            @endforeach
                                            @isset($list->id)
                                            <option value="0" <?php if ($list->id == $list->parent_id){ echo "selected"; }?>>Root</option>
                                            @endisset
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="route">Product Categories</label>
                                        <select class="multiple-select" name='categories[]'
                                                data-placeholder="Choose anything">
                                            <option value="">-Select Category-</option>
                                            @foreach($categories as $b=>$category)$categoryId
                                            <option
                                                value="{{$category->id}}" {{ (in_array($category->id, getArray($categoryId,'category_id'))) ? 'selected': '' }}>{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="route">Search Categories</label>
                                        <select class="multiple-select" name='searchCategories[]'
                                                data-placeholder="Choose anything" multiple>
                                            <option value="">-Select Categories-</option>
                                            @foreach($searchCategories as $c=>$searchCategory)
                                                <option
                                                    value="{{$searchCategory->id}}" {{ (in_array($searchCategory->id, getArray($searchcategoryId,'search_category_id'))) ? 'selected': '' }} >{{$searchCategory->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <hr class="mb-3">
                            <a href='{{url("admin/pages")}}' class="btn btn-light btn-sm mr-1">Back </a>
                            @if(isset($list->id))
                                <button class="btn btn-primary btn-sm"> Save</button>
                                <button class="btn btn-primary btn-sm"> Save and edit</button>

                            @else
                                <button class="btn btn-primary btn-sm"> Add new page</button>

                            @endif
                        </form>
                    </div>
                </div>


            </div>
        </div>
    </main>
@endsection
@section('js')
    <script src="<?= phpb_asset('websitemanager/app.js') ?>"></script>
    <script>
        $(document).ready(function () {
            $('.guide1').click(function () {
                if ($('.guide1').is(':checked')) {
                    $('.hidden').removeClass('d-none');

                }
            });
            $('.guide2').click(function () {
                if ($('.guide2').is(':checked')) {
                    $('.hidden').addClass('d-none');
                    $('#basic-addon2').val('');
                    $('#prefix').val('');
                    $('#basic-addon2').html('');
                }
            });
        });

    </script>


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

        function getArea(id) {
            $('#basic-addon2').html('/service-support');
        }
    </script>
@endsection
