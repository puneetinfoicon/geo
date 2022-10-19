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
        .radioDiv{
            display: flex;
        }
        .form-check {
            display: block;
            min-height: 1.5rem;
            padding-left: 2.5em !important;
            margin-bottom: 0.125rem;
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
                            <li class="breadcrumb-item">Sim Products</li>
                            <li class="breadcrumb-item active" aria-current="page">Sim Products List</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered nowrap" width="100%" id="example">
                        <thead class="table-light">
                        <tr>
                            <th>Sno</th>
                            <th>Sim Product Number</th>
                            <th>Sim Product Name</th>
                            <th>Status</th>
                            <th>Ask SIMno / Spørg om SIMno</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>1</td>
                            <td>--</td>
                            <td>{{$custom->simkort}}</td>
                            <td>
                                <div class="radioDiv">
                                    <div class="form-check">
                                        <input class="form-check-input getRadio" type="radio" name="static" id="Radios<?= $rand = rand(1111,9999)?>" value="1" {{ ($custom->status ==1)? 'checked': '' }}>
                                        <label class="form-check-label" for="Radios<?= $rand?>">
                                            Enable
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input getRadio" type="radio" name="static" id="Radios<?= $rand1 = rand(1111,9999)?>" value="0" {{ ($custom->status ==0)? 'checked': '' }}>
                                        <label class="form-check-label" for="Radios<?= $rand1?>">
                                            Disable
                                        </label>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input getCheckbox" type="checkbox" id="inlineCheckbox0" name="static" value="1" {{ ($custom->ask_sim ==1)? 'checked': '' }}>
                                    <label class="form-check-label" for="inlineCheckbox0"></label>
                                </div>
                            </td>
                        </tr>
                        @php
                        $count = 2;
                        @endphp
                        @if(sizeof($products) > 0)
                            @foreach($products as $product)
                            <tr>
                                <td>{{$count++}}</td>
                                <td>{{$product->api_id}}</td>
                                <td>{{$product->api_name}}</td>
                                <td>
                                   <div class="radioDiv">
                                       <div class="form-check">
                                           <input class="form-check-input getRadio"  type="radio" name="{{$product->api_id}}" id="Radios<?= $rand = rand(1111,9999)?>" value="1" {{ ($product->status ==1)? 'checked': '' }}>
                                           <label class="form-check-label" for="Radios<?= $rand?>">
                                               Enable
                                           </label>
                                       </div>
                                       <div class="form-check">
                                           <input class="form-check-input getRadio" type="radio" name="{{$product->api_id}}" id="Radios<?= $rand1 = rand(1111,9999)?>" value="0"{{ ($product->status ==0)? 'checked': '' }}>
                                           <label class="form-check-label" for="Radios<?= $rand1?>">
                                               Disable
                                           </label>
                                       </div>
                                   </div>

                                </td>
                                <td>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input getCheckbox" type="checkbox" id="inlineCheckbox{{$product->id}}" name="{{$product->api_id}}" value="1" {{ ($product->ask_sim ==1)? 'checked': '' }}>
                                        <label class="form-check-label" for="inlineCheckbox{{$product->id}}"></label>
                                    </div>
                                </td>
                            </tr>

                            @endforeach
                        @endif
                        </tbody>
                    </table>
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

            $('.getRadio').click(function (){
                var status = $(this).val();
                var api_id = $(this).attr('name');
                $.ajax({
                    type: "GET",
                    url: "{{route('productStatus')}}",
                    data: "status=" + status + "&api_id=" + api_id,
                    success: function (data) {
                        alert('product has successfully updated.');
                    }
                });
            });

            $('.getCheckbox').click(function (){
                if ($(this).prop('checked')==true){
                   var ask_sim = 1;
                }else{
                    var ask_sim = 0;
                }
                var api_id = $(this).attr('name');
                $.ajax({
                    type: "GET",
                    url: "{{route('productAskSim')}}",
                    data: "ask_sim=" + ask_sim + "&api_id=" + api_id,
                    success: function (data) {
                        alert('product has successfully updated.')
                    }
                });
            })
        });

    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
@endsection
