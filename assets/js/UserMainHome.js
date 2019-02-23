// searchSubjectsAPI for creating post
const classInput = document.getElementsByClassName('class-input')[0];
const subjectInput = document.getElementsByClassName('subject-input')[0];

if (classInput) {
    searchSubjectsOfClass(classInput.value);
    classInput.onchange = function() {
        searchSubjectsOfClass(classInput.value);
    }
}

function searchSubjectsOfClass(class_name) {
    axios({
        method: 'GET',
        url: '/minyMVC/api/SearchSubjectApi.php',
        params : { "class": class_name }
    }).then(response => {
        if (response.data && response.data.length > 0) {
            var data = response.data;
            var subjectInputHTML = data.map(
                obj => `<option value="${ obj['subject'] }">${ obj['subject'] }</option>`
            );
            subjectInput.innerHTML = `${subjectInputHTML.join("")}`;
        }
    }).catch(error => console.log(error));
}

// deletePostAPI
function deletePost(post_id, index) {
    var confirmCheck = confirm('Bạn có chắc chắn muốn xóa bài viết');
    if (confirmCheck) {
        var postTable = document.getElementsByTagName('table')[0];
        const saveContent = postTable.innerHTML;
        const removeContent = document.getElementsByTagName('tr')[index + 1].innerHTML;
        axios({
            method: 'GET',
            url: '/minyMVC/api/DeletePostApi.php',
            params: { 'post_id': post_id }
        }).then(response => {
            if (response.data) {
                postTable.innerHTML = saveContent.replace(removeContent, '');
                alert(response.data);
            }
        }).catch(error => console.log(error));
    }
}

// createPostAPI
function createPost(user_id) {
    var confirmCheck = confirm('Bạn đã chắc chắn về nội đung bài viết chưa?');
    if (confirmCheck) {
        const title = document.getElementsByClassName('title-input')[0].value;
        const className = document.getElementsByClassName('class-input')[0].value;
        const subject = document.getElementsByClassName('subject-input')[0].value;
        const content = CKEDITOR.instances.content.getData();
        if (title.length < 1) {
            alert('Bài viết chưa có tiêu đề!');
        } else if (content.length < 1) {
            alert('Bài viết chưa có nội dung!');
        } else {
            axios({
                method: 'GET',
                url: '/minyMVC/api/CreatePostApi.php',
                params: {
                    "title": title,
                    "class": className,
                    "subject": subject,
                    "content": content,
                    "user_id": user_id
                }
            }).then(response => {
                window.location.href = '/minyMVC/index.php?user';
                console.log("12");
            }).catch(error => console.log(error));
        }
    }
}

// updatePostAPI
function updatePost(post_id) {
    var confirmCheck = confirm('Bạn đã chắc chắn về nội đung bài viết chưa?');
    if (confirmCheck) {
        const title = document.getElementsByClassName('title-input')[0].value;
        const className = document.getElementsByClassName('class-input')[0].value;
        const subject = document.getElementsByClassName('subject-input')[0].value;
        const content = CKEDITOR.instances.content.getData();
        if (title.length < 1) {
            alert('Bài viết chưa có tiêu đề!');
        } else if (content.length < 1) {
            alert('Bài viết chưa có nội dung!');
        } else {
            axios({
                method: 'GET',
                url: '/minyMVC/api/UpdatePostApi.php',
                params: {
                    "title": title,
                    "class": className,
                    "subject": subject,
                    "content": content,
                    "post_id": post_id
                }
            }).then(response => {
                window.location.href = '/minyMVC/index.php?user';
            }).catch(error => console.log(error));
        }
    }
}

// updateInfoAPI
function updateInfo() {
    var confirmCheck = confirm('Bạn đã chắc muốn thay đổi thông tin?');
    if (confirmCheck) {
        const username = document.getElementById('update-userInfo-button').dataset.username;
        const password = document.getElementsByClassName('password-input-update')[0].value;
        const phone = document.getElementsByClassName('phone-input-update')[0].value;
        const email = document.getElementsByClassName('email-input-update')[0].value;
        const working = document.getElementsByClassName('working-input-update')[0].value;
        if (password.length < 1) {
            alert('Bạn chưa điền mật khẩu!');
        } else if (phone.length < 1) {
            alert('Bạn chưa điền số điện thoại!');
        } else if (email.length < 1) {
            alert('Bạn chưa điền Email!');
        } else if (working.length < 1) {
            alert('Bạn chưa điền nơi học tập/làm việc!');
        } else {
            axios({
                method: 'GET',
                url: '/minyMVC/api/UpdateInfoApi.php',
                params: {
                    "username": username,
                    "password": password,
                    "phone": phone,
                    "email": email,
                    "working": working
                }
            }).then(response => {
                window.location.href = '/minyMVC/index.php?user';
            }).catch(error => console.log(error));
        }
    }
}
