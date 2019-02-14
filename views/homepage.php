<!-- START CONTENT -->
<div class="content">
    <div class="container">
        <?php foreach($list_classes as $class_name) {
            $index = array_search($class_name, $list_classes);
            if (sizeof($data_content[$index]) != 0) { ?>
                <div class="tab-heading">
                    <div class="tab-title f-regular-30">
                        <?php echo $class_name; ?>
                    </div>
                    <?php if (sizeof($list_buttons[$index]) != 0) {?>
                        <div class="menu-button f-regular-12">
                            <?php for ($i = 0; $i < sizeof($list_buttons[$index]); $i++) { ?>
                                <button class="subject-tab" data-subjectId="<?php echo $list_buttons[$index][$i]->id ?>"><?php echo $list_buttons[$index][$i]->subject ?></button>
                            <?php } ?>
                        </div>
                    <?php } ?>
                    <div class="view-all">
                        <a class="view-all-tag f-regular-13" data-className="<?php echo $class_name ?>"">
                        Xem tất cả
                        <i class="fas fa-caret-right"></i>
                        </a>
                    </div>
                </div>
                <div class="line-orange"></div>
                <div class="tab-post">
                    <?php if (sizeof($data_content[$index]) >= 6) {
                        $total_post = 6;
                    } else {
                        $total_post = sizeof($data_content[$index]);
                    }
                    for ($i = 0; $i < $total_post; $i++) { ?>
                        <div class="post-model" onclick="directTo('/minyMVC/index.php?post=<?php echo $data_content[$index][$i]->id ?>')">
                            <div class="post-title">
                                <a href="/minyMVC/index.php?post=<?php echo $data_content[$index][$i]->id ?>" class="f-medium-17"><?php echo $data_content[$index][$i]->title ?></a>
                            </div>
                            <div class="post-heading d-flex">
                                <div class="post-author f-medium-12">
                                    <?php echo $data_content[$index][$i]->fullname ?>
                                </div>
                                <div class="post-info f-regular-13">
                                    <div><img src="./assets/images/homepage/icon-view.png" alt="icon-view"><?php echo $data_content[$index][$i]->view_num; ?></div>
                                    <div><img src="./assets/images/homepage/icon-heart.png" alt="icon-like"><?php echo $data_content[$index][$i]->like_num; ?></div>
                                </div>
                            </div>
                            <div class="post-content f-regular-13">
                                <?php echo $data_content[$index][$i]->content ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php }
        } ?>
    </div>
</div>
<!-- END CONTENT -->

<!-- START SERVICE -->
<div id="service">
    <div class="container">
        <div id="service-header">
            <p class="f-regular-30">Chúng tôi cung cấp cho bạn</p>
        </div>
        <div id="service-info" class="d-flex">
            <div class="service-1" style="width: 29%">
                <div class="service-icon">
                    <img src="./assets/images/homepage/icon-file.png" alt="icon-file">
                </div>
                <div class="service-content">
                    <div class="content-heading f-regular-20">Tài nguyên học tập miễn phí</div>
                    <div class="content-detail f-regular-13">Cung cấp hơn 1 triệu tài nguyên về học tập miễn phí trên trang web</div>
                </div>
            </div>
            <div class="service-2" style="width: 44%">
                <div class="service-icon">
                    <img src="./assets/images/homepage/icon-download.png" alt="icon-download">
                </div>
                <div class="service-content" style="padding: 0px 65px">
                    <div class="content-heading f-regular-20">Nội dung cập nhật liên tục</div>
                    <div class="content-detail f-regular-13">Nội dung trên web được cập nhật liên tục hàng ngày bởi đội ngũ giáo viên giỏi</div>
                </div>
            </div>
            <div class="service-3" style="width: 27%">
                <div class="service-icon">
                    <img src="./assets/images/homepage/icon-pc.png" alt="icon-pc">
                </div>
                <div class="service-content">
                    <div class="content-heading f-regular-20">Giao diện thân thiện</div>
                    <div class="content-detail f-regular-13">Trang web luôn lắng nghe góp ý để đổi mới trang web phục vụ các bạn cả nước</div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END SERVICE -->