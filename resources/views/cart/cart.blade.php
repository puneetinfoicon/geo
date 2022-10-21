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

        .cart_loader {
            overflow: hidden;
        }

        .cart_loader .lds-spinner {
            display: flex;
            align-items: center;
            height: 840px;
            overflow: hidden;
            margin: 0 auto;
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
    <section>
        <div class="product-add">
            <div class="container-fluid">
                <div class="row justify-content-between">
                    <div class="col-lg-12">
                        <div class="left-section mb-0 pb-0">
                            <h3>Din kurv
                                <div class="share-dropdown dropdown " data-toggle="tooltip" data-placement="top"
                                     title="Gem eller send kurv">
                                    <button type="button" class="dropdown-toggle" data-toggle="dropdown">
                                        <img src="<?= asset('assets/img/share.png')?>" alt="" class="img-fluid">
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item getCartLink" href="javascript:;" data-toggle="modal"
                                           data-target="#linkModal">Generér link</a>
                                        <a class="dropdown-item" href="javascript:;" data-toggle="modal"
                                           data-target="#shareModal">Send som e-mail</a>
                                    </div>
                                </div>
                            </h3>
                        </div>
                    </div>

                    <div class="col-lg-7 col-lg-custom-6">
                        <div class="left-section">

                            <div class="wapper">
                                <div class="min-scroll position-relative">
                                    @php
                                        $cartDetails = getCartDetails();
                                    @endphp
                                    <span id="basketId" class="d-none"><?= $cartDetails['cartList']->basketId?></span>
                                    <?php

                                    if (isset($cartDetails['cartList']->lines)) {

                                    foreach ($cartDetails['cartList']->lines as $cartData) {
                                       // echo "<pre>";  print_r($cartData);  echo "</pre>";
                                    $pImage = getProductImage($cartData->productNumber);
                                    if ($pImage->url != '') {
                                        $url = $pImage->url;
                                    } else {
                                        $url = asset('/assets/img/no-image.png');
                                    }
                                    ?>
                                    <div class="media <?= $cartData->lineId?>">
                                        <div class="media-left">
                                            <a href="<?= url('produkt', ['null', $pImage->id, Str::slug($pImage->api_name)]);?>">
                                                <img src="<?= $url?>" alt="" class="img-fluid"></a>
                                        </div>

                                        <div class="media-body">
                                            <div class="m-body">
                                                <div class="left-text">
                                                    <a href="<?= url('produkt', ['null', $pImage->id, Str::slug($pImage->api_name)]);?>">
                                                        <h3><?= $pImage->api_name?></h3></a>
                                                    <p>
                                                        <a href="<?= url('produkt', ['null', $pImage->id, Str::slug($pImage->api_name)]);?>"><?= $cartData->productNumber?></a>
                                                    </p>
                                                </div>
                                                <div class="del-pro">
                                                    <a href="javascript:;"><img
                                                            src="{{url('public/assets/img/delete.png')}}" alt="Delete"
                                                            onclick="deleteCart('<?= $cartData->lineId?>')"></a>
                                                </div>
                                            </div>

                                            <div class="update-input">
                                                <div class="number">
                                                    <span class="minus">-</span>
                                                    <input type="text" value="<?= $cartData->quantity?>"
                                                           class="updateCart" data-id="<?= $cartData->lineId?>"
                                                           data-value="<?= $pImage->id?>">
                                                    <span class="plus">+</span>
                                                </div>
                                                <?php

                                                if ($pImage->hide_amount != '1'){
                                                ?>
                                                <div class="price">
                                                    <p><span id="perPrice5128-22-GM"
                                                             class="itemPrice"><?= str_replace(",",".",number_format($cartData->sellPrice))?></span>
                                                        kr. ekskl. moms </p>
                                                    <?php $singlePrice[] = $cartData->sellPrice?>
                                                </div>
                                                <?php }else{?>
                                                <div class="price">
                                                    <p><span id="perPrice5128-22-GM" class="itemPrice"></span>
                                                        Ring for en pris </p>
                                                </div>
                                                <?php }?>
                                            </div>
                                        </div>
                                    </div>

                                    <?php    }
                                    }
                                    ?>

                                </div>
                            </div>

                            <?php
                            if (isset($cartDetails['cartList']->calculatedAmount)){
                            ?>
                            <div class="total-foot">
                                <h3>Total:</h3>
                                <h3><span id="cartPrice"><?php if (isset($singlePrice)) { echo str_replace(",",".",number_format(array_sum($singlePrice))); }?> </span> ekskl. moms</h3>
                            </div>
                            <?php }?>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="right-section right-posfixed">
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="{{url('search-produkt')}}" class="btn-submit border-only">Fortsæt med at
                                        handle</a>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{route('cart.checkout')}}" class="btn-submit">Gå til betaling</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1"></div>
                </div>
            </div>
        </div>
    </section>


    <!--Link Modal -->
    <div class="customModal modal fade" id="linkModal" tabindex="-1" role="dialog" aria-labelledby="linkModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="linkModalLabel">Generér Link</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="input_copy">
                        <input type="text" id="copyClipboard" readonly class="form-control">
                        <a href="javascript:;" class="copyLink_txt" id="copyButton" onclick="copy()"><i
                                class="fa fa-clone"></i></a>
                    </div>
                </div>
                <div class="modal-footer">
                    <div id="copied-success" class="copied">
                        <span>Copied!</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Share Modal -->
    <div class="customModal modal fade" id="shareModal" tabindex="-1" role="dialog" aria-labelledby="shareModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="linkModalLabel">Send som e-mail</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="input_copy">
                        <input type="text" class="form-control email" placeholder="email here">
                        <a href="#" class="copyLink_txt"><i class="fa fa-paper-plane-o"></i></a>
                    </div>
                    <span id="validaor"></span>
                </div>
            </div>
        </div>
    </div>


    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })

        function copy() {
            var copyText = document.getElementById("copyClipboard");
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            document.execCommand("copy");

            $('#copied-success').fadeIn(800);
            $('#copied-success').fadeOut(800);
        }

        function generateLink() {
            $.ajax({
                type: 'get',
                url: "{{url('/generate-cart-link')}}",
                data: '_token={{ csrf_token() }}&basketId='+$('#basketId').html(),
                success: function (data) {
                    if(data !=0){
                        $('#copyClipboard').attr('value', data);
                    }else{
                        $('#copyClipboard').attr('value', 0);
                    }
                }

            })
        }

        $(document).ready(function () {
            $('.getCartLink').click(function () {
                generateLink();
            });

            $('.copyLink_txt').click(function () {
                if ($('.email').val() == '') {
                    $('#validaor').html('Please enter valid e-mail');
                    $('.email').focus();
                } else {
                    generateLink();
                    setTimeout(function() {
                        $.ajax({
                            type: 'get',
                            url: "{{url('/send-cart-link')}}",
                            data: "_token={{ csrf_token() }}&url=" + $('#copyClipboard').val() + '&email=' + $('.email').val()+'&basketId='+$('#basketId').html(),
                            success: function (data) {
                                if (data.status != undefined) {
                                    $('.email').val('');
                                    $('#validaor').html(data.message);
                                    location.reload();
                                } else {
                                    $('.email').val('');
                                    $('.email').focus();
                                    $('#validaor').html(data.message);
                                }
                            }
                        })
                    }, 2000);
                }
            })


            $(".updateCart_old").on('change keyup', function () {
                var qty = 1;
                // var qty = $(this).val();
                var api_id = $(this).attr('data-value');
                var simNumber = null
                console.log(api_id)
                var cartValue = 0;
                $.ajax({
                    type: "POST",
                    url: "<?= route('cart_add_subscription')?>",
                    data: "productId=" + api_id + '&_token=<?= csrf_token()?>' + '&qty=' + qty + '&simNumber=' + simNumber, // For Static Code
                    success: function (data) {

                    }
                });
            });


            $(".updateCart").on('change keyup', function () {
                var qty = $(this).val();
                var api_id = $(this).attr('data-id');
                var cartValue = 0;
                $.ajax({
                    type: "POST",
                    url: "{{route('cart.alter_quantity')}}",
                    data: "api_id=" + api_id + '&_token={{ csrf_token() }}' + '&qty=' + qty + '&basketId=' + $('#basketId').html(),
                    beforeSend: function () {
                        // $(".se_loader").removeClass('d-none');
                    },
                    success: function (data) {

                        // data.forEach(function (item) {
                        //     let number = item.unitPrice;
                        //     number = number.toLocaleString();
                        //     cartValue += parseFloat(number.replace(/,/gi, "."));
                        //     $("#perPrice" + item.productNumber).html(parseFloat(number.replace(/,/gi, ".")));
                        // });
                        // $('#cartPrice').html(cartValue);
                        location.reload();
                    }
                });
            });

        });

        function deleteCart(data) {
            var Id = '.' + data;
            $.ajax({
                type: "POST",
                url: "{{route('cart.removeItem')}}",
                data: "api_id=" + data + '&_token={{ csrf_token() }}' + '&basketId=' + $('#basketId').html(),
                // beforeSend: function () {
                //     $(".se_loader").removeClass('d-none');
                // },
                success: function (data) {
                    //console.log(data)
                    // alert("success");
                    // $(Id).remove();
                    location.reload();
                    // $('.se_loader').delay(5000).addClass('d-none');
                }
            });
        }


    </script>
@endsection
