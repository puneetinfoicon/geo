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
<!-- overlay_menubg -->
<div class="overlay_menubg">
    <div class="menuClose">
        <img src="<?php echo str_replace(request()->path(), "", url()->current()); ?>assets/img/close.png">
    </div>
</div>
<!-- /overlay_menubg -->

<header class="<?= $class; ?>"><!-- onlly-home-page:-  header home-header -->
    <div class="container-fluid">
        <div class="search-desktop">
            <form action="/" method="get">
                <input class="search-des searchright" id="" type="search" name="q" placeholder="Skriv for at søge" autocomplete="off">
                <label class="search-label" for="searchright"><img
                        src="<?php echo str_replace(request()->path(), "", url()->current()); ?>assets/img/search.png"></label>
            </form>
        </div>
        <div class="row align-items-center">
            <div class="col-md-10 col-sm-8 col-7 mb-12">
                <div class="nav-section">
                    <div class="logo">
                        <a href="<?php echo str_replace(request()->path(), "", url()->current()); ?>">
                            <img
                                src="<?php echo str_replace(request()->path(), "", url()->current()); ?>assets/img/logo.svg"
                                class="logo-def">
                            <img
                                src="<?php echo str_replace(request()->path(), "", url()->current()); ?>assets/img/logo-icon.svg"
                                class="logo-icon">
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
                                                            <a href="<?= url('/' . utf8_encode($subProdukter->url)) ?>"> <?= $subProdukter->name; ?> </a>
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
                                            <a href="<?php echo url('/') . utf8_encode($menu->url); ?>"><?= $menu->name; ?></a>
                                        </li>
                                    <?php } else {
                                        ?>
                                        <li class="dropdown ">
                                            <a  href="<?= url('/' . utf8_encode($menu->url)) ?>"
                                                id="navbarDropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                <?= $menu->name; ?>
                                            </a>

                                            <ul class="dropdown-menu kontact-dropdown"
                                                aria-labelledby="navbarDropdownMenuLink1">
                                                <?php
                                                foreach (getSubMenu($menu->id) as $submenu) {
                                                    ?>
                                                    <li>
                                                        <a href="<?= url('/') . utf8_encode($submenu->url) ?>"><?= $submenu->name ?></a>
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

            <div class="col-md-2 col-sm-4 col-5 mb-12">
                <!-- right-header -->
                <div class="right-header">
                    <ul>
                        <li class="search-icon mobile_hide">
                            <div class="search-container">
                                <form action="<?= url('/search-produkt')?>" method="get" autocomplete="off">
                                    <input class="search expandright searchright" id="searchright" type="search" name="name"
                                           placeholder="Skriv for at søge">
                                    <label class="button searchbutton" for="searchright"><img
                                            src="<?php echo str_replace(request()->path(), "", url()->current()); ?>assets/img/icon/Icon-search.svg"></label>
                                </form>
                            </div>
                        </li>
                        <li class="basket-icon"><a href="javascript:void(0);"><img
                                    src="<?php echo str_replace(request()->path(), "", url()->current()); ?>assets/img/icon/Icon-basket.svg">
                                <span><?= $cartDetails['cartCnt']; ?></span></a></li>
                        <li class="acuser-icon"><a
                                href="javascript:;"><img
                                    src="<?php echo str_replace(request()->path(), "", url()->current()); ?>assets/img/icon/Icon-user.svg"></a>
                        </li>
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
                <h3>Vejledninger <span id="contentCounting">0</span>  <span> af</span> <span id="modelContentResultCount">0</span> </h3>
                <a href="#" class="seeAll">Se alle</a>
            </div>

            <div id="searchDoc"></div>
            <div id="pageData"></div>
            <div class="produkter">
                <h3>Pages <span id="checkPageCounting">0</span>  <span> af</span> <span id="modelPageResultCount">0</span> </h3>
                <a href="#" class="seeAll">Se alle</a>
            </div>
            <div id="searchPage"></div>

        </div>
    </div>

    <div class="footer_search">
        <a href="#" class="alle-resultater seeAll">Se alle resultater</a>
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
                        src="<?= asset('assets/img/close-pop.png')?>" alt="" class="img-fluid"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <form action="<?= route('sendEmail_kontakt')?>" method="post" autocomplete="off" id="konkatForm">
                            <?php csrf_token()?>
                            <div class="form-group">
                                <label for="emne">Emne</label>
                                <input type="text" name="subject"  placeholder="Emne" class="form-control" required>
                                <input type="hidden" name="area"  value="<?= $chkArea;?>" class="form-control" required>
                                <input type="hidden" name="_token"  value="<?= csrf_token()?>" class="form-control">
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
                                           class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 form-group">
                                    <label for="email">E-mail</label>
                                    <input type="email" name="email"  placeholder="E-mail"
                                           class="form-control">
                                </div>
                                <div class="col-lg-6 form-group">
                                    <label for="telefonnummer">Telefonnummer</label>
                                    <input type="text" name="phoneNumber" placeholder="Telefonnummer" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="din-besked">Din besked</label>
                                <textarea name="message"  cols="30" rows="10" class="form-control" ></textarea>
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
                        src="<?= asset('assets/img/close-pop.png')?>" alt="" class="img-fluid"></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <form action="<?= route('sendEmail_kontakt')?>" method="post" autocomplete="off" id="blivForm">

                            <div class="form-group">
                                <label for="emne">Emne</label>
                                <input type="text" name="subject"  placeholder="Emne" class="form-control" required>
                                <input type="hidden" name="area"  value="<?= $chkArea;?>" class="form-control">
                                <input type="hidden" name="_token"  value="<?= csrf_token()?>" class="form-control">
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
                                <textarea name="message" cols="30" rows="10" class="form-control"></textarea>
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
                <button type="button" class="close" data-dismiss="modal"><img src="assets/img/close-pop.png" alt=""
                                                                              class="img-fluid"></button>
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

<script>
    $(document).ready(function () {
        $('title').html('<?= 'Geoteam - ' . utf8_encode($title)?>')
    })
</script>

