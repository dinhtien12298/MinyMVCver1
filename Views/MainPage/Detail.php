<div class="content">
    <div class="container">
        <div class="main-content d-flex">
            <!-- START POST DETAIL -->
            <div class="post-detail">
                <div class="post-main">
                    <div class="post-heading">
                        <div class="post-author">
                            <a href=""><img class="author-thumbnail" src="./assets/images/thumbnail/author-post.png" alt=""></a>
                            <a class="f-medium-15" href=""><?php echo $post->fullname ?></a>
                        </div>
                        <div class="post-info">
                            <div><img src="./assets/images/homepage/icon-view.png" alt="icon-view"><?php echo $post->view_num ?></div>
                            <div><img src="./assets/images/homepage/icon-heart.png" alt="icon-like"><?php echo $post->like_num ?></div>
                        </div>
                    </div>
                    <div class="post-content f-regular-17">
                        <?php echo $post->content ?>
                    </div>
                </div>
                <div class="fb-comments" data-href="http://dinhtien12298.github.io/web2018/detail.html" data-width="100%"></div>
            </div>
            <!-- END POST DETAIL -->

            <!-- START SIDEBAR -->
            <?php
                require_once 'Views/Components/Sidebar.php';
            ?>
            <!-- END SIDEBAR -->
        </div>
        <!-- START MOREPOST -->
        <div class="more-post">
            <?php if (isset($data_more_post) && sizeof($data_more_post) > 0) {?>
                <div class="tab-heading">
                    <div class="tab-title f-regular-30">
                        Có thể bạn quan tâm
                    </div>
                    <div class="view-all">
                        <a class="f-regular-13" href="/minyMVC/index.php?class=<?php echo $post->class ?>">
                            Xem tất cả
                            <i class="fas fa-caret-right"></i>
                        </a>
                    </div>
                </div>
                <div class="line-orange"></div>
                <div class="tab-post">
                    <?php for ($i = 0; $i < sizeof($data_more_post); $i++) {?>
                        <div class="post-model" onclick="directTo('/minyMVC/index.php?post=<?php echo $data_more_post[$i]->id ?>')">
                            <div class="post-title">
                                <a href="/minyMVC/index.php?post=<?php echo $data_more_post[$i]->id ?>" class="f-medium-17"><?php echo $data_more_post[$i]->title ?></a>
                            </div>
                            <div class="post-heading d-flex">
                                <div class="post-author f-medium-12">
                                    <?php echo $data_more_post[$i]->fullname ?>
                                </div>
                                <div class="post-info f-regular-13">
                                    <div><img src="./assets/images/homepage/icon-view.png" alt="icon-view"><?php echo $data_more_post[$i]->view_num ?></div>
                                    <div><img src="./assets/images/homepage/icon-heart.png" alt="icon-like"><?php echo $data_more_post[$i]->like_num ?></div>
                                </div>
                            </div>
                            <div class="post-content f-regular-13">
                                <?php echo $data_more_post[$i]->content ?>
                            </div>
                        </div>
                    <?php }?>
                </div>
            <?php } ?>
        </div>
        <!-- END MOREPOST -->
    </div>
</div>