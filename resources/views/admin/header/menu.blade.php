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
    <!--start content-->
    <main class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3"><a href="{{route('adminHome')}}"><i class="bx bx-home-alt"></i></a></div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">Content</li>
                        <li class="breadcrumb-item active" aria-current="page">Dynamic Header</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-header py-3">
                <h6 class="mb-0">Add Menu</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-lg-4 d-flex">
                        <div class="card border shadow-none w-100">
                            <div class="card-body">
                                <form class="row g-3" action="{{route('submit_menus')}}" method="post"
                                      enctype="multipart/form-data">

                                    @csrf
                                    <div class="col-12">
                                        <label class="form-label">Name</label>
                                        <input type="text" name="name" class="form-control" placeholder="Menu name"
                                               required>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Url</label>
                                        <input type="text" name="url" class="form-control" placeholder="/example"
                                               onkeyup="this.value=RWS(this.value)" required>
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Status</label>
                                        <select name="status" class="form-control" required>
                                            <option value="">Select Status</option>
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                            0 </select>
                                    </div>

                                    <div class="col-12">
                                        <div class="d-grid">
                                            <button class="btn btn-primary">Add Menu</button>
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
                                <!--table class="table align-middle ecommerce-products-categories">
                                        @if(isset($menus))
                                    <thead class="table-light">
                                    <tr>

                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
@else
                                    <thead class="table-light">
                                    <tr>
                                        <th>No menus to show</th>
                                    </tr>
                                    </thead>
@endif

                                    <tbody>
@if(isset($menus))
                                    @foreach($menus as $key => $menu)
                                        <tr>

                                            <td>#{{$menu->id}}</td>
                                                    <td>{{$menu->name}}</td>
                                                    <td>@if($menu->status ==1) Active @else Inactive @endif</td>
                                                    <td>
                                                        <div class="d-flex align-items-center gap-3 fs-6">
                                                         <a href="{{route('submenus.listing', $menu->id)}}" class="text-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="View {{$menu->name}}" aria-label="Views">
                                                    <img src="{{asset('admin-assets/images/view.png')}}" alt="">
                                                    </a>

                                                            <a href="{{route('edit_menu', $menu->id)}}" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Edit {{$menu->name}}" aria-label="Edit">
                                                                <img src="{{asset('admin-assets/images/edit.png')}}" alt="">
                                                            </a>
                                                            <a href="{{route('delete_menu', $menu->id)}}" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Delete {{$menu->name}}" aria-label="Delete">
                                                                <img src="{{asset('admin-assets/images/delete.png')}}" alt="">
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                @endif
                                    </tbody>
                                </table-->

                                    <!------ Tree view  ------->

                                    <div class="custom-container">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <ul id="tree1">
                                                    @if(isset($menus))
                                                        @foreach($menus as $key => $menu)
                                                            <!-- Modal HTML -->
                                                                <div id="delModal{{$menu->id}}" class="modal fade ">
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
                                                                                <button type="button" class="btn btn-danger" onclick=" window.location.href='{{route('delete_menu', $menu->id)}}'">Delete</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <li><b>{{$menu->name}}</b> <span><a
                                                                        href="{{route('submenus.listing', $menu->id)}}"><i
                                                                            class="bx bxs-plus-square"
                                                                            title="Add Sub Menu"></i></a>   <a
                                                                        href="{{route('edit_menu', $menu->id)}}"
                                                                        title="Edit Menu"><i class="bx bx-edit"></i></a>
                                                                    <a href="#delModal{{$menu->id}}" data-toggle="modal"
                                                                        title="Delete Menu"><i class="bx bx-trash"></i></a></span>
                                                                @if(sizeof(getSubMenu($menu->id))>0)
                                                                    <ul>
                                                                        @foreach(getSubMenu($menu->id) as $submenu)
                                                                            <li>{{$submenu->name}} <span>  <a
                                                                                        href="{{route('edit_submenu', $submenu->id)}}"
                                                                                        title="Edit Sub Menu"><i
                                                                                            class="bx bx-edit"></i></a>
                                                                                    <a  href="#delSubMenuModal{{$submenu->id}}" data-toggle="modal"
                                                                                        title="Delete Sub Menu"><i class="bx bx-trash"></i></a></span>
                                                                                <!-- Modal HTML -->
                                                                                <div id="delSubMenuModal{{$submenu->id}}" class="modal fade ">
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
                                                                                                <button type="button" class="btn btn-danger" onclick=" window.location.href='{{route('delete_submenu',[ $submenu->id, $submenu->menu_id])}}'">Delete</button>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                @endif
                                                            </li>
                                                        @endforeach
                                                    @endif
                                                </ul>
                                            </div>

                                        </div>
                                    </div>

                                    <!------ End Tree view  ------->


                                </div>
                                <div class="d-flex">
                                    <div class="mx-auto">
                                        {{--                                        {{ $categories->links('pagination::bootstrap-4') }}--}}
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
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
@endsection
