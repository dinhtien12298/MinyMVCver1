<div class="side-bar">
    <?php if (isset($all_ads) && sizeof($all_ads) > 0 ) {
        foreach ($all_ads as $ad) {?>
            <a href="<?php echo $ad->link ?>"><img src="<?php echo $ad->image ?>" alt="<?php echo $ad->title ?>"></a>
        <?php }
    } ?>
</div>