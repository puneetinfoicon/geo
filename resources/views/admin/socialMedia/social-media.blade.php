@extends('admin.layout.master')
@section('title', 'Add Page')
@section('content')
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
        .form-label span{
            color: red;
            font-weight: bold;
            font-size: 16px;
        }
        ul li button i {
            font-size: 25px;
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
                        <li class="breadcrumb-item"><a href="{{route('dynamicPages')}}">Dynamic Content List</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Add Social Media Links</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-header py-3">
                <h6 class="mb-0">Add Social Media Link</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-lg-4 d-flex d-none">
                        <div class="card border shadow-none w-100">
                            <div class="card-body">
                                <form class="row g-3" action="{{route('submit_social')}}" method="post"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-12">
                                        <label class="form-label" >Area <span>*</span></label>
                                        <select name="area" class="form-control multiple-select" data-placeholder="Choose anything" required>
                                            <option value="">Select Area</option>
                                            @if(sizeof($areas)>0)
                                                @foreach($areas as $area)
                                                  <option value="{{$area->id}}">{{$area->name}}</option>
                                                @endforeach
                                           @endif
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">LinkedIn Url</label>
                                        <input type="text" name="linkedin" class="form-control" value="{{old('linkedin')}}" placeholder="LinkedIn Url" >
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Facebook Url</label>
                                        <input type="text" name="facebook" class="form-control" value="{{old('facebook')}}"  placeholder="Facebook Url"  >
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Youtube Url</label>
                                        <input type="text" name="youtube" class="form-control" value="{{old('youtube')}}"  placeholder="Youtube Url"  >
                                    </div>
                                    <div class="col-12">
                                        <div class="d-grid">
                                            <button class="btn btn-primary">Add Url</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-8 d-flex">
                        <div class="card border shadow-none w-100">
                            <div class="card-body">
                                <div>
                                    <!------ Tree view  ------->
                                    <div class="custom-container">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <ul id="tree1">
{{--                                                    @if(sizeof($areas)>0)--}}
{{--                                                       @foreach($areas as $areaTree)--}}
{{--                                                            <li><b>{{$areaTree->name}}</b><span><a href="{{route('edit_social', getSocialId($areaTree->id)->id)}}" title="Edit Url"><i class="bx bx-edit"></i></a></span>--}}
{{--                                                                @if(sizeof(getSocial($areaTree->id))>0)--}}
{{--                                                                    <ul>--}}
{{--                                                                        @foreach(getSocial($areaTree->id) as $social)--}}
{{--                                                                            @if($social->linkedin)<li> <button class="btn"><i class="bx bxl-linkedin-square"></i></button> {{$social->linkedin}}</li> @endif--}}
{{--                                                                            @if($social->facebook)<li><button class="btn"><i class="bx bxl-facebook-square"></i></button> {{$social->facebook}}</li> @endif--}}
{{--                                                                            @if($social->youtube)<li><li> <button class="btn"><i class="bx bxl-youtube"></i></button> {{$social->youtube}}</li> @endif--}}
{{--                                                                        @endforeach--}}
{{--                                                                    </ul>--}}
{{--                                                                @endif--}}
{{--                                                            </li>--}}
{{--                                                        @endforeach--}}
{{--                                                    @endif--}}
                                                        <li><b>Default</b><span><a href="{{route('edit_social', $default->id)}}" title="Edit Url"><i class="bx bx-edit"></i></a></span>
                                                            <ul>
                                                                @if($default->linkedin)<li> <button class="btn"><i class="bx bxl-linkedin-square"></i></button> {{$default->linkedin}}</li> @endif
                                                                @if($default->facebook)<li><button class="btn"><i class="bx bxl-facebook-square"></i></button> {{$default->facebook}}</li> @endif
                                                                @if($default->youtube)<li><li> <button class="btn"><i class="bx bxl-youtube"></i></button> {{$default->youtube}}</li> @endif
                                                            </ul>
                                                        </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!------ End Tree view  ------->
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

    <script language="JavaScript">
        function RWS(str) {

            if (!str.match(/[^a-zA-Z ]/)) {
                str = str.replace(/[^a-zA-Z ]/g, '').replace(/\s+$/, "").replace(/\s+/g, " ");
            }

            return str.replace(/^\s+/, "").replace(/\s+$/, "").replace(/\s+/g, " ");

            str.replace(/[_\W]+/g, "");
        }


        $.fn.extend({
            treed: function (o) {

                var openedClass = 'bxs-minus-circle';
                var closedClass = 'bx-plus-circle';
                var bulletClass = 'bx-circle';

                if (typeof o != 'undefined') {
                    if (typeof o.openedClass != 'undefined') {
                        openedClass = o.openedClass;
                    }
                    if (typeof o.closedClass != 'undefined') {
                        closedClass = o.closedClass;
                    }
                }
                ;

                //initialize each of the top levels
                var tree = $(this);
                tree.addClass("tree");
                tree.find('li').has("ul").each(function () {
                    var branch = $(this); //li with children ul
                    // console.log(branch);
                    branch.prepend("<i class='indicator bx " + closedClass + "'></i>");
                    branch.addClass('branch');
                    branch.on('click', function (e) {
                        if (this == e.target) {
                            var icon = $(this).children('i:first');
                            icon.toggleClass(openedClass + " " + closedClass);
                            $(this).children().children().toggle();
                        }
                    })
                    branch.children().children().toggle();
                });
                //fire event from the dynamically added icon
                tree.find('.branch .indicator').each(function () {
                    $(this).on('click', function () {
                        $(this).closest('li').click();
                    });
                });
                //fire event to open branch if the li contains an anchor instead of text
                tree.find('.branch>a').each(function () {
                    $(this).on('click', function (e) {
                        $(this).closest('li').click();
                        e.preventDefault();
                    });
                });
                //fire event to open branch if the li contains a button instead of text
                tree.find('.branch>button').each(function () {
                    $(this).on('click', function (e) {
                        $(this).closest('li').click();
                        e.preventDefault();
                    });
                });
            }
        });

        //Initialization of treeviews

        $('#tree1').treed();

        $('#tree2').treed({openedClass: 'glyphicon-folder-open', closedClass: 'glyphicon-folder-close'});

        $('#tree3').treed({openedClass: 'glyphicon-chevron-right', closedClass: 'glyphicon-chevron-down'});

    </script>
@endsection
