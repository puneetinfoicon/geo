<?php

$sliderTitle = '';
$sliderDescription = '';
$pop_up = '';
$pop_up_status = 0;
foreach (homePageData() as $sliderContent){

    if ($sliderContent->name == 'title') {
        $sliderTitle = $sliderContent->data;
    }

    if ($sliderContent->name == 'description') {
        $sliderDescription = $sliderContent->data;
    }

    if ($sliderContent->name == 'Show_Alert_header') {
        $pop_up_status = $sliderContent->data;
    }
    if ($sliderContent->name == 'Alert_header') {
        $pop_up = $sliderContent->data;
    }
    if ($sliderContent->name == 'video') {
        $vid = $sliderContent->data;
    }
}

?>

<section>
    <div class="slider-section">
        <div id="minimal-bootstrap-carousel"
             class="carousel slide carousel-fade slider-content-style slider-home-one" data-ride="carousel"
             data-interval="false">
            <!-- 6000 -->
            <div class="carousel-inner">
                <div class="carousel-item slide-1 active">
                    <div class="video-slider-filter">
                        <?php
                        if (isset($vid))
                        {
                            ?>
                            <video src="<?= asset(''.homeVideo($vid)) ?>" loop muted autoplay>
                            </video>
                            <?php
                            if ($pop_up_status ==1){
                            ?>
                            <div class="alert alert-custom bg-red alert-dismissible fade show">
                                <button type="button" class="close" data-dismiss="alert"><img src="<?= asset('')?>/assets/img/close-pop.png"
                                                                                              alt=""
                                                                                              class="img-fluid closeicon">
                                </button>
                                <img src="<?= asset('/assets/img/info.png')?>" class="img-fluid infoicon">
                                <span><?= $pop_up ?></span>
                            </div>
                        <?php }} ?>
                    </div>
                    <div class="carousel-caption">
                        <div class="container-fluid">
                            <div class="box valign-middle">
                                <div class="animated content text-left fadeIn">
                                    <h2 class="animated"><?= $sliderTitle ?></h2>
                                    <p class="animated"><?= $sliderDescription ?> </p>
                                    <div class="button-cent">
                                        <?php
                                        foreach (getArea() as $slider){
                                        ?>
                                            <a class="animated btn delicious-btn"
                                               href="<?= url('/produktkategori/' . $slider->id) ?>"><?= $slider->name ?></a>
                                        <?php }?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
