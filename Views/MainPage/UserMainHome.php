<div class="user-body-homepage">
    <div class="container">
        <ul id="user-menu" class="f-regular-25">
            <li onclick="directTo('/minyMVC/index.php?user#user-infomation')"><a href="/minyMVC/index.php?user#user-infomation">Thông tin cá nhân</a></li>
            <li onclick="directTo('/minyMVC/index.php?user#post-management')"><a href="/minyMVC/index.php?user#post-management">Quản lý bài viết</a></li>
            <li onclick="directTo('/minyMVC/index.php?user#post-create')"><a href="/minyMVC/index.php?user#post-create">Đăng bài</a></li>
        </ul>
        <?php if (isset($_GET['update'])) {
            require_once 'Views/Users/UpdatePost.php';
        } elseif (isset($_GET['updateInfo'])) {
            require_once 'Views/Users/UpdateInfo.php';
        } else {
            require_once 'Views/Users/MainHome.php';
        } ?>
    </div>
</div>