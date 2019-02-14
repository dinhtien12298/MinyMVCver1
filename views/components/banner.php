<?php
    if (isset($_GET['class']) || isset($_GET['id'])) { ?>
        <div id="banner">
            <div class="container">
                <div class="breadcrumb f-regular-13">
                    <?php for ($i = 0; $i < sizeof($breadcrumb) - 1; $i++) {?>
                        <div><a class="breadcrumb-tag"><?php echo $breadcrumb[$i] ?></a></div>
                    <?php }?>
                    <div><?php echo $breadcrumb[sizeof($breadcrumb) - 1] ?></div>
                </div>
                <div class="banner-heading f-bold-30">
                    <?php if (isset($_GET['id'])) {
                        echo $post->subject . ' - ' . $post->title;
                    } else {
                        echo $_GET['class'] . ' - GIẢI BÀI TẬP ' . $_GET['class'];
                    } ?>
                </div>
            </div>
        </div>
    <?php } else { ?>
        <div id="banner-hp"></div>
    <?php }
