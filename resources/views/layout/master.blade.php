<?php

$current_uri = '/' . Request::path();

$class = '';
if (isset(dynamicHeader($current_uri)[0]) && dynamicHeader($current_uri)[0]->route == '/home') {
    $class = 'header home-header';
}
$title = '';
if (isset(dynamicHeader($current_uri)[0]->title)) {
    $title = dynamicHeader($current_uri)[0]->title;
}


////   Cart Count & Cart Helpers ///
$cartDetails = getCartDetails();
$tp = [];
if (isset($cartDetails['cartList']->lines)){
    foreach($cartDetails['cartList']->lines as $cartData){
        $arr['api_id'] =  $cartData->productNumber;
        $arr['quantity'] =  $cartData->quantity;
        array_push($tp,$arr);
    }
}
$cartPrice = cartListNew($tp);
//echo "<pre>"; print_r($cartPrice); die;
$footerData = getContent1('footer');
$footer = footerData();
?>
<?php
if(isset($area->name)){
    if($area->name == "Landbrug"){
        $chkArea = "AG";
    }elseif($area->name == "Landmåling"){
        $chkArea = "Survey";
    }elseif($area->name == "Referencenet"){
        $chkArea = "GPSNet";
    }else{
        $chkArea = "Other";
    }
}else{
    $chkArea = "Other";
}
?>
    <!DOCTYPE html>
<html lang="en">
<head>
    <title>Geoteam</title>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}" type="image/x-icon">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport"/>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/custom-select.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/ma5-menu.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
</head>
<style>
    body{
        touch-action: manipulation;
    }
</style>
<body>

<!-- overlay_menubg -->
<div class="overlay_menubg">
    <div class="menuClose">
        <img src="{{ asset('assets/img/close.png') }}">
    </div>
</div>
<!-- /overlay_menubg -->

<header class="<?= $class;?>">  <!-- header home-header -->
    <div class="container-fluid">
        <div class="search-desktop">
            <form action="/" method="get" autocomplete="off">
                <input class="search-des searchright" id="searchKey" type="search" name="q"
                       placeholder="Skriv for at søge">
                <label class="search-label" for="searchKey"><img src="{{ asset('assets/img/search.png') }}"></label>
            </form>
        </div>
        <div class="row align-items-center">
            <div class="col-md-9 col-sm-8 col-7 mb-12">
                <div class="nav-section">
                    <div class="logo">
                        <a href="{{route('home')}}">
                            <img src="{{ asset('assets/img/logo.svg') }}" class="logo-def">
                            <img src="{{ asset('assets/img/logo-icon.svg') }}" class="logo-icon">
                        </a>
                    </div>
                    <div class="custom_menubar mobile-hide">
                        <nav class="navbar-custom">
                            <ul class="navbar-menu">
                                <li class="dropdown ">
                                    <a class="dropdown-toggle" href="javascript:;"
                                       id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                       aria-expanded="false">
                                        Produkter
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                        <?php
                                        foreach (getProdukters() as $categories) {
                                        ?>
                                        <li class="dropdown-submenu">
                                            <?php if($categories->url != null){?>
                                            <a href="<?= url('/' . utf8_encode($categories->url)) ?>"><?= $categories->name ?></a>
                                            <?php }else{?>
                                            <a  href="javascript:;"><?= $categories->name ?></a>
                                            <?php }?>

                                            <ul class="dropdown-menu">
                                                <?php
                                                foreach (getSub_produkters($categories->id) as $subProdukter) { ?>
                                                <li>
                                                    <a href="<?= url('/' . urldecode($subProdukter->url)) ?>"> {{$subProdukter->name}} </a>
                                                </li>
                                                <?php } ?>
                                            </ul>
                                        </li>
                                        <?php } ?>
                                    </ul>
                                </li>
                                <?php
                                foreach (getMenu() as $menu) {
                                if (sizeof(getSubMenu($menu->id)) == 0) {
                                ?>
                                <li class="">
                                    <a href="<?php echo url('/') . urldecode($menu->url); ?>">{{ $menu->name }}</a>
                                </li>
                                <?php } else {
                                ?>
                                <li class="dropdown ">
                                    <a  href="<?= url('/' . utf8_encode($menu->url)) ?>"
                                        id="navbarDropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        {{$menu->name}}
                                    </a>

                                    <ul class="dropdown-menu kontact-dropdown"
                                        aria-labelledby="navbarDropdownMenuLink1">
                                        <?php
                                        foreach (getSubMenu($menu->id) as $submenu) {
                                        ?>
                                        <li>
                                            <a href="<?= url('/') . urldecode($submenu->url) ?>">{{ $submenu->name }}</a>
                                        </li>
                                        <?php } ?>
                                    </ul>
                                </li>

                                <?php }
                                } ?>
                            </ul>
                        </nav>


                    </div>

                </div>
            </div>

            <div class="col-md-3 col-sm-4 col-5 mb-12">
                <!-- right-header -->
                <div class="right-header">
                    <ul>
                        <li class="search-icon mobile_hide">
                            <div class="search-container">
                                <form action="<?= url('/search-produkt')?>" method="get" autocomplete="off">
                                    <input class="search expandright searchright" id="searchright" type="search"
                                           name="name"
                                           placeholder="Skriv for at søge" autocomplete="off">
                                    <label class="button searchbutton" for="searchright"><img
                                            src="{{ asset('assets/img/icon/Icon-search.svg') }}"></label>
                                </form>
                            </div>
                        </li>
                        <li class="basket-icon"><a href="javascript:void(0);"><img
                                    src="{{ asset('assets/img/icon/Icon-basket.svg') }}">
                                <span><?= $cartDetails['cartCnt']; ?></span></a></li>
                        <li class="acuser-icon"><a href="javascript:;"><img
                                    src="{{ asset('assets/img/icon/Icon-user.svg') }}"></a></li>
                    </ul>
                </div><!-- /right-header -->
            </div>
        </div>
    </div>

    <!-- mobile-menu -->
    <div class="mobile-menu">
        <!-- mobile menu toggle button start -->
        <button class="ma5menu__toggle" type="button">
            <span class="ma5menu__icon-toggle"><i class="fa fa-bars"></i></span> <span
                class="ma5menu__sr-only">Menu</span>
        </button>

        <!-- mobile menu toggle button end -->
        <div style="display: none;">
            <!-- source for mobile menu start -->
            <ul class="site-menu">
                <li>
                    <a href="#">Produkter</a>
                    <ul>
                        <?php
                        foreach (getProdukters() as $categories) {
                        ?>
                        <li><a href="#"><?= $categories->name ?></a>
                            <ul>
                                <?php
                                foreach (getSub_produkters($categories->id) as $subProdukter) { ?>
                                <li>
                                    <a href="<?= url('/' . utf8_encode($subProdukter->url)) ?>"><?= $subProdukter->name ?></a>
                                </li>

                                <?php } ?>
                            </ul>
                        </li>
                        <?php } ?>
                    </ul>
                </li>
                <?php
                foreach (getMenu() as $menu1 ) {
                if (sizeof(getSubMenu($menu1->id)) == 0) {
                ?>
                <li>
                    <a href="<?php echo url('/') . utf8_encode($menu1->url); ?>"><?= $menu1->name; ?></a>
                </li>
                <?php } else { ?>
                <li>
                    <a href="#"><?= utf8_encode($menu1->name); ?></a>
                    <ul>
                        <?php
                        foreach (getSubMenu($menu1->id) as $submenu1) {
                        ?>
                        <li>
                            <a href="<?= url('/') . utf8_encode($submenu1->url) ?>"> <?= $submenu1->name ?></a>
                        </li>
                        <?php } ?>
                    </ul>
                </li>
                <?php }
                } ?>
            </ul>
            <!-- source for mobile menu end -->
        </div>
    </div> <!-- /mobile-menu -->

