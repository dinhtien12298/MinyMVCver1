<footer>
    <div class="container">
        <div class="logo">
            <a href="/minyMVC/index.php"><img src="./assets/images/all/logo.png" alt="logo"></a>
        </div>
        <div class="menu f-regular-14">
            <?php if (isset($data_footer) && sizeof($data_footer) > 0) {
                foreach ($data_footer as $data) { ?>
                    <div class="footer-menu-item"><a href="/minyMVC/index.php?class=<?php echo $data->class ?>&subject=<?php echo $data->subject ?>&page=1"><?php echo $data->subject ?></a></div>
                <?php }
            } ?>
        </div>
        <div class="copyright f-regular-12"><p>Copyright © 2018 Miny. Design by 123DOC</p></div>
    </div>
</footer>
