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
                        <li class="breadcrumb-item active" aria-current="page">Edit Social Media Links</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-header py-3">
                <h6 class="mb-0">Edit Social Media Link</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-lg-4 d-flex">
                        <div class="card border shadow-none w-100">
                            <div class="card-body">
                                <form class="row g-3" action="{{route('update_social',$default->id)}}" method="post"
                                      enctype="multipart/form-data">

                                    @csrf
                                    <div class="col-12">
                                        <label class="form-label" >Area <span>*</span></label>
                                        <select name="area" class="form-control multiple-select" data-placeholder="Choose anything" required>
                                            <option value="">Select Area</option>
                                            <option value="0" @if($default->id ==0) selected @endif>Default</option>
{{--                                            @if(sizeof($areas)>0)--}}
{{--                                                @foreach($areas as $area)--}}
{{--                                                    <option value="{{$area->id}}" @if($default->area_id ==$area->id) selected @endif>{{$area->name}}</option>--}}
{{--                                                @endforeach--}}
{{--                                            @endif--}}
                                        </select>
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">LinkedIn Url</label>
                                        <input type="text" name="linkedin" class="form-control" value="{{$default->linkedin}}" placeholder="LinkedIn Url" >
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Facebook Url</label>
                                        <input type="text" name="facebook" class="form-control" value="{{$default->facebook}}"  placeholder="Facebook Url"  >
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Youtube Url</label>
                                        <input type="text" name="youtube" class="form-control" value="{{$default->youtube}}"  placeholder="Youtube Url"  >
                                    </div>

                                    <div class="col-12">
                                        <div class="d-grid">
                                            <button class="btn btn-primary">Update Url</button>
                                        </div>
                                    </div>
                                </form>
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
    </script>
@endsection
