<div class="content">
    <div class="container">
        <div class="d-flex">
            <!-- START MAIN CONTENT -->
            <div class="content-post">
                <div class="list-post">
                    <div class="tab-heading">
                        <div class="tab-title f-regular-30">
                            <?php echo $tab_title ?>
                        </div>
                    </div>
                    <div class="line-orange"></div>
                    <div class="tab-post">
                        <?php for ($i = 0; $i < sizeof($data_content); $i++) {?>
                            <div class="post-model" onclick="directTo('/minyMVC/index.php?post=<?php echo $data_content[$i]->id ?>')">
                                <div class="post-title">
                                    <a href="/minyMVC/index.php?post=<?php echo $data_content[$i]->id ?>" class="f-medium-17"><?php echo $data_content[$i]->title ?></a>
                                </div>
                                <div class="post-heading d-flex">
                                    <div class="post-author f-medium-12">
                                        <?php echo $data_content[$i]->fullname ?>
                                    </div>
                                    <div class="post-info f-regular-13">
                                        <div><img src="./assets/images/homepage/icon-view.png" alt="icon-view"><?php echo $data_content[$i]->view_num ?></div>
                                        <div><img src="./assets/images/homepage/icon-heart.png" alt="icon-like"><?php echo $data_content[$i]->like_num ?></div>
                                    </div>
                                </div>
                                <div class="post-content f-regular-13">
                                    <?php echo $data_content[$i]->content ?>
                                </div>
                            </div>
                        <?php }?>
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT -->

            <!-- START SIDEBAR -->
            <?php
            if (file_exists("controllers/components/sidebarController.php")) {
                require_once 'controllers/components/sidebarController.php';
            }
            ?>
            <!-- END SIDEBAR -->
        </div>
        <div class="page-button">
            <?php for ($i = 0; $i < $page_button; $i++) {?>
                <a href="/minyMVC/index.php?class=<?php echo $_GET['class'] ?>&subject=<?php echo $_GET['subject'] ?>&page=<?php echo $i + 1 ?>"><button class="paginate-button f-regular-14"><?php echo $i + 1 ?></button></a>
            <?php }
            if ($continue) { ?>
                <div class="etc"></div>
                <div class="etc"></div>
                <div class="etc"></div>
            <?php } ?>
        </div>
    </div>
</div>