</header>


<!-- search-overlay -->
<div class="search-overlay d-none">
    <div class="search-outpup">
        <div class="produkter">
            <h3>Produkter <span id="checkCounting">0 </span> <span> af</span> <span id="modelResultCount">0</span></h3>
            <a href="#" class="seeAll">Se alle</a>
        </div>

        <div class="pro_scroll">
            <div id="searchData"></div>
            <div class="produkter">
                <h3>Vejledninger <span id="contentCounting">0</span> <span> af</span> <span
                        id="modelContentResultCount">0</span></h3>
                <a href="#" class="seeAll">Se alle</a>
            </div>
            <div id="searchDoc"></div>

            <div id="pageData"></div>
            <div class="produkter">
                <h3>Pages <span id="checkPageCounting">0</span> <span> af</span> <span
                        id="modelPageResultCount">0</span></h3>
                <a href="#" class="seeAll">Se alle</a>
            </div>
            <div id="searchPage"></div>
        </div>

    </div>

    <div class="footer_search">
        <a href="#" class="alle-resultater">Se alle resultater</a>
    </div>
</div> <!-- /search-overlay -->

<!-- basket-box -->

<div class="basket-box d-none">
    <div class="media-sec">
        <?php
        if (isset($cartDetails['cartList']->lines)){
        foreach($cartDetails['cartList']->lines as $cartData)
        {
        $pImage = getProductImage($cartData->productNumber);
        if($pImage->url !=''){
            $url = asset('').$pImage->url;
        }else{
            $url = asset('assets/img/no-image.png');
        }
        ?>
        <div class="media">
            <div class="media-left">
                <a href="<?= url('produkt',['null',$pImage->id, Str::slug($pImage->api_name)]);?>"><img src="<?= $url?>" alt="" class="img-fluid"></a>
            </div>

            <div class="media-body">
                <a href="javascript:">
                </a><h3><a href="javascript:"></a><a href="<?= url('produkt',['null',$pImage->id, Str::slug($pImage->api_name)]);?>"><?= $pImage->api_name?></a>
                </h3>
                <ul>
                    <li><a href="<?= url('produkt',['null',$pImage->id, Str::slug($pImage->api_name)]);?>"><?= $cartData->productNumber?></a>
                    </li>
                    <li>Antal: <span><?= $cartData->quantity?></span></li>
                </ul>
                <?php
                if (isset($cartPrice[$cartData->productNumber]) && $pImage->hide_amount !='1'){
                $ss[] = $cartData->sellPrice;
                ?>
                <h5>Pris: <?= $cartData->sellPrice;?> kr. ekskl. moms</h5>
                <h5><span class="green" style="background-color: <?= $cartPrice[$cartData->productNumber]->availability->color?>"></span><?= $cartPrice[$cartData->productNumber]->availability->text?> </h5>
                <?php }else{ ?>
                <h5><span class="green" style="background-color: #FFFFFF"></span>Ring for en pris </h5>
                <?php }?>
            </div>
        </div>
        <?php  }
        }
        ?>
    </div>
    <div class="totle-price">
        <ul>
            <?php if(isset($ss)) { echo " <li>I alt</li>"; }?>
            <li><?php if(isset($ss)) { echo array_sum($ss) ." kr. ekskl. moms"; } else{ "00.00  kr. ekskl. moms"; } ?></li>
        </ul>
    </div>

    <a href="<?php if(isset($ss)) { echo url('/cart');} else{ echo "javascript:;";}?>" class="btn checkout-btn" >Gå til kurv</a>
