<?php
    class HomepageController
    {
        public $model;
        public function __construct()
        {
            $this->model = new model();
            $list_classes = [
                'Mới nhất',
                'lớp 9',
                'lớp 8'
            ];
            $data = $this->dataContent($list_classes);
            $data_content = $data[0];
            $list_buttons = $data[1];
            require_once 'views/homepage.php';
        }

        private function dataContent($list_classes)
        {
            $data_content = [];
            $list_buttons = [];
            foreach ($list_classes as $class_name) {
                $index = array_search($class_name, $list_classes);
                $data_content[$index] = [];
                $list_buttons[$index] = $this->model->fetchSubjectButton($class_name);
                if ($class_name == "Mới nhất") {
                    $data_content[$index] = $this->model->fetchRelatedPosts();
                } else {
                    $subject = $list_buttons[$index][0]->subject;
                    $data_content[$index] = $this->model->fetchPostsByClassesAndSubjects($class_name, $subject);
                }
            }
            return [$data_content, $list_buttons];
        }
    }
    new HomepageController();
