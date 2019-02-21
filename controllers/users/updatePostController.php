<?php
    class UpdatePostController {
        public $model;
        public function __construct() {
            $this->model = new model();
            // Xử lý cập nhật bài viết
            $post_id = isset($_GET['update']) ? $_GET['update'] : '';
            $post = $this->model->fetchARecord("
                SELECT posts.id, title, classes.class, subjects.subject, content
                FROM posts
                INNER JOIN subjects ON posts.subject_id = subjects.id
                INNER JOIN classes ON subjects.class_id = classes.id
                WHERE posts.id = $post_id
            ");
            if (!$post) {
                echo "
                    <script>
                        alert('Không tìm thấy bài viết!');
                    </script>
                ";
            }
            if (isset($_POST['submitUpdate'])) {
                $title = isset($_POST['title']) ? $_POST['title'] : '';
                $class = isset($_POST['class']) ? $_POST['class'] : '';
                $subject = isset($_POST['subject']) ? $_POST['subject'] : '';
                $content = isset($_POST['content']) ? $_POST['content'] : '';
                $class = $this->model->fetchARecord("SELECT * FROM classes WHERE class = '$class'");
                if ($class) {
                    $class_id = $class->id;
                } else {
                    echo "
                        <script>
                            alert('Tên lớp không thỏa mãn');
                        </script>
                    ";
                }
                $subject = $this->model->fetchARecord("SELECT * FROM subjects WHERE class_id = '$class_id' AND subject = '$subject'");
                if ($subject) {
                    $subject_id = $subject->id;
                } else {
                    echo "
                        <script>
                            alert('Tên chủ đề không thỏa mãn');
                        </script>
                    ";
                }
                $update = $this->model->execute("
                    UPDATE posts SET title = '$title', subject_id = $subject_id, content = '$content'
                    WHERE id = $post_id
                ");
                if ($update) {
                    echo "
                        <script>
                            window.location.href = `/minyMVC/index.php?user`;
                        </script>
                    ";
                } else {
                    echo "
                        <script>
                            alert('Cập nhật không thành công!');
                        </script>
                    ";
                }
            }

            require_once 'views/users/updatePost.php';
        }
    }
    new UpdatePostController();
