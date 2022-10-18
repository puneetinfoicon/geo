<section class="medarbejdere mb-64">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="product-add pt-0 pb-0">
                    <h3>Medarbejdere</h3>
                </div>
            </div>
        </div>
        <?php
        if(sizeof(getBusinessArea())>0){
            foreach (getBusinessArea() as $teams_grp){
                ?>

                <div class="row">
                    <div class="col-md-12">
                        <div class="product-add pt-0 pb-0">
                            <h4 style="font-size: 23px;  padding: 10px; color: var(--main); font-family: 'Gotham Book';"><?= urldecode($teams_grp->business_area)?></h4>
                        </div>
                    </div>
                    <?php
                    foreach (getTeamByArea($teams_grp->business_area) as $teams){
                        ?>
                        <div class="col-sm-4 col-md-3 col-lg-2 col-medarbejdere">
                            <div class="medarbejdere_box">

                                <div class="medarbejdere_box_img">
                                    <a href="#">
                                        <?php
                                        if ($teams->image != null){
                                            ?>
                                            <img src="<?= asset($teams->image) ?>" class="img-fluid" alt="<?= utf8_encode($teams->alt_image) ?>">
                                        <?php } else{?>
                                            <img src="<?= asset('media/default.jpg') ?>" class="img-fluid" alt="<?= utf8_encode($teams->alt_image) ?>">
                                        <?php }?>
                                </div>

                                <div class="medarbejdere_box_content">
                                    <h3><a href="#"><?= urldecode(ucfirst($teams->name)) ?></a></h3>
                                    <ul>
                                        <li><?= urldecode($teams->designation) ?></li>
                                        <a href="tel:<?= utf8_encode($teams->contact) ?>"> <li><?= utf8_encode($teams->contact) ?></li></a>
                                        <a href="mailto:<?= urldecode($teams->email) ?>"> <li><?= urldecode($teams->email); ?></li></a>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            <?php }} ?>
    </div>
</section>
