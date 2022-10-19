<?php
include 'db_config111.php'
?>
<section>
    <div class="product-category-section">
        <div class="container-fluid">
            <div class="category  w-57p">

                <?php
                $refernceQuery = mysqli_query($con, "SELECT categories.id as caegoryId,categories.name,categories.image, areas.id as areaId FROM areas LEFT JOIN products_areas on products_areas.area_id = areas.id LEFT JOIN products_categories on products_categories.product_id = products_areas.product_id LEFT JOIN categories on categories.id = products_categories.category_id WHERE areas.name like 'Referencenet%' GROUP BY categories.id ORDER BY categories.rank ASC");
				if($refernceQuery){
                if(mysqli_num_rows($refernceQuery)>0){
                while ($refArray = mysqli_fetch_object($refernceQuery)) {
                    ?>
                    <div class="cat-box">
                        <a href="<?= utf8_encode(url('produkttype',[$refArray->caegoryId,$refArray->areaId]))?>">
                            <div class="icon">
                                <img src="<?= asset('' . $refArray->image) ?>" alt="" class="img-fluid">
                            </div>
                            <p><b><?php if ($refArray->name) {
                                        echo utf8_encode($refArray->name);
                                    } ?></b></p>
                        </a>
                    </div>
                <?php }}} ?>

            </div>
        </div>
    </div>
</section>
