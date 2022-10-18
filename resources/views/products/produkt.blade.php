@extends('layout.master')
@section('title', 'Add Page')
@section('content')
    <style>
        #pre-loader {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #fcfefc;
            z-index: 999999;
        }

        .pre-loader {
            padding: 0px;
            text-align: left;
            box-sizing: border-box;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
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
    <style>
        .select-items {
            max-height: 210px;
            overflow: hidden;
            overflow-y: auto;
        }

        .pos-rel.custom-select-2 .select-items div {
            font-size: 15px;
            padding: 10px;
        }

        .pos-rel.custom-select-2 .select-items div:hover {
            font-size: 15px;
            padding-right: 0;
            background-color: var(--main);
            color: #FFFFFF;
            padding: 10px;
        }



    </style>
    <!-- preloader area start -->
    <div id="pre-loader" class="d-none">
        <div class="pre-loader">
            <img src="https://c.tenor.com/8BeuRyZSb90AAAAC/shopping-cart-shopping.gif" style="margin: 0px auto;">
        </div>
    </div>
    <!-- preloader area end -->
    <section>
        <div class="product-sec produkter-section produkt-type produkt">
            <div class="container-fluid">
                <div class="product-heading">
                    <ul>
                        <li><a href="{{url('search-produkt')}}">Produkter</a></li>
                        <li><a href="javascript:void(0);"><img src="{{ asset('public/assets/img/icon/Arrow-left.svg') }}"></a>
                        </li>
                        @isset($areaName)
                            <li><a href="{{url('produktkategori',$areaId)}}">{{$areaName}}</a></li>
                            <li><a href="javascript:void(0);"><img src="{{ asset('public/assets/img/icon/Arrow-left.svg') }}"></a>
                            </li>
                            @endisset
                            {{--                        <li><a href="javascript:void(0);">GPS</a></li>--}}
                            {{--                        <li><a href="javascript:void(0);"><img src="{{ asset('public/assets/img/icon/Arrow-left.svg') }}"></a>--}}
                            </li>
                                <li><?= $productDetails->api_name?></li>
                    </ul>
                </div>
                <div class="row">

                    <div class="col-md-5">
                        <div class="product-zoom-slide">
                            <div class="img-products">

                                <div class="owl-carousel owl-theme big" id="big">
                                    <?php

                                    if(count($productDetails->imagess) > 0){

                                    foreach($productDetails->imagess as  $key=>$details){ ?>
                                        @if($details->type == 'jpeg' || $details->type == 'png' || $details->type == 'jpg' || $details->type == 'gif' || $details->type == 'svg'|| $details->type == 'image' )
                                        <div class="item">
                                            <img data-target="#myImgShow" data-toggle="modal" alt=""
                                                 class="img-responsive" data-lightbox="gallery"
                                                 src="{{ asset('public/'.$details->url) }}"  title="{{$details->title_image}}" alt="{{$details->alt_image}}"/>
                                        </div>
                                    @else
                                    <!-- Video start -->
                                        <div class="item item-video">
                                            <img data-target="#myImgShow" data-toggle="modal" alt=""
                                                 class="img-responsive" data-lightbox="gallery"
                                                 src="{{ asset('assets/img/no-image.png') }}"/>
                                            <video autoplay muted controls>
                                                <source src="{{ asset(''.$details->url) }}" type="video/mp4" title="{{$details->title_image}}" alt="{{$details->alt_image}}">
                                            </video>
                                        </div>
                                        <!-- Video end -->
                                    @endif

                                    <?php }}else{ ?>
                                    <div class="item">
                                        <img data-target="#myImgShow" data-toggle="modal" alt=""
                                             class="img-responsive" data-lightbox="gallery"
                                             src="{{ asset('assets/img/no-image.png') }}"/>
                                    </div>
                                    <?php
                                    }

                                    ?>
                                </div>
                                <div class="dummy-text d-none">
                                    <p>Flatrate</p>
                                </div>
                                <div class="owl-carousel owl-theme" id="thumbs">

                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-7">
                        <?php
                        if($productDetails->is_subscription == 1){ ?>
                        <div class="product-details-box">
                            <div class="see_loader" id="se_loader" style="display: none;">
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
                                    <div></div>
                                </div>
                            </div>

                            <h3>{{$productDetails->api_name}}</h3>
                            <h1><b><?= $productDetails->short_text; ?></b></h1>
                            @if($productDetails->is_subscription == 1)
                            <ul class="day-dag labelWidth200">
                                    @if(sizeof(getVariants($productDetails->id))>0)
                                        @foreach(getVariants($productDetails->id) as $vr=>$variants)
                                        <li>
                                            <input type="radio" id="{{$variants->product_id}}" value="{{$variants->product_id}}" name="variantProduct" class="@if($vr == 0) firstLi @endif variantItem selector-item_radio" @if($vr == 0) checked @endif>
                                            <label for="{{$variants->product_id}}" class="selector-item_label">{{$variants->label_name}}</label>
                                        </li>
                                        @endforeach
                                    @endif
                            </ul>
                            @endif

                            <div class="product-desc w-405">
                                <div class="form-sec">
                                    <div class="form-group kundeor mySelect">
                                        <label for="kund"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Vælg simkort</font></font></label>
                                        <div class="pos-rel custom-select-2 product myCustomSelect"></div>
                                        <span class="sim-selection"></span>
                                    </div>
                                    <div class="form-group d-none">
                                        <label for="crv"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Possible SIM card number</font></font></label>
                                        <div class="pos-rel">
                                            <input type="text" name="crv" id="crv" class="form-control" placeholder="Possible SIM card number">
                                        </div>
                                    </div>
                                    <div class="d-none myText" id="productInput">
                                            <div class="form-group kundeor">
                                                <label for="kund">SIM-kortnummer</label>
                                                <div class="pos-rel">
                                                    <input type="text" name="simNumber" id="simNumber"  class="form-control" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" placeholder="SIM-kortnummer" autocomplete="off" minlength="11" maxlength="20">
                                                    <span class="error"></span>
                                                </div>
                                            </div>
                                    </div>

                                </div>
                                <div class="date-input">
                                    <label for="date">Ønsket startdato for abonnement</label>
                                    <input type="date" name="date" id="date" class="date">
                                    <span class="dtt"></span>
                                </div>
                            </div>

                            <div class="product-price">
                                @if($productDetails->hide_amount !=1)
                                    <h4 id="apiPrice"></h4> @else <h4> Ring for enpris </h4>
                                @endif
                                    <div class="ApiMsg"></div>
                                 <!--p> ekskl. moms pr. år</p-->
                                <div class="product__btn">
                                    <button class="price-btn {{$productDetails->id}}" onclick="addCartSubscription()" id="{{$productDetails->api_id}}">Læg i kurv</button>
                                    <h5><span class="green APIColor d-none"></span></h5> <b><span class="APIClass"></span></b>
                                    @if($productDetails->is_subscription != 1)  <h5>@if(  is_array($productDetails->price)) <span class="green" style="background-color:{{$productDetails->price[0]->availability->color}} "></span> {{$productDetails->price[0]->availability->text}} @endif
                                    </h5> @endif

                                </div>
                            </div>
                        </div>

                        <?php }else{ ?>

                        <div class="product-details-box">
                            <h3><?= $productDetails->api_name?></h3>
                            <h1><b><?= $productDetails->short_text?></b></h1>
                            <h5><b><?= $productDetails->api_id?></b></h5>
                            <div class="product-desc">
                                <p><?= $productDetails->description?></p>
                            </div>
                            <div class="qty-input">
                                <label for="antal">Antal</label>
                                <input type="number" name="antal" id="antal" value="1">
                            </div>

                            <div class="product-price">
                                @php
                                    //dd($productDetails->price);
                                    if ( is_array($productDetails->price)){
                                        $pDetails = $productDetails->price[0];
                                        echo "<span class='unitPrice d-none'>".$pDetails->unitPrice."</span>";
                                        echo "<span class='sellPrice d-none'>".$pDetails->basePrice."</span>";
                                        echo "<span class='productType d-none'>".$productDetails->type."</span>";
                                    }
                                @endphp
                                @if($productDetails->hide_amount !=1)
                                    <h4>@if(  is_array($productDetails->price)) {{str_replace(",",".",number_format($pDetails->basePrice))}}
                                        kr. ekskl. moms</h4> <div>Ekskl. klargøring, kalibrering og oplæring</div> @else <h4>Ring for en pris </h4>@endif  @else <h4> Ring for en
                                    pris </h4> @endif
                            <!--p> ekskl. moms pr. år</p-->
                                <div class="product__btn">
                                    <button class="price-btn {{$productDetails->id}}" onclick="addCart('{{$productDetails->id}}')"  id="{{$productDetails->api_id}}">Læg i kurv
                                    </button>
                                    <h5>@if(  is_array($productDetails->price)) <span class="green"
                                                                                      style="background-color:{{$pDetails->availability->color}} "></span> {{$pDetails->availability->text}} @endif
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ============Model COde Start============= -->
    <div class="modal fade" id="myImgShow" role="dialog" style="z-index: 9999999">
        <div class="modal-dialog  modal-imgshow modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="close" data-dismiss="modal">
                        <img alt="" class="img-responsive" src="{{url('public/')}}/assets/img/close-pop.png"
                             style="height: auto !important;">
                    </div>
                    <div class="owl-carousel owl-theme big" id="big-popup" id="">
                        @if(!empty($productDetails->imagess))
                            @foreach($productDetails->imagess as  $key=>$details)
                                @if($details->type == 'jpeg' || $details->type == 'png' || $details->type == 'jpg' || $details->type == 'gif' || $details->type == 'svg'|| $details->type == 'image' )
                                    <div class='zoom item ex3' id='ex3'>
                                        <img alt="" class="img-responsive target" data-lightbox="gallery"
                                             src="{{asset(''.$details->url)}}" title="{{$details->title_image}}" alt="{{$details->alt_image}}"/>
                                    </div>
                                @else
                                <!-- Video start -->
                                    <div class="item item-video">
                                        <img data-target="#myImgShow" data-toggle="modal" alt="" class="img-responsive"
                                             data-lightbox="gallery" src="{{ asset('assets/img/no-image.png') }}"/>
                                        <video autoplay muted controls>
                                            <source src="{{asset(''.$details->url)}}" type="video/mp4" title="{{$details->title_image}}" alt="{{$details->alt_image}}">
                                        </video>
                                    </div>
                                    <!-- Video end -->
                                @endif
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ============Model Code End============= -->

    <!-- ================Description Section Code Start==================== -->
    <section>
        <div class="description-section">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="accordion-bral">
                            @if($productDetails->description != '' && $productDetails->is_subscription ==1)
                                <div class="accordian-box">
                                    <input class="ac-input" id="acco-1" name="accordion-1" type="checkbox"/>
                                    <label class="ac-label toggle-btn" for="acco-1">
                                        <span class="arrow"></span>Beskrivelse</label>
                                    <div class="article ac-content">
                                        <div class="content-aa">
                                            <p><?= $productDetails->description?></p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <!----- Specifikationer   ------------>
                            @if($productDetails->specfication != '')
                                <div class="accordian-box">
                                    <input class="ac-input" id="ac-1" name="accordion-1" type="checkbox"/>
                                    <label class="ac-label toggle-btn" for="ac-1">
                                        <span class="arrow"></span><?= $productDetails->specification_title?></label>
                                    <div class="article ac-content">
                                        <div class="content-aa">
                                            <p> <?= $productDetails->specfication?></p>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if($productDetails->specification2 != '' && $productDetails->specification2_title != '')
                                <div class="accordian-box">
                                    <input class="ac-input" id="acc-1" name="accordion-1" type="checkbox"/>
                                    <label class="ac-label toggle-btn" for="acc-1">
                                        <span class="arrow"></span><?= $productDetails->specification2_title?></label>
                                    <div class="article ac-content">
                                        <div class="content-aa">
                                            <p><?= $productDetails->specification2?></p>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if($productDetails->specification3 != '' && $productDetails->specification3_title != '')
                                <div class="accordian-box">
                                    <input class="ac-input" id="acc-2" name="accordion-1" type="checkbox"/>
                                    <label class="ac-label toggle-btn" for="acc-2">
                                        <span class="arrow"></span><?= $productDetails->specification3_title?></label>
                                    <div class="article ac-content">
                                        <div class="content-aa">
                                            <p><?= $productDetails->specification3?></p>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if($productDetails->specification4 != '' && $productDetails->specification4_title != '' )
                                <div class="accordian-box">
                                    <input class="ac-input" id="acc-3" name="accordion-1" type="checkbox"/>
                                    <label class="ac-label toggle-btn" for="acc-3">
                                        <span class="arrow"></span><?= $productDetails->specification4_title?></label>
                                    <div class="article ac-content">
                                        <div class="content-aa">
                                            <p><?= $productDetails->specification4?></p>
                                        </div>
                                    </div>
                                </div>
                            @endif

                        <!---- Inkluderer  ----->
                            @if($productDetails->inholder != '' && $productDetails->type =="Physical")
                                <div class="accordian-box">
                                    <input class="ac-input" id="ac-3" name="accordion-1" type="checkbox"/>
                                    <label class="ac-label toggle-btn" for="ac-3"> <span
                                            class="arrow"></span>Inkluderer</label>
                                    <div class="article ac-content">
                                        <div class="content-aa">
                                            <p><?= $productDetails->inholder?> </p>
                                        </div>
                                    </div>
                                </div>
                            @endif

                        <!----- Vejledninger  -------->
                            <div class="accordian-box">
                                <input class="ac-input" id="ac-2" name="accordion-1" type="checkbox"/>
                                <label class="ac-label toggle-btn" for="ac-2"> <span
                                        class="arrow"></span>Vejledninger</label>
                                <div class="article ac-content">
                                    <div class="content-aa">
                                        <ul>
                                            @if(count($productDetails->contexts)>0)

                                                @foreach($productDetails->contexts as $context)
                                                    <?php

                                                    ?>
                                                    @if($context->type =="guide" || $context->type =="manual" || $context->type =="file")

                                                        <li style="list-style: none">
                                                            <a href="{{url('public/'.$context->file_url)}}"
                                                               target="_blank"><img
                                                                    src="{{ asset('assets/img/download.png') }}"  title="{{$context->title_image}}" alt="{{$context->alt_image}}"
                                                                    class="mr-3 mb-2">{{$context->name}}</a>
                                                        </li>

                                                    @elseif($context->type =="video"  && $context->file_url !=null && !empty($context->file_url))

                                                        <li style="list-style: none">
                                                            <a href="{{url('/'.$context->file_url)}}" target="_blank"><img
                                                                    src="{{ asset('assets/img/icon-play.png') }}"   title="{{$context->title_image}}" alt="{{$context->alt_image}}"
                                                                    class="mr-3 mb-2">{{$context->name}}</a>
                                                        </li>
                                                    @elseif($context->type =="page")
                                                        <li style="list-style: none">
                                                            <a href="{{$context->link}}" target="_blank"><img
                                                                    src="{{ asset('assets/img/download1.png') }}"  title="{{$context->title_image}}" alt="{{$context->alt_image}}"
                                                                    class="mr-3 mb-2">{{$context->description}}</a>
                                                        </li>
                                                    @else
                                                        <li style="list-style: none">
                                                            <a href="{{$context->link}}" target="_blank"><img
                                                                    src="{{ asset('assets/img/download1.png') }}"
                                                                    class="mr-3 mb-2">{{$context->name}}</a>
                                                        </li>
                                                    @endif

                                                @endforeach

                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $rr = '';
                            foreach ($related as $qq){
                                if($qq->status == 1){
                                    $rr = 1;
                                }
                            }
                            ?>
                            <!------ Tilbehør  ------->



                            @if($rr ==1 && $productDetails->type =="Physical")
                                <div class="accordian-box">
                                    <input class="ac-input" id="ac-4" name="accordion-1" type="checkbox"/>
                                    <label class="ac-label toggle-btn" for="ac-4">
                                        <span class="arrow"></span>Tilbehør</label>
                                    <div class="article ac-content">
                                        <div class="content-aa">
                                            <div class="row">
                                                @foreach($related as $relate)
                                                    @if($relate->status ==1)
                                                        <div class="col-md-2 col-sm-3 mb-4">
                                                            <div class="product-box">
                                                                <a href="{{route('produkt',[$areaId,$relate['id'],Str::slug($relate->api_name)])}}">
                                                                    <div class="product-zoom">
                                                                        @if(count($relate->imagess)>0)
                                                                            <img
                                                                                src="{{ asset('public/'.$relate->imagess[0]->url) }}" title="{{$relate->imagess[0]->title_image}}" alt="{{$relate->imagess[0]->alt_image}}">
                                                                        @else
                                                                            <img
                                                                                src="{{ asset('public/assets/img/no-product.png') }}">
                                                                        @endif
                                                                    </div>
                                                                </a>
                                                                <div class="pro-name-heading">
                                                                    <h4>
                                                                        <a href="{{route('produkt',[$areaId,$relate['id'],Str::slug($relate->api_name)])}}">{{$relate['api_name']}}</a>
                                                                    </h4>
                                                                    <p><?= $relate['short_text']?></p>
                                                                    <ul>
                                                                        <li>
                                                                            <strong> @if($relate->hide_amount !=1) {{ isset($productApiPrices[$relate->api_id]) ? str_replace(",",".",number_format($productApiPrices[$relate->api_id]->basePrice)): "0"}}
                                                                                kr. ekskl. moms @else Ring for en
                                                                                pris @endif</strong></li>
                                                                        <li><span class="green"
                                                                                  style="background-color: <?= isset($productApiPrices[$relate->api_id]) ? $productApiPrices[$relate->api_id]->availability->color : "white"?>"></span> <?= isset($productApiPrices[$relate->api_id]) ? $productApiPrices[$relate->api_id]->availability->text : ""?>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ================Description Section Code End==================== -->



    <!-- ================Product Section Code Start==================== -->

    <section>
        <div class="product-sec">
            <div class="container-fluid">
                <div class="product-heading fsize34">
                    <h3>Passer sammen med</h3>
                </div>
                <div class="row">
                    @if(!empty($passer))
                        @foreach($passer as $pp=>$passers)
                            @if($passers->status ==1)
                                <div class="col-md-2 mb-4">
                                    <div class="product-box">
                                        <a href="{{route('produkt',[$areaId,$passers['id'],Str::slug($passers->api_name)])}}">
                                            <div class="product-zoom">
                                                @if(count($passers->imagess)>0)
                                                    <img src="{{ asset('public/'.$passers->imagess[0]->url) }}" title="{{$passers->imagess[0]->title_image}}" alt="{{$passers->imagess[0]->alt_image}}">
                                                @else
                                                    <img src="{{ asset('public/assets/img/no-product.png') }}">
                                                @endif
                                            </div>
                                        </a>
                                        <div class="pro-name-heading">
                                            <h4>
                                                <a href="{{route('produkt',[$areaId,$passers['id'],Str::slug($passers->api_name)])}}">{{$passers['api_name']}}</a>
                                            </h4>
                                            <p><?= $passers['short_text']?></p>
                                            <ul>
                                                <?php
                                                $apiId = $passers['api_id'];
//                                                echo "<pre>";
//                                                print_r($parserPrices[$pp]);
//                                                echo "</pre>";
                                                ?>
                                                <li>
                                                    <strong> @if($passers->hide_amount !=1) {{ isset($parserPrices[$pp]) ?  str_replace(",",".",number_format($parserPrices[$pp]->basePrice)): "0"}}
                                                        kr. ekskl. moms @else Ring for en pris @endif</strong></li>
                                                <li><span class="green"
                                                          style="background-color: <?= isset($parserPrices[$pp]) ? $parserPrices[$pp]->availability->color : "white"?>"></span> <?= isset($parserPrices[$pp]) ? $parserPrices[$pp]->availability->text : ""?>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- ================ Product Section Code End ==================== -->

@endsection

@section('js')

    <script>
        $('.product .select-items').click(function (){
            var val = $('#mySelect2').val()
            if (val=='add_new'){
                $('.mySelect').addClass('d-none');
                $('.myText').removeClass('d-none');
            }
        })
        function removeText(){
            $('.mySelect').removeClass('d-none');
            $('.myText').addClass('d-none');
        }

        $('.variantItem').click('click',function() {
            getProductPrice($(this).attr('id'))
            displaySelect($(this).attr('id'));
        })

        function getProductPrice(productId)
        {
            $.ajax({
                type: "GET",
                url: "{{url('getProduktPrice')}}",
                data: "id=" + productId + '&_token={{ csrf_token() }}',
                beforeSend: function () {
                    $(".see_loader").css('display', 'flex');
                },
                success: function (data) {
                    // console.log(data[0].availability.color);
                     console.log(data.data);
                    $('.APIClass').html('');
                    $('.APIColor').addClass('d-none');
                    $('.ApiMsg').html('');
                    $('.APIColor').css('background-color','#FFF');

                    if (data.status == "true"){
                        let number = data.data.unitPrice;
                        number = number.toLocaleString();
                        var apiPrice = parseFloat(number.replace(/,/gi, "."))
                        $('#apiPrice').html(apiPrice+' kr. ekskl. moms ');
                        // $('#apiPrice').html(apiPrice+' kr. ekskl. '+data.data.availability.text);
                         $('.APIClass').html(data.data.availability.text);
                         $('.APIColor').removeClass('d-none');
                        // $('.ApiMsg').html('Ekskl. klargøring, kalibrering og oplæring');
                         $('.APIColor').css('background-color',data.data.availability.color);
                    }
                    if (data.status == "false"){
                        $('#apiPrice').html(data.data.message)
                    }
                   $('.see_loader').delay(500).css('display','none');
                }
            });
        }

        function displaySelect(api_id)
        {
            $.ajax({
                type: "GET",
                url: "{{route('getVariantSim')}}",
                data: "api_id=" + api_id+"&product_id=<?= $productDetails->id?>",
                success: function (data) {
                    $('.myCustomSelect').html(data)
                }
            });
        }

        $(document).ready(function (){
            $('.firstLi').trigger('click'),2000;
           //  $('.firstLi').one('click',function() {
           //      getProductPrice($(this).attr('id'))
           //  })
        })


        function forProductDetails()
        {
            $('#productInput').addClass('d-none');
            $('#simNumber').val('');
            if ($('.productEvents').val() == "static"){
                $('#productInput').removeClass('d-none');
            }else{
                $('#productInput').addClass('d-none');
            }
            $.ajax({
                type: "GET",
                url: "{{route('productSimStatus')}}",
                data: "api_id=" + $('.productEvents').val(),
                success: function (data) {
                    // console.log(data);
                    // $('#productInput').addClass('d-none');
                    // if (data == 1){
                    // $('#productInput').removeClass('d-none');
                    // }
                }
            });
        }
    </script>
    <script>
        function addCartSubscription()
        {
            if ($('#mySelect2').val() ==''){
                $('.select-selected').css('border','1px solid red');
                $('.sim-selection').html('Please select sim card');
                return false;
            }
            if ($(".myText.d-none")[0]){
                $('#simNumber').css('border','');

                var simNumber = null;
                var extraProduct = $('#mySelect2').val();
            } else {
                var simNumber = $('#simNumber').val();
                var extraProduct = null;
                if (simNumber.length <=5){
                    $('.pos-rel .error').html('Please enter valid sim number.');
                    $('#simNumber').css('border','1px solid red');

                    $('.select-selected').css('border','');
                    $('.sim-selection').html('');
                    return false;
                }
            }

            if ($('#date').val() ==''){
                $('.dtt').html('Please select start date.');
                $('#date').css('border','1px solid red');
                $('#simNumber').css('border','');
                $('.pos-rel .error').html('');
                $('.select-selected').css('border','');
                $('.sim-selection').html('');
                return false;
            }

            $('.dtt').html('');
            $('#date').css('border','');
            $('#simNumber').css('border','');
            $('.pos-rel .error').html('');
            $('.select-selected').css('border','');
            $('.sim-selection').html('');

            var productId = $('input[name="variantProduct"]:checked').val();

                $.ajax({
                    type: "POST",
                    url: "<?= route('cart_add_subscription')?>",
                    data: "productId=" + productId + '&_token=<?= csrf_token()?>'+'&qty=1&simNumber='+simNumber+'&extraProduct='+extraProduct+'&v_productId=<?=$productDetails->id?>',
                    beforeSend: function () {
                       // $("#pre-loader").removeClass('d-none');
                    },
                    success: function (data) {
                        //console.log(data);
                        if (data == 200){
                            toastMixin.fire({
                                title: 'Product has been successfully added to your basket',
                                icon: 'success'
                            });
                            setTimeout(function() {
                                window.location.reload();
                            }, 4000);
                        }

                        if (data.status == 3){
                            toastMixin.fire({
                                title: data.message,
                                icon: 'error'
                            });
                            setTimeout(function() {
                                window.location.href = "<?= url('').'/login-register'?>";
                            }, 4000);
                        }else{
                            window.location.reload();
                        }
                        setTimeout(function() {
                            window.location.reload();
                        }, 3000);
                    }
                });


        }
    </script>
@endsection


