<?php
    class FooterController {
        public $model;
        public function __construct()
        {
            $this->model = new model();
            $data_footer = $this->dataFooter();
            require_once 'views/components/footer.php';
        }

        private function dataFooter()
        {
            $data_footer = [];
            $data_check_name = [];
            $all_subjects = $this->model->fetchAllSubjects();
            foreach ($all_subjects as $subject) {
                if (!in_array($subject->subject, $data_check_name)) {
                    array_push($data_footer, $subject);
                    array_push($data_check_name, $subject->subject);
                }
                if (sizeof($data_footer) >= 8) {
                    break;
                }
            }
            return $data_footer;
        }
    }
    new FooterController();
