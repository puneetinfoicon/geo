
<section>
    <div class="product-category-section">
        <div class="container-fluid">
            <div class="category  w-57p">

                <?php 
				if(count(getTopCategory())>0){
                foreach (getTopCategory() as $refArray) {
                    ?>
                    <div class="cat-box">
                        <a href="<?= utf8_encode(url('produkttype',[$refArray->caegoryId,$refArray->areaId]))?>">
                            <div class="icon">
                                <img src="<?= asset('' . $refArray->image) ?>" alt="" class="img-fluid">
                            </div>
                            <p><b><?php if ($refArray->name) {
                                        echo $refArray->name;
                                    } ?></b></p>
                        </a>
                    </div>
                <?php }} ?>

            </div>
        </div>
    </div>
</section>
