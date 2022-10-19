@extends('admin.layout.master')
@section('title', 'Add Page')
@section('content')
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <style>
        td a{
            margin: 5px;
        }
        /****** Model Box CSS *******/
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
        <div class="page-breadcrumb mb-3 d-flex justify-content-between">
            <div class=" d-none d-sm-flex align-items-center">
                <div class="breadcrumb-title pe-3"><a href="{{route('adminHome')}}"><i class="bx bx-home-alt"></i></a></div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item">Products</li>
                            <li class="breadcrumb-item active" aria-current="page">Products List</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="right-btn"><a href="{{route('add-variant')}}" class="btn btn-primary">ADD Variant</a></div>
        </div>
        <!--end breadcrumb-->

        <div class="card">
        <!-- <div class="card-header py-3">
                  <div class="row align-items-center m-0">
                    <div class="col-md-3 col-12 me-auto mb-md-0 mb-3">
                        <select class="form-select">

                            <option value = "All Categories" disabled selected>All Categories</option>
                            @php
            $categories = getAllCategories1();
        @endphp

        @if(sizeof($categories) > 0)
            @foreach($categories as $category)
                <option value = "{{$category->id}}">{{$category->name}}</option>
                                @endforeach
        @endif
            </select>
        </div>
        <div class="col-md-2 col-6">
            <select class="form-select">
                <option selected disabled>Show all</option>
                <option value = "1">Active</option>
                <option value = "2">Disabled</option>
            </select>
        </div>
     </div>
    </div> -->
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-striped table-bordered nowrap" width="100%" id="example">
                        <thead class="table-light">
                        <tr>
                            <th>Sno</th>
                            <th style="max-width: 100px">Product Number</th>
                            <th style="max-width: 120px">Product Name</th>
                            <!-- <th>Amount</th> -->
                            <th>Status</th>
                             <th>Type</th>
                            <th>Created Date</th>
                            <th>Last Updated Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(sizeof($products) > 0)
                            @foreach($products as $product)
                                @php
                                    //$image = $product->imagess[0]->url;
                                    $image = '';
                                    $count++;
                                @endphp
                                <tr>

                                    <td class="productlist">
                                        <div>
                                            <h6 class="mb-0 product-title">{{$count}}</h6>
                                        </div>
                                    </td>
                                    <td class="productlist">
                                        <div>
                                            <h6 class="mb-0 product-title">{{$product->api_id}}</h6>
                                        </div>
                                    </td>

                                    <td class="productlist">
                                        <div>
                                            <h6 class="mb-0 product-title">{{$product->api_name}}</h6>
                                        </div>
                                    </td>
                                <!-- <td class="productlist">
                                         <a class="d-flex align-items-center gap-2" href="#">
                                          <div class="product-box">
                                              <img src='{{ asset("$image") }}' width="100" height="100">
                                          </div>
                                        </a>
                                    </td> -->
                                    <td><span
                                            class="badge rounded-pill alert-success">{{($product->status == 1)?'Active': 'Inactive'}}</span>
                                    </td>
                                    <td>@if($product->is_subscription == '1' AND $product->type == 'GPSNetSubscription') Variant
                                        @elseif($product->is_subscription == '0' AND $product->type == 'GPSNetSubscription') Subscription
                                        @elseif($product->is_subscription == '1' AND $product->type == 'Subscription') Subscription
                                        @elseif( $product->type == 'Hotline') Hotline
                                        @elseif( $product->type == 'ServiceAgreement') ServiceAgreement
                                        @elseif( $product->type == 'ExtendedWarranty') ExtendedWarranty
                                        @elseif( $product->type == 'SIM') SIM
                                        @else Physical @endif
                                    </td>
                                    <td><span>{{date('Y-m-d', strtotime($product->created_at))}}</span></td>
                                    <td><span>{{date('Y-m-d', strtotime($product->updated_at))}}</span></td>
                                    <td>
{{--                                        <div class="d-flex align-items-center gap-3 fs-6">--}}
                                            <a href="{{route('produkt', ['null',$product->id, $product->api_name])}}"
                                               target="_blank" class="text-primary" data-bs-toggle="tooltip"
                                               data-bs-placement="bottom" title=""
                                               data-bs-original-title="View {{$product->api_name}}" aria-label="Views">
                                                <img src="{{asset('admin-assets/images/view.png')}}" alt="" width="30px">
                                            </a>
                                            <a href="{{route('editProducts', $product->id)}}" class="text-warning"
                                               data-bs-toggle="tooltip" data-bs-placement="bottom" title=""
                                               data-bs-original-title="Edit {{$product->api_name}}" aria-label="Views" >
                                                <img src="{{asset('admin-assets/images/edit.png')}}" alt=""width="30px">

                                            </a>
                                           {{-- <a href="#delModal{{$product->id}}" class="text-danger"  data-toggle="modal"
                                               data-bs-toggle="tooltip" data-bs-placement="bottom" title=""
                                               data-bs-original-title="Delete {{$product->api_name}}" aria-label="Edit">
                                                <img src="{{asset('admin-assets/images/delete.png')}}" alt="" width="30px">
                                            </a>--}}
{{--                                        </div>--}}
                                    </td>
                                </tr>

                                <!-- Modal HTML -->
                                <div id="delModal{{$product->id}}" class="modal fade ">
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
                                                <button type="button" class="btn btn-danger" onclick=" window.location.href='{{route('deleteProduct', $product->id)}}'">Delete</button>
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
                        {{--          {{ $products->links('pagination::bootstrap-4') }}--}}
                    </div>
                </div>

            </div>
        </div>

    </main>
    <!--end page main-->

@endsection
@section('js')
    <script>
        $(document).ready(function () {
            var table = $('#example').DataTable({
                responsive: true,
            });

            new $.fn.dataTable.FixedHeader(table);
        });
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
@endsection
