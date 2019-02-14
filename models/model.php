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
    }