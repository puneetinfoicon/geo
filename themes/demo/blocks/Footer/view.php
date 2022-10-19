<?php
$footerData = getContent1('footer');
$footer = footerData();
?>
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
                            <li><a href="<?= getDefaultId()->linkedin?>" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="<?= getDefaultId()->facebook?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="<?= getDefaultId()->youtube?>" target="_blank"><i class="fa fa-youtube-play"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
