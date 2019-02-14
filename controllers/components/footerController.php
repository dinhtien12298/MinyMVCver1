<?php
    class FooterController {
        public $model;
        public function __construct() {
            $this->model = new model();

            $data_footer = [];
            $data_check_name = [];
            $all_subjects = $this->model->fetchAllRecords("
                SELECT subjects.id, subject, classes.class
                FROM subjects, classes
                WHERE subjects.class_id = classes.id
            ");
            foreach ($all_subjects as $subject) {
                if (!in_array($subject->subject, $data_check_name)) {
                    array_push($data_footer, $subject);
                    array_push($data_check_name, $subject->subject);
                }
                if (sizeof($data_footer) >= 8) {
                    break;
                }
            }

            require_once 'views/components/footer.php';
        }
    }

    new FooterController();
