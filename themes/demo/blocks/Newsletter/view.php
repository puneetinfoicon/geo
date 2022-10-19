<section>
    <div class="mail-section">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-6 col-sm-6">
                    <div class="mail-text">
                        <p style="width: 55%"><?= newsletters()->news_heading;?></p>
                    </div>
                </div>

                <div class="col-md-6 col-sm-6">
                    <div class="newsLetters">
                        <div class="newsletter_bttn">
                            <div class="b__btn">
                                <div class="form-group">
                                    <input type="checkbox" id="html" value="landmailing">
                                    <label for="html"><?= newsletters()->landmailing_heading?></label>
                                </div>
                                <div class="form-group">
                                    <input type="checkbox" id="css" value="landburg">
                                    <label for="css"><?= newsletters()->landburg_heading;?></label>
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
                                    <label for="javascript">Jeg accepterer Geoteams </label> <a href="<?= url('/')?><?= newsletters()->policy_link?>">privatlivspolitik</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