</div>

<!-- /basket-box -->

<!------ Sign out section ------>

<div class="userBox-section d-none">
    <ul>
        <?php
        if (\Session::get('api_token')){
        if (!empty(Session::get('customer_token'))){
        ?>
        <li><a href="<?= url('customer/account-page')?>">Account</a></li>
        <?php }else{?>
        <li><a href="<?= url('admin/account-page')?>">Account</a></li>
        <?php }?>
        <li><a href="<?= url('/customer/logout')?>">Logout</a></li>
        <?php }else{?>
        <li><a href="<?= url('/login-register')?>">Login</a></li>
        <?php }?>
    </ul>
</div>

<!-- ===============Header section code End================ -->
<div class="fixed-button-code">
    <ul>
        <li><a href="javascript:void(0);" data-toggle="modal" data-target="#kontakt_os"> Kontakt os</a></li>
        <li><a href="javascript:void(0);" data-toggle="modal" data-target="#bliv_op"> Bliv ringet op </a></li>
    </ul>
</div>

<!-- The Modal -->
<div class="modal kontakt-modal" id="kontakt_os">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Kontakt os</h4>
                <p><?= kontakat_os()[0]->data?></p>
                <button type="button" class="close" data-dismiss="modal"><img
                        src="{{ asset('assets/img/close-pop.png') }}" alt="" class="img-fluid"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{route('sendEmail_kontakt')}}" method="post" autocomplete="off" id="konkatForm">
                            @csrf
                            <div class="form-group">
                                <label for="emne">Emne</label>
                                <input type="text" name="subject"  placeholder="Emne" class="form-control" required>
                                <input type="hidden" name="area"  value="<?= $chkArea;?>" class="form-control" required>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 form-group">
                                    <label for="fornavn">Fornavn</label>
                                    <input type="text" name="firstName" placeholder="Fornavn"
                                           class="form-control" required>
                                </div>
                                <div class="col-lg-6 form-group">
                                    <label for="efternavn">Efternavn</label>
                                    <input type="text" name="lastName" placeholder="Efternavn"
                                           class="form-control" >
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 form-group">
                                    <label for="email">E-mail</label>
                                    <input type="email" name="email"  placeholder="E-mail"
                                           class="form-control" >
                                </div>
                                <div class="col-lg-6 form-group">
                                    <label for="telefonnummer">Telefonnummer</label>
                                    <input type="text" name="phoneNumber" placeholder="Telefonnummer" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="din-besked">Din besked</label>
                                <textarea name="message"  cols="30" rows="10"
                                          class="form-control" ></textarea>
                                <input type="hidden" name="form" value="Call me">
                            </div>
                            <div class="form-group">
                                <button class="btn send-besked" type="submit"><?= kontakat_os()[1]->data?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- The Modal -->
<div class="modal kontakt-modal" id="bliv_op">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Bliv ringet op</h4>
                <p><?= bliv_ringet()[1]->data?></p>
                <button type="button" class="close" data-dismiss="modal"><img
                        src="{{ asset('assets/img/close-pop.png') }}" alt="" class="img-fluid"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{route('sendEmail_kontakt')}}" method="post" autocomplete="off" id="blivForm">
                            @csrf
                            <div class="form-group">
                                <label for="emne">Emne</label>
                                <input type="text" name="subject"  placeholder="Emne" class="form-control" required>
                                <input type="hidden" name="area"  value="<?= $chkArea;?>" class="form-control">
                            </div>

                            <div class="row">
                                <div class="col-lg-6 form-group">
                                    <label for="fornavn">Fornavn</label>
                                    <input type="text" name="firstName"  placeholder="Fornavn" class="form-control" required>
                                </div>

                                <div class="col-lg-6 form-group">
                                    <label for="efternavn">Efternavn</label>
                                    <input type="text" name="lastName"  placeholder="Efternavn" class="form-control">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 form-group">
                                    <label for="email">E-mail</label>
                                    <input type="email" name="email"  placeholder="E-mail" class="form-control">
                                </div>

                                <div class="col-lg-6 form-group">
                                    <label for="telefonnummer">Telefonnummer</label>
                                    <input type="text" name="phoneNumber" placeholder="Telefonnummer" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="din-besked">Din besked</label>
                                <textarea name="message"  cols="30" rows="10" class="form-control"></textarea>
                                <input type="hidden" name="form" value="Send message">
                            </div>

                            <div class="form-group">
                                <button class="btn send-besked" type="submit"><?= bliv_ringet()[2]->data?></button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- The Modal -->
