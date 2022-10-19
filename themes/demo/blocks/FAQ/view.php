<?php
include 'db_config111.php';
$areaQuery = mysqli_query($con, "select name, id from areas order by rank ASC");
while ($areas = mysqli_fetch_object($areaQuery)) {
}
?>

<style>
    .accordion-bral {
        min-height: 0;
        min-width: 220px;
        width: 100%;
        height: auto !important;
        background-color: var(--white);
        margin: 0px !important;
    }
</style>

<section class="search-section">
    <div class="product-sec produkter-section">
        <div class="container-fluid">
            <div class="product-heading">
                <h3>Ofte stillede spørgsmål</h3>
            </div>
            <div class="searching">
                <div class="row">
                    <div class="col-md-3">
                        <div class="searching_filter">
                            <h3>Filter</h3>
                            <div class="custom-checkbox">
                                <div class="select_everyone">
                                    <?php
                                    $areaQuery = mysqli_query($con, "select name, id from areas order by rank ASC");
                                    while ($areas = mysqli_fetch_object($areaQuery)) {
                                        ?>
                                        <div class="form-group">
                                            <input type="checkbox" id="ch<?= $areas->id ?>" value="<?= $areas->id ?>"
                                                   class="checkC selectedId4<?= $areas->id ?>" onchange="faqData()">
                                            <label for="ch<?= $areas->id ?>"><?= utf8_encode($areas->name) ?></label>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-9">
                        <div class="faq">
                            <div class="description-section">
                                <div class="accordion-bral">
                                    <div id="test">
                                        <?php
                                        $qyeryFaq = mysqli_query($con, "select * from faqs ");
                                        while ($rowFaq = mysqli_fetch_object($qyeryFaq)) {
                                            ?>
                                            <div class="accordian-box">
                                                <input class="ac-input" id="ac-<?= $rowFaq->id?>" name="accordion-1" type="checkbox" />
                                                <label class="ac-label toggle-btn" for="ac-<?= $rowFaq->id?>">
                                                    <span class="arrow"></span><?= utf8_encode($rowFaq->question)?></label>
                                                <div class="article ac-content">
                                                    <div class="content-aa">
                                                        <p><?= utf8_encode($rowFaq->answer)?></p>
                                                    </div>
                                                </div>
                                            </div>

                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="faq_footer mb-64">
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="faq_footer_content">
                                            <h3>Flere spørgsmål?</h3>
                                            <p>Har du ikke fundet svar på dit spørgsmål, eller vil du bare gerne
                                                tale med os direkte, er det <br/>nemt at få fat på os.</p>
                                            <div class="row no-margin">
                                                <div class="col-md-6">
                                                    <p><strong>Support landbrug </strong>
                                                        <a href="tel:+4577332288"> +45 7733 2288</a></p>
                                                    <p>
                                                        <strong>Support referencenet </strong>
                                                        <a href="tel:+4588208703"> +45 8820 8703</a></p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p><strong>Support landmåling </strong>
                                                        <a href="tel:+4588208703"> +45 8820 8703</a></p>
                                                    <p>
                                                        <strong>
                                                            <a href="mailto:support@geoteam.dk">support@geoteam.dk</a>
                                                        </strong>
                                                    </p>
                                                </div>
                                            </div>
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

<script>
    function faqData() {
        var myAssociativeArr = [];
        $("input[type='checkbox']:checked.checkC").each(function (index, element) {
            if (!element.checked) {
                allChecked = false;
            }
            var newElement = {};
            newElement = $(this).val();
            myAssociativeArr.push(newElement);
            $('.accordion-bral').empty();
        });
        $.ajax({
            type: "GET",
            url: "<?= url('getfaq_Result')?>",
            data: "area=" + JSON.stringify(myAssociativeArr),
            beforeSend: function () {
                $(".se_loader").css('display', 'block');
            },
            success: function (data) {
                //console.log(data);
                $('.accordion-bral').empty();
                data.forEach(function (item) {
                    $('#test').empty();
                    let x = Math.floor((Math.random() * 100) + 1);
                    $('.accordion-bral').append('<div class="accordian-box"><input class="ac-input" id="ac-' + x + '" name="accordion-1" type="checkbox"/><label class="ac-label toggle-btn" for="ac-' + x + '"><span class="arrow"></span>' + item.faqs.question + '</label><div class="article ac-content"><div class="content-aa"><p>' + item.faqs.answer + '</p></div></div></div>')
                });
                $('.toggle-btn').on('click', function () {
                    $(this).toggleClass('active')
                });
            }
        });
    }
</script>
