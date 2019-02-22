<?php
    class Model {
        // Lấy tất cả bản ghi
        public function fetchAllRecords($query) {
            global $conn;
            $sql_query = mysqli_query($conn, $query);
            $list_data = [];
            while ($result = mysqli_fetch_object($sql_query)) {
                array_push($list_data, $result);
            }
            return $list_data;
        }

        // Lấy một bản ghi
        public function fetchARecord($query) {
            global $conn;
            $sql_query = mysqli_query($conn, $query);
            $data = mysqli_fetch_object($sql_query);
            return $data;
        }

        // Kiểm tra bản ghi có tồn tại
        public function checkExistRecord($query) {
            global $conn;
            $sql_query = mysqli_query($conn, $query);
            if (mysqli_num_rows($sql_query) > 0) {
                return true;
            }
            return false;
        }

        // Kiểm tra số bản ghi
        public function countRecords($query) {
            global $conn;
            $sql_query = mysqli_query($conn, $query);
            return mysqli_num_rows($sql_query);
        }

        // Thực thi một câu lệnh
        public function execute($query) {
            global $conn;
            $sql_query = mysqli_query($conn, $query);
            if (!$sql_query) {
                return false;
            }
            return true;
        }

        // API
        // SearchPost
        public function searchPostKeyword($keyword) {
            $data = $this->fetchAllRecords("SELECT * FROM posts WHERE title like '%$keyword%'");
            return $data;
        }
        // SearchTabPost
        public function searchTabPost($subject_id, $limit) {
            $data = $this->fetchAllRecords("
                SELECT posts.id, title, view_num, like_num, content, fullname, classes.class, subjects.subject
                FROM posts
                INNER JOIN subjects ON posts.subject_id = subjects.id
                INNER JOIN classes ON subjects.class_id = classes.id
                INNER JOIN users ON posts.user_id = users.id
                WHERE subjects.id = $subject_id
                LIMIT $limit
            ");
            return $data;
        }
        // SearchSubjectAPI
        public function searchClassIdByClass($class) {
            $data = $this->fetchARecord("SELECT * FROM classes WHERE class = '$class'");
            return $data;
        }
        // DeletePostAPI
        public function deletePost($post_id) {
            $delete = $this->execute("DELETE FROM posts WHERE id = $post_id");
            return $delete;
        }
        // CreatePostAPI
        public function createPost($title, $user_id, $subject_id, $content) {
            $create = $this->execute("
                INSERT INTO posts(title, user_id, subject_id, content)
                VALUES ('$title', $user_id, $subject_id, '$content')
            ");
            return $create;
        }
        // updatePostAPI
        public function updatePost($post_id, $title, $subject_id, $content) {
            $update = $this->execute("
                UPDATE posts SET title = '$title', subject_id = $subject_id, content = '$content'
                WHERE id = $post_id
            ");
            return $update;
        }
        // updateInfoAPI
        public function updateInfo($username, $password, $phone, $email, $working) {
            $update = $this->execute("
                UPDATE users SET password = '$password', phone = $phone, email = '$email', working = '$working'
                WHERE username = '$username'
            ");
            return $update;
        }

        // BannerController
        public function postInfoForBanner($post_id) {
            $data = $this->fetchARecord("
                SELECT title, classes.class, subjects.subject
                FROM posts
                INNER JOIN subjects ON posts.subject_id = subjects.id
                INNER JOIN classes ON subjects.class_id = classes.id
                WHERE posts.id = $post_id
            ");
            return $data;
        }

        // MenuController
        public function fetchAllClasses() {
            $data = $this->fetchAllRecords("SELECT * FROM classes");
            return $data;
        }
        public function searchSubjectsOfClass($class_id) {
            $data = $this->fetchAllRecords("SELECT * FROM subjects WHERE class_id=$class_id");
            return $data;
        }

        // SidebarController
        public function fetchAllAdvertiments() {
            $data = $this->fetchAllRecords("SELECT * FROM advertiments");
            return $data;
        }
        public function searchSubjectIdOfPost($post_id) {
            $data = $this->fetchARecord("SELECT subject_id FROM posts WHERE id = $post_id");
            return $data;
        }
        public function findPostRelated($post_id, $subject_id) {
            $data = $this->fetchAllRecords("
                SELECT id, title 
                FROM posts 
                WHERE subject_id = $subject_id AND
                id != $post_id
                LIMIT 8
            ");
            return $data;
        }

        // CategoryController
        public function fetchLastedPostForPage($start_number) {
            $data = $this->fetchAllRecords("
                SELECT posts.id, title, view_num, like_num, content, fullname
                FROM posts
                INNER JOIN users ON posts.user_id = users.id
                LIMIT $start_number, 9
            ");
            return $data;
        }
        public function fetchPostsForPage($start_number, $subject_id) {
            $data = $this->fetchAllRecords("
                SELECT posts.id, title, view_num, like_num, content, fullname
                FROM posts
                INNER JOIN users ON posts.user_id = users.id
                WHERE subject_id = $subject_id
                LIMIT $start_number, 9
            ");
            return $data;
        }
        public function searchSubjectId($class, $subject) {
            $data = $this->fetchARecord("
                SELECT subjects.id, subjects.subject, classes.class
                FROM subjects
                INNER JOIN classes ON subjects.class_id = classes.id
                WHERE subjects.subject = '$subject' AND 
                classes.class = '$class'
            ");
            return $data;
        }
        public function countPosts($start_number, $subject_id) {
            if ($subject_id == 0) {
                $query = "SELECT * FROM posts LIMIT $start_number, 28";
            } else {
                $query = "SELECT * FROM posts WHERE subject_id = $subject_id LIMIT $start_number, 28";
            }
            return $this->countRecords($query);
        }

        // DetailController
        public function fetchPostDetail($post_id) {
            $data = $this->fetchARecord("
                SELECT posts.id, title, view_num, like_num, content, fullname, classes.class, subjects.subject
                FROM posts
                INNER JOIN users ON posts.user_id = users.id
                INNER JOIN subjects ON posts.subject_id = subjects.id
                INNER JOIN classes ON subjects.class_id = classes.id
                WHERE posts.id = $post_id
            ");
            return $data;
        }
        public function fetchPostsForDataMorePost($post_id, $class) {
            $data = $this->fetchAllRecords("
                SELECT posts.id, title, view_num, like_num, content, fullname, classes.class, subjects.subject
                FROM posts
                INNER JOIN users ON posts.user_id = users.id
                INNER JOIN subjects ON posts.subject_id = subjects.id
                INNER JOIN classes ON subjects.class_id = classes.id
                WHERE classes.class = '$class' AND
                posts.id != $post_id
                LIMIT 6
            ");
            return $data;
        }

        // HomepageController
        public function fetchSubjectButton($class) {
            $data = $this->fetchAllRecords("
                SELECT subjects.id, subject, classes.class
                    FROM subjects, classes
                    WHERE subjects.class_id = classes.id AND 
                    classes.class = '$class' 
                    LIMIT 4
            ");
            return $data;
        }
        public function fetchRelatedPosts() {
            $data = $this->fetchAllRecords("
                SELECT posts.id, title, view_num, like_num, content, fullname
                FROM posts
                INNER JOIN users ON posts.user_id = users.id
                LIMIT 6
            ");
            return $data;
        }
        public function fetchPostsByClassesAndSubjects($class, $subject) {
            $data = $this->fetchAllRecords("
                SELECT posts.id, title, view_num, like_num, content, fullname, classes.class, subjects.subject
                FROM posts
                INNER JOIN users ON posts.user_id = users.id
                INNER JOIN subjects ON posts.subject_id = subjects.id
                INNER JOIN classes ON subjects.class_id = classes.id
                WHERE classes.class = '$class' AND 
                subjects.subject = '$subject'
                LIMIT 6
            ");
            return $data;
        }

        // Users
        // LoginController
        public function checkUser($username, $password) {
            $check = $this->checkExistRecord("
                SELECT * FROM users WHERE username = '$username' AND password = '$password'
            ");
            return $check;
        }
        public function checkUsername($username) {
            $check = $this->checkExistRecord("
                SELECT * FROM users WHERE username = '$username'
            ");
            return $check;
        }

        // MainHomeController
        public function foundUser($username) {
            $data = $this->fetchARecord("SELECT * FROM users WHERE username = '$username'");
            return $data;
        }
        public function fetchPostsByUser($user_id) {
            $data = $this->fetchAllRecords("
                SELECT posts.id, title, view_num, like_num, content, classes.class, subjects.subject
                FROM posts
                INNER JOIN subjects ON posts.subject_id = subjects.id
                INNER JOIN classes ON subjects.class_id = classes.id
                WHERE posts.user_id = $user_id
            ");
            return $data;
        }
        // signUp
        public function checkEmail($email) {
            $check = $this->checkExistRecord("
                SELECT * FROM users WHERE email = '$email'
            ");
            return $check;
        }
        public function checkPhone($phone) {
            $check = $this->checkExistRecord("
                SELECT * FROM users WHERE phone = '$phone'
            ");
            return $check;
        }
        public function signUpUser($username, $password, $fullname, $birth, $phone, $email, $working) {
            $sign_up = $this->execute("
                INSERT INTO users(username, password, fullname, birth, phone, email, working)
                VALUES ('$username', '$password', '$fullname', '$birth', $phone, '$email', '$working')
            ");
            return $sign_up;
        }
    }
