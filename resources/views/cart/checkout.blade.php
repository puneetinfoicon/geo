@extends('layout.master')
@section('title', 'Add Page')
@section('content')
    <!-- ================Product Section Code Start==================== -->
    <style>
        .select-items {
            height: 350px;
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

        .form-group, eanData div {
            font-size: 14px;
            color: red;
        }
    </style>
    <section>
        <div class="product-add account">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="left-section login-section">
                            <h3>Leveringsadresse</h3>
                            <p>Vælg en af dine foretrukne leveringsadresser eller tilføj en ny.</p>
                            @if(Session::has('success'))
                                <div class="alert alert-success" role="alert">{{Session::get('success')}}</div>
                            @elseif(Session::has('message'))
                                <div class="alert alert-danger" role="alert">{{Session::get('message')}}</div>
                            @endif
                            <div class="form-sec">
                                <!--form action="{{route('deliveryAddress.insert')}}" method="post" id="myform">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group col-md-11">
                                            <div class="pos-rel custom-select-2">
                                                <select name="" id="" class="form-control">
                                                    @foreach($addresses as $address)
                                                        <option
                                                            value="{{$address->deliveryAddressCode}}">{{$address->name . ', '.$address->address . ', '.$address->address2 . ', '.$address->postalNo . ', '.$address->postalCity}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <br>

                                    <h3>Tilføj ny leveringsadresse</h3>
                                    <div class="row">
                                        <div class="form-group col-md-8">
                                            <label for="name">Name</label>
                                            <div class="pos-rel">
                                                <input type="text" name="name" id="name" class="form-control"
                                                       placeholder="Name">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-md-8">
                                            <label for="address">Adresse 1</label>
                                            <div class="pos-rel">
                                                <input type="text" name="address" id="address" class="form-control"
                                                       placeholder="Address 1">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-md-8">
                                            <label for="address2">Adresse 2</label>
                                            <div class="pos-rel">
                                                <input type="text" name="address2" id="address2" class="form-control"
                                                       placeholder="Adresse">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-8">
                                            <label for="postalCity">Postal City</label>
                                            <div class="pos-rel">
                                                <input type="text" name="postalCity" id="postalCity"
                                                       class="form-control"
                                                       placeholder="Postal City">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="row">
                                                <div class="form-group col-md-5 pr-1">
                                                    <label for="postalNo">Postnummer</label>
                                                    <div class="pos-rel">
                                                        <input type="text" name="postalNo" id="postalNo"
                                                               class="form-control" placeholder="Postnummer">
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-7 pl-1">
                                                    <label for="deliveryAddressCode">Delivery Address Code</label>
                                                    <div class="pos-rel">
                                                        <input type="text" name="deliveryAddressCode"
                                                               id="deliveryAddressCode" class="form-control"
                                                               placeholder="Delivery Address Code">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="row">
                                                <div class="form-group col-md-5 pr-1">
                                                    <label for="countryCode">Country Code</label>
                                                    <div class="pos-rel">
                                                        <input type="text" name="countryCode" id="countryCode"
                                                               class="form-control" placeholder="Country Code">
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-7 pl-1">
                                                    <label for="contact">Contact</label>
                                                    <div class="pos-rel">
                                                        <input type="text" name="contact" id="contact"
                                                               class="form-control"
                                                               placeholder="contact">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-25">
                                        <button class="btn btn-submit active-bg">Tilføj adresse</button>
                                    </div>
                                </form-->
                                    <div class="form-sec">
                                        <form action="">
                                            <div class="row">
                                                <div class="form-group col-md-11">
                                                    <div class="pos-rel custom-select-2">
                                                        <select name="" id="" class="form-control">
                                                            @foreach($addresses as $address)
                                                                <option
                                                                    value="{{$address->deliveryAddressCode}}">{{$address->name . ', '.$address->address . ', '.$address->address2 . ', '.$address->postalNo . ', '.$address->postalCity}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>

                                            <h3>Tilføj ny leveringsadresse</h3>

                                            <div class="row">
                                                <div class="form-group col-md-8">
                                                    <label for="cname00">Firmanavn</label>
                                                    <div class="pos-rel">
                                                        <input type="text" name="name" id="cname00" class="form-control" placeholder="Firmanavn">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-8">
                                                    <label for="cname00">Attention</label>
                                                    <div class="pos-rel">
                                                        <input type="text" name="cname" id="cname00" class="form-control" placeholder="Navn og efternavn">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-8">
                                                    <label for="cname00">Leveringsadresse</label>
                                                    <div class="pos-rel">
                                                        <input type="text" name="cname" id="cname00" class="form-control" placeholder="Adresse">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="row">
                                                        <div class="form-group col-md-5 pr-1">
                                                            <label for="address">Postnummer</label>
                                                            <div class="pos-rel">
                                                                <input type="text" name="Postnummer" id="Postnummer" class="form-control" placeholder="Postnummer">
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-md-7 pl-1">
                                                            <label for="by">By</label>
                                                            <div class="pos-rel">
                                                                <input type="text" name="by" id="by" class="form-control" placeholder="By">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group mt-25">
                                                <button class="btn btn-submit active-bg">Tilføj adresse</button>
                                            </div>
                                        </form>
                                    </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="left-line-no"></div>
                    </div>

                    <div class="col-lg-5">
                        <div class="left-section register-section">
                            <h3>Leveringsmetode</h3>
                            <p>Vælg din foretrukne leveringsmetode.</p>
                            <?php
                            $count = 0;
                            $phyPrice = [];
                            $gpsNongps = [];
                            $customerNumber = getCartDetails()['cartList']->customerNo;
                            $dataObj = array();
                            $dataObj['customerNumber'] = (string)$customerNumber;
                            $subsCripTion = 0;
                            if (isset(getCartDetails()['cartList'])){
                                foreach (getCartDetails()['cartList']->lines as $type){
                                  //  echo "<pre>";
                                   // print_r($type);
                                    if($type->productType =="Physical"){
                                        $phyPrice[] =  $type->sellPrice;
                                    }else{
                                        $gpsNongps[] =  $type->sellPrice;
                                    }

                                    if (in_array($type->productType,['GPSNetSubscription','ServiceAgreement','Hotline','Sim'])){
                                        $subsCripTion++;
                                    }
                                   // echo "</pre>";
                                    $dataObj['productList'][$count] = new \stdClass;
                                    $dataObj['productList'][$count]->productNumber = $type->productNumber;
                                    $dataObj['productList'][$count]->requestedQuantity = $type->quantity;
                                    $count++;
                                }
                            }
                            $response = postApi('CheckOut/DeliveryOptions',$dataObj);
                            ?>
                            <div class="form-sec">
                                <form action="">
                                    <div class="row">
                                        <div class="form-group col-md-8">
                                            @foreach($response as $key=>$deliveryType)
                                                <?php
                                                if ($key == 0){
                                                    $checked = "checked";
                                                }else{
                                                    $checked = "";
                                                }
                                                ?>
                                            <div class="media-check">
                                                <div class="custom-radio">
                                                    <input type="radio" id="{{$deliveryType->deliveryCode}}" onchange="gateLevering()" name="radio_group" value="{{$deliveryType->price}}" {{$checked}}>
                                                    <label for="{{$deliveryType->deliveryCode}}">{{$deliveryType->primaryText}} <br> {{$deliveryType->secondaryText}}</label>
                                                </div>

                                                <div class="price">
                                                    <p>{{$deliveryType->price}} kr.</p>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <h3>Betalingsmetode</h3>
                                    <br>
                                    <br>
                                    <div class="row">
                                        <div class="form-group col-md-8">
                                            <div class="media-check">
                                                <div class="custom-radio">
                                                    <input type="radio" id="betaling" name="paymentType" value="invoice"
                                                           onclick="checkPaymentType('invoice')">
                                                    <label for="betaling">Betaling med faktura</label>
                                                </div>
                                            </div>

                                            <div class="media-check">
                                                <div class="custom-radio">
                                                    <input type="radio" id="kreditkort" name="paymentType"
                                                           value="creditCard" onclick="checkPaymentType('creditCard')"
                                                           checked>
                                                    <label for="kreditkort">Betaling med kreditkort eller
                                                        MobilePay</label>
                                                </div>
                                            </div>

                                            <div class="media-check">
                                                <div class="custom-radio">
                                                    <input type="radio" id="EAN" name="paymentType" value="EAN"
                                                           onclick="checkPaymentType('EAN')">
                                                    <label for="EAN">Betaling med EAN</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-8">
                                            <div class="pos-rel d-none ean">
                                                <input type="text" name="ean" id="ean" class="form-control"
                                                       placeholder="EAN-nummer">
                                                <div class="eanData d-none">This field is required *</div>
                                            </div>

                                            <div class="pos-rel d-none invoice">
                                                <label for="">Account Number: <b>XXXXXXXXXXXXX</b></label><br>
                                                <label for="">IFSC Number: <b>XXXXXX</b></label>
                                            </div>
                                        </div>
                                    </div>

                                    <br>
                                    <h3>Din ordrereference</h3>

                                    <div class="row">
                                        <div class="form-group col-md-8">
                                            <label for="crv">Ordrereference</label>
                                            <div class="pos-rel">
                                                <input type="text" name="Ordrereference" id="Ordrereference"
                                                       class="form-control"
                                                       placeholder="* Ordrereference">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-md-8">
                                            <label for="crv">Yderligere kommentarer</label>
                                            <div class="pos-rel">
                                                <textarea name="details" id="details" cols="30" rows="10"
                                                          class="form-control"
                                                          placeholder="Skriv din kommentar til ordren"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <br>
                        <br>

                        <div class="right-section">
                            <div class="row">
                                <div class="col-md-8">
                                    <h3>Samlet pris</h3>
                                    <?php
                                  /*  $myCart = cartList();
                                    $subPrice = [];
                                    if (sizeof($myCart) > 0) {
                                        foreach ($myCart['carts']['products'] as $cartItems) {
                                            if (isset($myCart['carts']['productApiPrices'][$cartItems->api_id])) {
                                                if ($cartItems->hide_amount != 1) {
                                                    $x = $cartItems->api_id;
                                                    $subPrice[] = str_replace(",", ".", number_format($myCart['carts']['productApiPrices'][$x]->unitPrice)) . "<br>";
                                                }
                                            }
                                        }
                                    }*/
                                    ?>
                                    <div class="price-ttt first-ttt">
                                        <p>Varekøb: <input type="text" class="sumPhy d-none" value="<?= array_sum($phyPrice)?>"> <span><?= array_sum($phyPrice)?></span></p>
                                        <p>Klargøring: <span>xxxx,xx</span></p>
                                        <p>Rabat: <span>-xxxx,xx</span></p>
                                        <p>Levering:  <input type="text" class="levData d-none" value="00.00"> <span class="levData1">00.00</span></p>
                                    </div>

                                    <div class="price-ttt sec-ttt">
                                        <p>Varer eksl. moms: <input type="text" class="Varer_eksl d-none" value="00.00"> <span class="Varer_eksl1">00.00</span></p>
                                        <p>Abonnementer: <input type="text" class="gpsNongps d-none" value="<?= array_sum($gpsNongps)?>"> <span><?= array_sum($gpsNongps)?> </span></p>
                                        <p><strong>Total eksl. moms:</strong> <span> <input type="text" class="total_eksl d-none" value="00.00"> <strong class="total_eksl1">00.00</strong></span></p>
                                    </div>

                                    <div class="price-ttt sec-ttt">
                                        <p>Moms (25%): <input type="text" class="momDiscount d-none" value="00.00"> <span class="momDiscount1">00.00</span></p>
                                        <p>Total inkl. moms: <input type="text" class="total_inkl_moms d-none" value="00.00"> <span>DKK </span><span class="total_inkl_moms1">DKK 00.00</span></p>
                                    </div>

                                    <div class="left-section register-section">
                                        <div class="custom-checkbox">
                                            <?php
                                            echo "<pre>";
                                            print_r(getAllCheckout_terms()[0]->data);
                                            echo "</pre>";
                                            ?>
                                            <div class="form-group">
                                                <input type="checkbox" id="check2">
                                                <label for="check2">Jeg accepterer <a href="@isset(getAllCheckout_terms()[1]) {{ url('').getAllCheckout_terms()[1]->data}} @endisset">@isset(getAllCheckout_terms()[0]) {{getAllCheckout_terms()[0]->data}} @endisset</a></label>
                                                <div class="d-none" id="fCheck">Please accept Geoteam's terms and
                                                    conditions *
                                                </div>
                                            </div>
                                           {{-- @if($subsCripTion )--}}
                                            <div class="form-group">
                                                <input type="checkbox" id="check3">
                                                <label for="check3">Jeg accepterer <a href="@isset(getAllCheckout_terms()[3]) {{ url('').getAllCheckout_terms()[3]->data}} @endisset">@isset(getAllCheckout_terms()[2]) {{getAllCheckout_terms()[2]->data}} @endisset</a></label>
                                                <div class="d-none" id="sCheck">Please accept Geoteams
                                                    abonnementsbetingelser for GPSnet *
                                                </div>
                                            </div>
                                           {{-- @endif--}}
                                        </div>
                                    </div>
                                    <button class="btn-submit checkout">Gennemfør køb</button>
                                    {{--                                    <a href="javascript:;" class="btn-submit checkout" disabled="">Gennemfør køb</a>--}}
                                </div>
                            </div>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        $(document).ready(function (){
            $('.levData1').html($('input[name="radio_group"]:checked').val())
            $('.levData').attr('value',$('input[name="radio_group"]:checked').val())
            calculateValues();
        })

        function calculateValues(){
            var levData = parseFloat($('input[name="radio_group"]:checked').val());
            var sumPhy = parseFloat("<?= array_sum($phyPrice)?>");

            var Varer_eksl = levData + sumPhy;

            $('.Varer_eksl1').html(Varer_eksl);
            $('.Varer_eksl').attr('value',Varer_eksl);

            var total_eksl = parseFloat(Varer_eksl) + parseFloat($('.gpsNongps').val());

            $('.total_eksl').attr('value',total_eksl);
            $('.total_eksl1').html(total_eksl);

            var momDiscount = parseFloat(total_eksl) * 25/100;
            $('.momDiscount').attr('value',parseFloat(momDiscount));

            $('.momDiscount1').html(parseFloat(momDiscount));

            $('.total_inkl_moms').attr('value',parseFloat(momDiscount) + parseFloat(total_eksl));
            $('.total_inkl_moms1').html(parseFloat(momDiscount) + parseFloat(total_eksl))
        }

        function gateLevering()
        {
            $('.levData1').html($('input[name="radio_group"]:checked').val());
            $('.levData').attr('value',$('input[name="radio_group"]:checked').val())
            calculateValues();
        }
        function checkPaymentType(data) {
            if (data == 'invoice') {
                $('.invoice').removeClass('d-none');
                $('.ean').addClass('d-none');
            } else if (data == 'EAN') {
                $('.ean').removeClass('d-none');
                $('.invoice').addClass('d-none');
            } else {
                $('.ean').addClass('d-none');
                $('.invoice').addClass('d-none');
            }
        }

        function creditCardValidate() {
            $('#fCheck').addClass('d-none');
            $('#sCheck').addClass('d-none');
            if ($("#check2").prop('checked') === false) {
                $('#fCheck').removeClass('d-none');
                return false;
            } else if ($("#check3").prop('checked') === false) {
                $('#sCheck').removeClass('d-none');
                return false;
            } else {
                return true;
            }
        }

        $('.checkout').click(function () {
            $("input:radio[name='paymentType']:checked").each(function () {
                if ($(this).val() == 'EAN') {
                    $('.eanData').addClass('d-none')
                    if ($("input:text[name='ean']").val() == '') {
                        $('.eanData').removeClass('d-none');
                        return false;
                    }
                }

                if (creditCardValidate() == true) {
                    var eanVal = $("input:text[name='ean']").val();
                    var Ordrereference = $('#Ordrereference').val();
                    var details = $('#details').val();
                    var postData = 'eanVal=' + eanVal + '&Ordrereference=' + Ordrereference + '&details=' + details+'&amount=450';
                    // $.ajax({
                    //     type:'GET',
                    //     url:"",
                    //     data:postData,
                    //     success: function (data) {
                    //         console.log(data)
                    //      }
                    //  })
               window.location.href="<?= url('/check-payment-method?')?>"+postData;

                }


            })
        })
    </script>
    <!-- ================Product Section Code End==================== -->
@endsection
