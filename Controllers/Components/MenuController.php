<?php
    require_once 'Models/Components/MenuComponentModel.php';
    class MenuController
    {
        public $model;
        public $data_menu;
        public $class_images;
        public $all_classes;
        public function __construct()
        {
            $this->model = new MenuComponentModel();
            $this->all_classes = $this->model->fetchAllClasses();
            $this->data_menu = $this->dataMenu($this->all_classes)[0];
            $this->class_images = $this->dataMenu($this->all_classes)[1];
        }

        public function dataMenu($all_classes)
        {
            foreach ($all_classes as $class) {
                $index = array_search($class, $all_classes);
                $class_id = $class->id;
                $data_menu[$index] = $this->model->searchSubjectsOfClass($class_id);
                $class_images[$index] = explode(" ", $class->class);
            }
            return [$data_menu, $class_images];
        }
    }
    new MenuController();