<div class="modal kontakt-modal" id="anmeld_servicesag">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Anmeld servicesag</h4>
                <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy <br>
                    invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.</p>
                <button type="button" class="close" data-dismiss="modal"><img
                        src="{{ asset('assets/img/close-pop.png') }}" alt="" class="img-fluid"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <form action="">
                            <div class="form-group">
                                <label for="emne">Emne</label>
                                <input type="text" name="emne" id="emne" placeholder="Emne" class="form-control">
                            </div>

                            <div class="row">
                                <div class="col-lg-6 form-group">
                                    <label for="fornavn">Fornavn</label>
                                    <input type="text" name="fornavn" id="fornavn" placeholder="Fornavn"
                                           class="form-control">
                                </div>

                                <div class="col-lg-6 form-group">
                                    <label for="efternavn">Efternavn</label>
                                    <input type="text" name="efternavn" id="efternavn" placeholder="Efternavn"
                                           class="form-control">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 form-group">
                                    <label for="email">E-mail</label>
                                    <input type="email" name="email" id="email" placeholder="E-mail"
                                           class="form-control">
                                </div>

                                <div class="col-lg-6 form-group">
                                    <label for="telefonnummer">Telefonnummer</label>
                                    <input type="text" name="telefonnummer" id="telefonnummer"
                                           placeholder="Telefonnummer" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="din-besked">Din besked</label>
                                <textarea name="din-besked" id="din-besked" cols="30" rows="10"
                                          class="form-control"></textarea>
                            </div>

                            <div class="form-group">
                                <button class="btn send-besked">Send besked</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


@yield('content')

<!-- ================Mail Section Code Start==================== -->
<section>
    <div class="mail-section">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-6 col-sm-6">
                    <div class="mail-text">
                        <p style="width: 55%">{{newsletters()->news_heading}}</p>
                    </div>
                </div>

                <div class="col-md-6 col-sm-6">
                    <div class="newsLetters">
                        <div class="newsletter_bttn">
                            <div class="b__btn">
                                <div class="form-group">
                                    <input type="checkbox" id="html" value="landmailing">
                                    <label for="html">{{newsletters()->landmailing_heading}}</label>
                                </div>
                                <div class="form-group">
                                    <input type="checkbox" id="css" value="landburg">
                                    <label for="css">{{newsletters()->landburg_heading}}</label>
                                </div>
                            </div>
                        </div>

                        <div class="mail-button text-right">
                            <input type="text" placeholder="Email" id="newsEmail">
                            <button type="button" class="mail-btn">Tilmeld</button>
                        </div>

                        <div class="newsletter_bttn">
                            <div class="b__btn">
                                <div class="form-group">
                                    <input type="checkbox" id="javascript" value="privacy">
                                    <label for="javascript">Jeg accepterer Geoteams </label> <a href="{{url('/')}}{{newsletters()->policy_link}}">privatlivspolitik</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ================Mail Section Code End==================== -->
<!-- ================Footer Section Code Start==================== -->

<footer>
    <div class="footer-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2">
                    <div class="footer-menu">
                        <ul>
                            <li>Geoteam A/S</li>
                            <li>Energivej 34 2750 Ballerup</li>
                            <li>Tlf. +45 7733 2233</li>
                            <li>CVR 28828633</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="footer-menu">
                        <ul>
                            <li>Åbningstider:</li>
                            <li>Mandag - torsdag: 8:00 - 16.00</li>
                            <li>Fredag: 8:00 - 15.30</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="footer-menu">
                        <ul>
                            <?php
                            foreach ($footer as $fData) {
                            if ($fData->status == 1) {
                            ?>
                            <li>
                                <a href="<?php echo $fData->url; ?>"><?php echo $fData->heading ?></a>
                            </li>
                            <?php }
                            } ?>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="footer-social-media text-right">
                        <ul>
                            <li><a href="{{getDefaultId()->linkedin}}" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="{{getDefaultId()->facebook}}" target="_blank"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="{{getDefaultId()->youtube}}" target="_blank"><i class="fa fa-youtube-play"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- ================Footer Section Code End==================== -->

<script src="{{ asset('assets/js/jquery.zoom.js') }}"></script>
<script src="{{ asset('assets/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets/js/custom-select.js') }}"></script>
<script src="{{ asset('assets/js/ma5-menu.min.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>
<script>
    $(document).ready(function () {
        $('#myModal').modal('show');
    });
</script>
<script>
    $(document).ready(function (){
        var str = window.location.href;
        var test = str.split("/service-support/");

        if (test[1] != undefined){
            $.ajax({
                type: "GET",
                //url: "http://geoteamdemo.info/trimble?page="+test[1],
                url: "http://geoteamdemo.info/trimble?page="+test[1],
                //url: "http://localhost/geoteam_new/trimble?page="+test[1],

                success: function (data) {
                    // console.log(data)
                    $('#trimble_menu').html(data);
                }
            })
        }
        $('.mail-btn').click(function (){
            if($("#html").prop('checked') == false && $("#css").prop('checked') == false){
                toastMixin.fire({
                    title: 'Please select at least one area',
                    icon: 'error'
                });
            }
            else if($("#javascript").prop('checked') == false && $("#css").prop('checked') == false){
                toastMixin.fire({
                    title: 'Please select privacy policy.',
                    icon: 'error'
                });
            }
            else if($("#newsEmail").val() === ''){
                toastMixin.fire({
                    title: 'Please enter your email-id',
                    icon: 'error'
                });
            }
            else{
                if($("#html").prop('checked') == true){
                    var landmailing = $('#html').val();
                }else{
                    var landmailing = "";
                }
                if($("#css").prop('checked') == true){
                    var landburg = $('#css').val();
                }else{
                    var landburg = "";
                }
                $.ajax({
                    type: "GET",
                    url: "<?= route('mailchimp')?>",
                    data: "landmailing=" + landmailing + '&_token=<?= csrf_token()?>' + '&landburg=' + landburg + '&email=' + $("#newsEmail").val(),
                    success: function (data) {
                        console.log(data)
                        if (data.status == 1){
                            toastMixin.fire({
                                title: data.message,
                                icon: 'error'
                            });
                        }
                        else if (data.status == 0){
                            toastMixin.fire({
                                title: data.message,
                                icon: 'error'
                            });
                        } else{
                            toastMixin.fire({
                                title: 'You have successfully subscribed to our newsletter.',
                                icon: 'success'
                            });
                            setTimeout(function() {
                                window.location.reload();
                            }, 3000);
                        }
                    }
                })
            }
        })
    })
