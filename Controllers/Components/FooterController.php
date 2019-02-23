<?php
    require_once 'Models/Components/FooterComponentModel.php';
    class FooterController
    {
        public $model;
        public $data_footer;
        public function __construct()
        {
            $this->model = new FooterComponentModel();
            $this->data_footer = [];
            $data_check_name = [];
            $all_subjects = $this->model->fetchAllSubjects();
            foreach ($all_subjects as $subject) {
                if (!in_array($subject->subject, $data_check_name)) {
                    array_push($this->data_footer, $subject);
                    array_push($data_check_name, $subject->subject);
                }
                if (sizeof($this->data_footer) >= 8) {
                    break;
                }
            }
        }
    }
    new FooterController();
