<div class="user-body-homepage">
    <div class="container">
        <ul id="user-menu" class="f-regular-25">
            <li onclick="directTo('/minyMVC/index.php?user#user-infomation')"><a href="/minyMVC/index.php?user#user-infomation">Thông tin cá nhân</a></li>
            <li onclick="directTo('/minyMVC/index.php?user#post-management')"><a href="/minyMVC/index.php?user#post-management">Quản lý bài viết</a></li>
            <li onclick="directTo('/minyMVC/index.php?user#post-create')"><a href="/minyMVC/index.php?user#post-create">Đăng bài</a></li>
        </ul>
        <?php if ( isset($_GET['update']) ) {
            require_once 'controllers/users/updatePostController.php';
        } else {
            require_once 'controllers/users/mainHomeController.php';
        } ?>
    </div>
</div>