</script>
<script>
    $("#myform").validate({

        rules: {

            cvr: {
                required: true,
            },
            customerName: {
                required: true,
            },
            fullName: {
                required: true,
            },
            address1: {
                required: true,
            },
            postalNo: {
                required: true,
            },
            postalCity: {
                required: true,
            },
            phone: {
                required: true,
            },
            email: {
                required: true,
            },
            password: {
                required: true,
                minlength: 8
            },
            confirm: {
                required: true,
                equalTo: "#password1"
            },
            check2: {
                required: true,
            },

            name: {
                required: true,
            },
            address: {
                required: true,
            },
            address2: {
                required: true,
            },
            countryCode: {
                required: true,
            },
            contact: {
                required: true,
            },
            deliveryAddressCode: {
                required: true,
            },
        },

        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    });

</script>

<script>

    $(document).ready(function () {
        $(document).on('click', '.flex a', function (event) {
            event.preventDefault();
            $('li').removeClass('active');
            $(this).parent('li').addClass('active');
            var myurl = $(this).attr('href');
            var page = $(this).attr('href').split('page=')[1];
            getData(page);
        });
        // getallData();
    });

    function getData(page) {
        var myAssociativeArr = [];
        var allChecked = true;
        $('#search_result').empty();
        $("input[type='checkbox']:checked.checkB").each(function (index, element) {
            if (!element.checked) {
                allChecked = false;
            }
            var newElement = {};
            newElement[$(this).attr('data-id')] = $(this).val();
            myAssociativeArr.push(newElement);
        });
        var imgUrl = "<?= url('/')?>";
        var sort = $('#sort').val();
        var resultDoc = '';
        var resultPage = '';

        var productImg = "public/assets/img/no-product.png";
        $.ajax({
            type: "GET",
            url: "{{url('getProdukt_Result')}}",
            data: "data=" + JSON.stringify(myAssociativeArr) + '&_token={{ csrf_token() }}' + '&sort=' + sort + '&page=' + page + '&name=' + name,
            beforeSend: function () {
                $(".se_loader").css('display', 'block');
            },
            success: function (data) {
                // console.log(data);
                var x = 0;
                data.products.data.forEach(function (item) {
                    productImg = "public/assets/img/no-product.png";
                    if (item.url != '') {
                        productImg = item.url;
                    }
                    $('#search_result').append(' <div class="media-custom"> <div class="media-left"> <a href="<?= url('/produkt/null/')?>/' + item.id + '/' + item.api_name + '"><img src="' + imgUrl + '/' + productImg + '" alt="'+item.alt_image+'" class="img-fluid"></a> </div><div class="media-body d-flex flex-wrap align-content-between flex-column justify-content-between"> <div class="first-sec"> <a href="<?= url('/produkt/null/')?>/' + item.id + '"> <h3>' + item.api_name + '</h3> </a> <p>' + item.api_id + '</p><p>' + item.short_text + '</p></div><ul> <li><strong>2500 kr. ekskl. moms</strong></li><li><span></span> Varen er på lager. Bestil inden kl. 14 og vi afsender i dag. </li></ul> </div><div class="media-right"> <a href="#" id="'+item.api_id+'"  onclick="searchaddCart('+item.id+')" class="add-basket '+item.id+'">Læg i kurv</a> </div></div>')
                    x++;
                });

                data.content.contents.data.forEach(function (item) {
                    console.log(item)
                    var routes = "<?= url('/produkt')?>/" + item.id + "/" + item.api_name;
                    if (item.type == "guide" || item.type == "video" || item.type == "file") {
                        resultDoc += ' <div class="media-custom"> <div class="media-left"> <a href="#"><img src="' + baseUrl + '/assets/img/s4.png"  alt="'+item.alt_image+'" class="img-fluid"></a> </div><div class="media-body"> <a href="#"> <h3>' + item.name + '</h3> </a> <p>' + item.description + '</p></div><div class="media-right"> <a href="#" class="add-basket">Hent</a> </div></div>';
                    }
                });

                data.page.contents.data.forEach(function (item) {
                    resultPage += ' <div class="media-custom"> <div class="media-left"> <a href="' + item.link + '"><img src="' + baseUrl + '/assets/img/s4.png"  alt="'+item.alt_image+'" class="img-fluid"></a> </div><div class="media-body"> <a href="' + item.link + '"> <h3>' + item.name + '</h3> </a> <p>' + item.description + '</p></div><div class="media-right"> </div></div>';
                });


                // console.log(data);
                $('#pageContent').html(resultPage)
                $('#searchContent').html(resultDoc)
                $('#contentCount').html('(' + data.content.totalCount + ')')
                $('#pageCount').html('(' + data.page.totalCount + ')')
                $('#pagination').html(data.links)
                $('#countProduct').html(data.totalProducts)
                $('#modelResultCount').html(data.totalProducts)
                $('.se_loader').delay(500).fadeOut('slow');
            }
        });
    }

    function getallData() {

        var myAssociativeArr = [];
        var contents = [];
        var allChecked = true;
        $('#search_result').empty();
        $("input[type='checkbox']:checked.checkB").each(function (index, element) {
            if (!element.checked) {
                allChecked = false;
                // return false;
            }
            var newElement = {};
            newElement[$(this).attr('data-id')] = $(this).val();
            myAssociativeArr.push(newElement);
        });

        $("input[type='checkbox']:checked.selecteddId4").each(function (index, element) {
            if (!element.checked) {
                allChecked = false;
                // return false;
            }
            var newElements = {};
            newElements = $(this).val();
            contents.push(newElements);
        });


        // console.log(myAssociativeArr)
        var imgUrl = "<?= url('/')?>";
        var sort = $('#sort').val();
        var productImg = "public/assets/img/no-product.png";
        $.ajax({
            type: "GET",
            url: "{{url('getProdukt_Result')}}",
            data: "content_area=" + JSON.stringify(contents) + "&data=" + JSON.stringify(myAssociativeArr) + '&_token={{ csrf_token() }}' + '&sort=' + sort + '&name=' + name,
            beforeSend: function () {
                $(".se_loader").css('display', 'block');
            },
            success: function (data) {
                // console.log(data);
                var x = 0;
                var resultDoc = '';
                var resultPage = '';
                var baseUrl = "<?= url('/public')?>";
                data.products.data.forEach(function (item) {
                    productImg = "public/assets/img/no-product.png";
                    if (item.url != '') {
                        // console.log(data.products.data[x])
                        productImg = item.url;
                    }

                    //console.log(item.alt_image)

                    if (item.hide_amount == 0 && item.priceApi) {
                        // if (item.hide_amount == 0 && item.priceApi.basePrice != undefined) {
                        var color = item.priceApi.availability.color;
                        var apiText = item.priceApi.availability.text;
                        let number = item.priceApi.basePrice;
                        number = number.toLocaleString();
                        var apiPrice = parseFloat(number.replace(/,/gi, ".")) + '  kr. ekskl. moms';
                        var optCss = "style='background-color:" + color + "'";
                    } else {
                        var color = '';
                        var apiText = '';
                        var apiPrice = 'Ring for en pris';
                        var optCss = "style='background-color:white'";
                    }
                    var pName = item.api_name.replace(/ /g, "-")
                    var ppName = pName.replace(/\//gi, "-");
                    var pUrl = item.id+'/'+  ppName.replace(/"/g, "");
                    //console.log(pUrl);
                    $('#search_result').append(' <div class="media-custom"> <div class="media-left"> <a href="<?= url('/produkt/null/')?>/' + item.id + '/' + pUrl + '"><img src="' + imgUrl + '/' + productImg + '" alt="'+item.alt_image+'"  class="img-fluid"></a> </div><div class="media-body d-flex flex-wrap align-content-between flex-column justify-content-between"> <div class="first-sec"> <a href="<?= url('/produkt/null/')?>/'+pUrl+'"> <h3>' + item.api_name + '</h3> </a> <p><a href="<?= url('/produkt/null/')?>/'+pUrl+'">' + item.api_id + '</a></p><p>' + item.short_text + '</p></div><ul> <li><strong>' + apiPrice + '</strong></li><li><span ' + optCss + '></span>' + apiText + '</li></ul> </div><div class="media-right">  <a href="#" id="'+item.api_id+'"  onclick="searchaddCart('+item.id+')" class="add-basket '+item.id+'">Læg i kurv</a> </div></div>')
                    x++;
                });

                data.content.contents.data.forEach(function (item) {
               var fileLocation =  "<?= asset('').'/'?>"+item.file_url;
                    // if (item.type =="guide" || item.type =="video" ||  item.type =="file"){
                    resultDoc += ' <div class="media-custom"> <div class="media-left"> <a href="'+fileLocation+'" target="_blank"><img src="' + baseUrl + '/assets/img/s4.png"  alt="'+item.alt_image+'"  class="img-fluid"></a> </div><div class="media-body"> <a href="'+fileLocation+'" target="_blank"> <h3>' + item.name + '</h3> </a> <p>' + item.description + '</p></div><div class="media-right"> <a target="_blank" href="' + fileLocation + '" class="add-basket">Hent</a> </div></div>';
                    // }
                });

                data.page.contents.data.forEach(function (item) {
                    resultPage += ' <div class="media-custom"> <div class="media-left"> <a href="' + item.link + '" target="_blank"><img src="' + baseUrl + '/assets/img/s4.png"  alt="'+item.alt_image+'"  class="img-fluid"></a> </div><div class="media-body"> <a href="' + item.link + '" target="_blank"> <h3>' + item.name + '</h3> </a> <p>' + item.description + '</p></div><div class="media-right"> </div></div>';
                });

                // console.log(data);
                $('#pageContent').html(resultPage)
                $('#searchContent').html(resultDoc)
                $('#contentCount').html('(' + data.content.totalCount + ')')
                $('#pageCount').html('(' + data.page.totalCount + ')')
                $('#pagination').html(data.links)
                $('#countProduct').html(data.totalProducts)
                $('#modelResultCount').html(data.totalProducts)
                $('.se_loader').delay(500).fadeOut('slow');

            }
        });
    }

</script>

<script>
    function searchaddCart(data) {
        var api_id = $('.'+data).attr('id');
        var simNumber = null

        $.ajax({
            type: "POST",
            url: "<?= route('cart_add_subscription')?>",
            // data: "api_id=" + api_id + '&_token=<?= csrf_token()?>'+'&qty='+$('#antal').val()+'&unitPrice='+$('.unitPrice').html()+'&sellPrice='+$('.sellPrice').html(), // For Static Code
            data: 'phy_productId='+data+'&_token=<?= csrf_token()?>'+'&qty=1&simNumber='+simNumber,
            beforeSend: function () {
                $("#pre-loader").removeClass('d-none');
            },
            success: function (data) {
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

<script>
    function addCart(data) {
        var api_id = $('.'+data).attr('id');
        var simNumber = null
        <?php if (isset($productDetails->id)){ $PPDetails = $productDetails->id; }else{ $PPDetails=''; }?>
        $.ajax({
            type: "POST",
            //url: "<?= route('cart_add')?>",  // For Static Code
            url: "<?= route('cart_add_subscription')?>",
            // data: "api_id=" + api_id + '&_token=<?= csrf_token()?>'+'&qty='+$('#antal').val()+'&unitPrice='+$('.unitPrice').html()+'&sellPrice='+$('.sellPrice').html(), // For Static Code
            data: 'phy_productId=<?= $PPDetails?>&_token=<?= csrf_token()?>'+'&qty='+$('#antal').val()+'&simNumber='+simNumber,
            beforeSend: function () {
                $("#pre-loader").removeClass('d-none');
            },
            success: function (data) {
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

<script>
    function checkCounting(data) {
        if (data <= 3 && data >= 0) {
            return data;
        } else if (data > 3) {
            return 3;
        }
    }


    $(document).ready(function () {
        $('.searchright').on('keyup', function () {
            var keyword = $(this).val();
            var imgUrl = "<?= url('/')?>";
            if (keyword.length > 2) {
                $('.search-overlay').removeClass('d-none');
                $.ajax({
                    type: "GET",
                    url: "{{url('getProdukt_Result')}}",
                    data: "name=" + keyword + '&_token={{ csrf_token() }}' + '&sort=1&headerSearchToken=1',
                    success: function (data) {
                        // console.log(data)
                        var y = 0;
                        var x = 0;
                        var z = 0;
                        var resultData = '';
                        var resultDoc = '';
                        var resultPage = '';
                        var baseUrl = "<?= url('/public')?>";
                        data.products.data.forEach(function (item) {
                            // console.log(item.priceApi);
                            // console.log(item.hide_amount);
                            y++;
                            if (y <= 3) {
                                var productImg = "public/assets/img/no-product.png";
                                if (item.url != '') {
                                    productImg = item.url;
                                }

                                if (item.hide_amount == 0 && item.priceApi) {
                                    // if (item.hide_amount == 0 && item.priceApi.basePrice != undefined) {
                                    var color = item.priceApi.availability.color;
                                    var apiText = item.priceApi.availability.text;
                                    let number = item.priceApi.basePrice;
                                    number = number.toLocaleString();
                                    var apiPrice = parseFloat(number.replace(/,/gi, ".")) + '  kr. ekskl. moms';
                                    var optCss = "style='background-color:" + color + "'";
                                } else {
                                    var color = '';
                                    var apiText = '';
                                    var apiPrice = 'Ring for en pris';
                                    var optCss = "style='background-color:white'";
                                }
                                var productName = item.api_name;
                                var pproductName = productName.replace(/\//gi, "-");

                                var route = "<?= url('/produkt/null/')?>/" + item.id + '/' + pproductName.replace(/ /g, "-");

                                if (item.is_subscription =='1'){
                                    var delCart = ' d-none';
                                }else{
                                    var delCart = '';
                                }
                                resultData += '<div class="media-custom"> <div class="media-left"> <a href="' + route + '"><img src="' + imgUrl + '/' + productImg + '" alt="'+item.alt_image+'" class="img-fluid"></a> </div><div class="media-body"> <a href="' + route + '"> <h3>' + item.api_name + '</h3> </a> <p>' + item.api_id + '</p><p>' + item.short_text + '</p><ul> <li><strong>' + apiPrice + '</strong></li><li><span ' + optCss + '></span> ' + apiText + '</li></ul> </div><div class="media-right"> <a href="#" id="'+item.api_id+'" onclick="searchaddCart('+item.id+')" class="add-basket '+item.id+delCart+'">Læg i kurv</a> </div></div>';
                            }
                        });

                        data.content.contents.data.forEach(function (item) {
                            x++;
                            var pName = item.name
                            var ppName =  pName.replace(/\//gi, "-");
                            var routes = "<?= url('/produkt/null/')?>/" + item.id + '/' +  ppName.replace(/ /g, "-");
                            if (x <= 3) {
                                // console.log(item.link)
                                if (item.type == "guide" || item.type == "video" || item.type == "file") {
                                    // console.log(item)
                                    var fileUrl = "#";
                                    if (item.file_url != null) {
                                        var fileUrl = "<?= asset('').'/'?>"+item.file_url;
                                       // console.log(fileUrl)
                                    }
                                    resultDoc += ' <div class="media-custom"> <div class="media-left"> <a href="' + fileUrl + '" target="_blank"><img src="' + baseUrl + '/assets/img/s4.png"  alt="'+item.alt_image+'" class="img-fluid"></a> </div><div class="media-body"> <a href="' + fileUrl + '" target="_blank"> <h3>' + item.name + '</h3> </a> <p>' + item.description + '</p></div><div class="media-right"> <a href="' + fileUrl + '" target="_blank" class="add-basket">Hent</a> </div></div>';
                                } else {
                                    resultDoc += ' <div class="media-custom"> <div class="media-left"> <a href="#"><img src="' + baseUrl + '/assets/img/s4.png"  alt="'+item.alt_image+'" class="img-fluid"></a> </div><div class="media-body"> <a href="#"> <h3>' + item.name + '</h3> </a> <p>' + item.description + '</p></div></div>';
                                }
                            }
                        });

                        data.page.contents.data.forEach(function (item) {
                            z++;
                            if (z <= 3) {
                                //console.log(item)
                                resultPage += ' <div class="media-custom"> <div class="media-left"> <a href="' + item.link + '" target="_blank"><img src="' + baseUrl + '/assets/img/s4.png"  alt="'+item.alt_image+'" class="img-fluid"></a> </div><div class="media-body"> <a href="' + item.link + '" target="_blank"> <h3>' + item.name + '</h3> </a> <p>' + item.description + '</p></div><div class="media-right"></div></div>';
                            }
                        });

                        // console.log(data)
                        $('#searchPage').html(resultPage);
                        $('#searchDoc').html(resultDoc);
                        $('#checkCounting').html(checkCounting(data.totalProducts))
                        $('#checkPageCounting').html(checkCounting(data.page.totalCount))
                        $('#contentCounting').html(checkCounting(data.content.totalCount))
                        $('#searchData').html(resultData);
                        $('#countProduct').html(data.totalProducts)
                        $('#modelResultCount').html(data.totalProducts)
                        $('#modelContentResultCount').html(data.content.totalCount)
                        $('#modelPageResultCount').html(data.page.totalCount)
                    }
                });
            }else{
                $('#searchPage').html('');
                $('#searchDoc').html('');
                $('#checkCounting').html(checkCounting(0))
                $('#checkPageCounting').html(checkCounting(0))
                $('#contentCounting').html(checkCounting(0))
                $('#searchData').html('');
                $('#countProduct').html(0)
                $('#modelResultCount').html(0)
                $('#modelContentResultCount').html(0)
                $('#modelPageResultCount').html(0)
            }
        });
    })

</script>

<script>
    $(document).ready(function () {
        $('.alle-resultater').click(function () {
            var route = "<?= url('/search-produkt')?>?name=" + $('.search').val();
            window.location.href = route;
        })
    })
</script>
<script>
    $(document).ready(function () {
        $('title').html('<?= 'Geoteam ' . $title?>')
    })
</script>
<script>
    $(document).ready(function () {
        $('#searchButton').click(function () {
            var searchData = $('#search').val();
            if (searchData.length > 0) {
                window.location.href = "<?= url('/search-produkt?name=')?>" + searchData;
            }
        });

        $('.seeAll').click(function () {
            window.location.href = "<?= url('/search-produkt?name=')?>" + $('.searchright').val();
        })
    })

    <?php
    if (isset($_GET['name'])){
    ?>
    var name = "<?= $_GET['name']?>";
    <?php }else{ ?>
    var name = '';
    <?php }?>
</script>

<script>
    var toastMixin = Swal.mixin({
        toast: true,
        icon: 'success',
        title: 'General Title',
        animation: false,
        position: 'center-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });

    document.querySelector(".first").addEventListener('click', function(){
        Swal.fire({
            toast: true,
            icon: 'success',
            title: 'Posted successfully',
            animation: false,
            position: 'bottom',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })
    });

    document.querySelector(".second").addEventListener('click', function(){
        toastMixin.fire({
            animation: true,
            title: 'Signed in Successfully'
        });
    });

    document.querySelector(".third").addEventListener('click', function(){
        toastMixin.fire({
            title: 'Wrong Password',
            icon: 'error'
        });
    });

</script>

<script>
    $("#blivForm").validate({
        rules: {
            password: "required",
            email: {
                required: false,
                email:true
            },
            phoneNumber: {
                required: true,
                number: true,
            },
        },
        submitHandler:function(){
            $.ajax({
                type        : 'POST',
                url         : "{{route('sendEmail_kontakt')}}",
                data        :new FormData( $("#blivForm")[0] ),
                async : false,
                cache : false,
                contentType : false,
                processData : false,
                success: function(data)
                {
                    if(data.status == 1 ){
                        toastMixin.fire({
                            title: data.message,
                            icon: 'success'
                        });
                        setTimeout(function() {
                            location.reload();
                        }, 4000);
                    }
                    else{
                        toastMixin.fire({
                            title: data.message,
                            icon: 'error'
                        });
                    }
                }
            });
            return false;
        }
    });
</script>

<script>
    $("#konkatForm").validate({
        rules: {
            password: "required",
            email: {
                required: false,
                email:true,
            },
            phoneNumber: {
                required: true,
                number: true,
            },
        },
        submitHandler:function(){
            $.ajax({
                type        : 'POST',
                url         : "{{route('sendEmail_kontakt')}}",
                data        :new FormData( $("#konkatForm")[0] ),
                async : false,
                cache : false,
                contentType : false,
                processData : false,
                success: function(data)
                {
                    if(data.status == 1 ){
                        toastMixin.fire({
                            title: data.message,
                            icon: 'success'
                        });
                        setTimeout(function() {
                            location.reload();
                        }, 4000);
                    }
                    else{
                        toastMixin.fire({
                            title: data.message,
                            icon: 'error'
                        });
                    }
                }
            });
            return false;
        }
    });
</script>
@yield('js')
</body>

</html>
