<div class="update-container">
    <div id="post-create">
        <form method="post">
            <div class="post-banner">
                <h1 class="f-regular-25">Cập nhật bài viết</h1>
                <hr>
                <h6 class="f-regular-15">Đóng góp cho cộng đồng những bài viết bổ ích</h6>
            </div>
            <div class="form-element">
                <label for="title">Tiêu đề</label>
                <input class="title-input" type="text" name="title" value="<?php echo $post_detail->title ?>">
            </div>
            <div class="form-element double-element">
                <div>
                    <label for="class">Lớp</label>
                    <select class="class-input" name="class" required>
                        <?php foreach ($all_classes as $class) {?>
                            <option
                                value="<?php echo $class->class ?>"
                                <?php if ($class->class == $post_detail->class) {?>
                                    selected
                                <?php } ?>
                            >
                                <?php echo $class->class ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div>
                    <label for="subject">Chủ đề</label>
                    <select class="subject-input" name="subject" required>

                    </select>
                </div>
            </div>
            <div class="form-element">
                <label for="content">Nội dung</label>
                <textarea class="content-input" name="content" required><?php echo $post_detail->content ?></textarea>
                <script>CKEDITOR.replace( 'content' )</script>
            </div>
            <button onclick="updatePost(<?php echo $post_detail->id ?>)">Cập nhật</button>
        </form>
    </div>
</div>