<?php
    class MenuController {
        public $model;
        public function __construct()
        {
            $this->model = new model();
            $all_classes = $this->model->fetchAllClasses();
            $data_menu = $this->dataMenu($all_classes)[0];
            $class_images = $this->dataMenu($all_classes)[1];
            require_once 'views/components/menu.php';
        }

        private function dataMenu($all_classes)
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
