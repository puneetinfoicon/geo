@extends('layout.master')
@section('title', 'Add Page')
@section('content')

<section class="search-section">
    <style>
        #pre-loader {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #fff;
            z-index: 999999;
        }

        .pre-loader {
            width: 50px;
            height: 50px;
            display: inline-block;
            padding: 0px;
            text-align: left;
            box-sizing: border-box;
            position: absolute;
            top: 50%;
            left: 50%;
            margin-left: -25px;
            margin-top: -25px;
        }

        .pre-loader span {
            position: absolute;
            display: inline-block;
            width: 50px;
            height: 50px;
            border-radius: 100%;
            background: #ccc;
            animation: pre-loader 1.3s linear infinite;
            -webkit-animation: pre-loader 1.3s linear infinite;
        }

        .pre-loader span:last-child {
            animation-delay: -0.8s;
            -webkit-animation-delay: -0.8s;
        }

        @keyframes pre-loader {
            0% {
                transform: scale(0, 0);
                opacity: 0.5;
            }

            100% {
                transform: scale(1, 1);
                opacity: 0;
            }
        }

        @-webkit-keyframes pre-loader {
            0% {
                -webkit-transform: scale(0, 0);
                opacity: 0.5;
            }

            100% {
                -webkit-transform: scale(1, 1);
                opacity: 0;
            }
        }
    </style>

    <!-- preloader area start -->
    <div id="pre-loader" style="display: none">
        <div class="pre-loader">
            <span></span>
            <span></span>
        </div>
    </div>
    <!-- preloader area end -->
    <div class="product-sec produkter-section">
        <div class="container-fluid">
            <div class="product-heading">
                <ul>
                    <li><a href="javascript:void(0);">Søgning</a></li>
                    <li><a href="javascript:void(0);"><img src="assets/img/icon/Arrow-left.svg"></a></li>
                    <li>GPS</li>
                </ul>

                <h1>Søgeresultater</h1>
            </div>

            <div class="searching">
                <div class="row">
                    <div class="col-md-3">
                        <div class="searching_filter">
                            @if(count($areas)>0)
                            @foreach($areas as $key=>$area)
                            <div class="custom-checkbox">
                                <div class="form-group withCloseImg">
                                    <div class="form-group-left">
                                        <input type="checkbox" id="selectall{{$key}}" value="{{$area->id}}" onchange="getallData('{{$key}}')">
                                        <label for="selectall{{$key}}">{{$area->name}}
                                            ({{sizeof($area->products->where('status', '1'))}})</label>
                                    </div>

                                    <div class="form-group-right">
                                        <a href="javascript:;" class="closeAll">
                                            <img src="assets/img/select-arrow.png" alt="" class="img-fluid">
                                        </a>
                                    </div>
                                </div>


                                <div class="select_all">
                                    @if(count($categories)>0)
                                    @foreach($categories as $k=>$category)
                                    <div class="form-group">
                                        <input type="checkbox" id="ch{{$key}}{{$k}}" data-id="{{$area->id}}" value="{{$category->id}}" class="checkB selectedId{{$key}}" onchange="getallData('{{$key}}')">
                                        <label for="ch{{$key}}{{$k}}">{{$category->name}}
                                            ({{(isset($categoryProductCount[$area->id][$category->id]))?$categoryProductCount[$area->id][$category->id]:0 }})</label>
                                    </div>
                                    @endforeach
                                    @endif
                                </div>
                            </div>
                            <script>
                                $('#selectall{{$key}}').click(function() {
                                    $('.selectedId{{$key}}').prop('checked', this.checked);
                                });
                                $('.selectedId{{$key}}').change(function() {
                                    var check = ($('.selectedId{{$key}}').filter(":checked").length == $('.selectedId{{$key}}').length);
                                    $('#selectall{{$key}}').prop("checked", check);
                                });
                            </script>
                            @endforeach
                            @endif

                            <div class="custom-checkbox">
                                <div class="form-group withCloseImg">
                                    <div class="form-group-left">
                                        <input type="checkbox" id="selectalla4" onchange="getallData()">
                                        <label for="selectalla4">Vejledninger ({{sizeof(getCustomContentCount())}})</label>
                                    </div>

                                    <div class="form-group-right">
                                        <a href="javascript:;" class="closeAll">
                                            <img src="assets/img/select-arrow.png" alt="" class="img-fluid">
                                        </a>
                                    </div>
                                </div>

                                <div class="select_all">
                                    <?php $cnt = 0?>
                                    @foreach($areas as $key=>$area)
                                            <?php $cnt++;
                                           // echo "<pre>"; print_r($area->contexts->count()); echo "</pre>";
                                            ?>
                                    <div class="form-group">
                                        <input type="checkbox" id="cha{{$cnt}}" class="selecteddId4" data-id="{{$area->id}}" value="{{$area->id}}" onchange="getallData()">
                                        <label for="cha{{$cnt}}">{{$area->name}} ({{sizeof(areaContent($area->id))}})</label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <script>
                                $('#selectalla4').click(function() {
                                    $('.selecteddId4').prop('checked', this.checked);
                                });
                                $('.selecteddId4').change(function() {
                                    var check = ($('.selecteddId4').filter(":checked").length == $('.selecteddId4').length);
                                    $('#selectalla4').prop("checked", check);
                                });
                            </script>

                        </div>
                    </div>

                    <div class="col-md-9">
                        <div class="searching_result">

                            <div class="searching_result_filter">
                               {{-- <h3>Produkter <span id="countProduct"></span></h3>--}}
<h3></h3>
                                <div class="custom-select-2">
                                    <select name="sort" id="sort">
                                        <option value="1">Sortér efter</option>
                                        <option value="2">Alfabetisk</option>
                                        <option value="3">Produktnummer</option>
                                        {{-- <option value="4">Pris</option> --}}
                                    </select>
                                </div>

                            </div>

                            <div class="search_result">
                                <div class="se_loader">
                                    <div class="lds-spinner">
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                    </div>
                                </div>

                                <div id="search_result"></div>
                            </div>

                            <div id="pagination"></div>
                            <div class="searching_result_filter">
                                <h3>Vejledninger </h3>
                            </div>
                            <div id="searchContent"></div>

                            <div class="searching_result_filter">
                                <h3>Pages </h3>
                            </div>
                            <div id="pageContent"></div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
@section('js')
    <script>
        getallData();
    </script>
    @endsection
