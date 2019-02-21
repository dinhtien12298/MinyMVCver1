// searchSubjectsAPI for creating post
const classInput = document.getElementsByClassName('class-input')[0];
const subjectInput = document.getElementsByClassName('subject-input')[0];

searchSubjectsOfClass(classInput.value);
classInput.onchange = function() {
    searchSubjectsOfClass(classInput.value);
}

function searchSubjectsOfClass(class_name) {
    axios({
        method: 'GET',
        url: '/minyMVC/api/searchSubjectAPI.php',
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
            url: '/minyMVC/api/deletePostAPI.php',
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
                url: '/minyMVC/api/createPostAPI.php',
                params: {
                    "title": title,
                    "class": className,
                    "subject": subject,
                    "content": content,
                    "user_id": user_id
                }
            }).then(response => {
                window.location.href = '/minyMVC/index.php?user';
            }).catch(error => console.log(error));
        }
    }
}