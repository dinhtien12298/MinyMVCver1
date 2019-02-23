<?php
    require_once 'Models/Models.php';
    class MenuComponentModel extends Models
    {
        public function __construct()
        {
            parent::__construct();
        }

        public function fetchAllClasses()
        {
            $data = parent::fetchAllRecords("SELECT * FROM classes");
            return $data;
        }

        public function searchSubjectsOfClass($class_id)
        {
            $data = parent::fetchAllRecords("SELECT * FROM subjects WHERE class_id=$class_id");
            return $data;
        }
    }