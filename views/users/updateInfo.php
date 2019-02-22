<div class="content-container f-regular-16">
    <div id="user-infomation">
        <div class="user-infomation-content">
            <div class="info-element d-flex">
                <div class="info-name">Tên tài khoản</div>
                <input class="info-content" value="<?php echo $user->username ?>" readonly>
            </div>
            <div class="info-element d-flex">
                <div class="info-name">Mật khẩu</div>
                <input type="password" class="info-content password-input-update" value="<?php echo $user->password ?>" required>
            </div>
            <div class="info-element d-flex">
                <div class="info-name">Tên đầy đủ</div>
                <input class="info-content fullname-input-update" value="<?php echo $user->fullname ?>" readonly>
            </div>
            <div class="info-element d-flex">
                <div class="info-name">Ngày sinh</div>
                <input class="info-content" value="<?php echo $user->birth ?>" readonly>
            </div>
            <div class="info-element d-flex">
                <div class="info-name">Số điện thoại</div>
                <input type="number" class="info-content phone-input-update" value="<?php echo $user->phone ?>" required>
            </div>
            <div class="info-element d-flex">
                <div class="info-name">Email</div>
                <input type="email" class="info-content email-input-update" value="<?php echo $user->email ?>" required>
            </div>
            <div class="info-element d-flex">
                <div class="info-name">Cơ quan/Trường học</div>
                <input type="text" class="info-content working-input-update" value="<?php echo $user->working ?>" required>
            </div>
            <div class="info-element d-flex">
                <div class="info-name">Vai trò</div>
                <input class="info-content" value="Người dùng" readonly>
            </div>
        </div>
        <div class="update-button""><button id="update-userInfo-button" data-username="<?php echo $user->username ?>" onclick='updateInfo()' class="f-medium-17">Cập nhật thông tin</button></div>
    </div>
</div>