<div class="content-container f-regular-16">
    <!-- START USER INFORMATION -->
    <div id="user-infomation">
        <div class="user-infomation-content">
            <?php foreach ($list_info as $key => $value) { ?>
                <div class="info-element d-flex">
                    <div class="info-name"><?php echo $key ?></div>
                    <div class="info-content"><?php echo $value ?></div>
                </div>
            <?php } ?>
        </div>
        <div class="update-button"><button class="f-medium-17">Cập nhật thông tin</button></div>
    </div>
    <!-- END USER INFORMATION -->

    <!-- START MANAGEMENT -->
    <div id="post-management">
        <table>
            <tr class="table-heading f-regular-15">
                <th>Tiêu đề</th>
                <th>Lớp</th>
                <th>Chủ đề</th>
                <th>Lượt xem</th>
                <th>Lượt thích</th>
                <th style="width: 30%">Nội dung</th>
                <th>Quản lý</th>
            </tr>
            <?php if (sizeof($all_posts) > 0) {
                foreach ($all_posts as $post) {
                    $index = array_search($post, $all_posts);
                    $post_id = "'$post->id'" ?>
                    <tr class="f-regular-14">
                        <td><?php echo $post->title ?></td>
                        <td><?php echo $post->class ?></td>
                        <td><?php echo $post->subject ?></td>
                        <td><?php echo $post->view_num ?></td>
                        <td><?php echo $post->like_num ?></td>
                        <td class="content-column"><?php echo $post->content ?></td>
                        <td>
                            <a href="/minyMVC/index.php?post=<?php echo $post->id ?>">Xem</a>
                            <a href="/minyMVC/index.php?user&update=<?php echo $post_id ?>">Sửa</a>
                            <a onclick="deletePost(<?php echo $post_id ?>, <?php echo $index ?>)">Xóa</a>
                        </td>
                    </tr>
                <?php }
            } else { ?>
                <tr class="f-regular-14">
                    <td></td>
                    <td></td>
                    <td>Bạn</td>
                    <td>chưa</td>
                    <td>có</td>
                    <td>bài viết nào cả!</td>
                    <td></td>
                </tr>
            <?php } ?>
        </table>
    </div>
    <!-- END MANAGEMENT -->

    <!-- START CREATE POST -->
    <div id="post-create">
        <form method="post">
            <div class="post-banner">
                <h1 class="f-regular-25">Đăng bài viết</h1>
                <hr>
                <h6 class="f-regular-15">Đóng góp cho cộng đồng những bài viết bổ ích</h6>
            </div>
            <div class="form-element">
                <label for="title">Tiêu đề</label>
                <input class="title-input" type="text" name="title" placeholder="Tiêu đề" required>
            </div>
            <div class="form-element double-element">
                <div>
                    <label for="class">Lớp</label>
                    <select class="class-input" name="class" required>
                        <?php foreach ($all_classes as $class) {?>
                            <option value="<?php echo $class->class ?>"><?php echo $class->class ?></option>
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
                <textarea class="content-input" name="content" placeholder="Nội dung" required></textarea>
                <script>CKEDITOR.replace( 'content' )</script>
            </div>
            <button onclick="createPost(<?php echo $user->id ?>)">Đăng bài</button>
        </form>
    </div>
    <!-- END CREATE POST -->
</div>