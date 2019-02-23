<?php
    require_once 'Models/Models.php';
    class FooterComponentModel extends Models
    {
        public function __construct()
        {
            parent::__construct();
        }

        public function fetchAllSubjects()
        {
            $data = parent::fetchAllRecords("
                SELECT subjects.id, subject, classes.class
                FROM subjects
                INNER JOIN classes ON subjects.class_id = classes.id
            ");
            return $data;
        }
    }