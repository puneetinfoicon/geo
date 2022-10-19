<?php
$service_context = getRootParent();
getParent($service_context);
$contexts =getParent($service_context);
?>

<?php
if(sizeof($contexts)>0){
    foreach($contexts as $superParent){
        if(sizeof(myParent($superParent->id))>0){
            ?>
            <div class="accordion-bral">
                <input class="ac-input" id="ac-<?= $superParent->id?>" name="accordion-1" type="checkbox">
                <label class="ac-label toggle-btn" for="ac-<?= $superParent->id?>">
                    <span class="arrow"></span><?= $superParent->name?></label>
                <?php
                if(sizeof(myParent($superParent->id))>0){
                    foreach(myParent($superParent->id) as $p2){
                        if(sizeof(myParent($p2->id))>0){
                            ?>

                            <div class="article ac-content  second_accordion">
                                <div class="accordion-bral">
                                    <input class="ac-input" id="ac-4" name="accordion-1" type="checkbox">
                                    <label class="ac-label toggle-btn" for="ac-4">
                                        <span class="arrow"></span><?= $p2->name?>
                                    </label>
                                    <div class="article ac-content">
                                        <div class="content-aa">
                                            <ul>
                                                <?php
                                                if(sizeof(myParent($p2->id))>0){
                                                    foreach(myParent($p2->id) as $p3){
                                                        ?>

                                                        <li><a href="#"><?= $p3->name?></a></li>
                                                    <?php }}?>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php }else{?>
                            <div class="article ac-content">
                                <div class="content-aa">
                                    <ul>
                                        <li>
                                            <a href="#"><?= $p2->name?></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        <?php }}}?>


            </div>

        <?php }else{?>
            <div class="links">
                <a href="#"><?= $superParent->name;?></a>
            </div>
        <?php }}}?>
