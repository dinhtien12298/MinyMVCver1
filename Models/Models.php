<?php
    abstract class Models
    {
        protected $hostname = 'localhost';
        protected $username = 'root';
        protected $password = '';
        protected $dbname = 'miny';

        protected $conn = null;
        public function __construct()
        {
            $this->conn = mysqli_connect($this->hostname, $this->username, $this->password, $this->dbname);
            if (!$this->conn) {
                echo "Kết nối Database không thành công";
                die("Connection Error: " . mysqli_connect_error());
            }
            mysqli_set_charset($this->conn,"utf8");
        }

        public function fetchAllRecords($query)
        {
            $query_sql = mysqli_query($this->conn, $query);
            if (!$query_sql) {
                die("Truy vấn tất cả bản ghi thất bại!");
            }
            $data = [];
            while ($result = mysqli_fetch_object($query_sql)) {
                array_push($data, $result);
            }
            return $data;
        }

        public function fetchARecord($query)
        {
            $query_sql = mysqli_query($this->conn, $query);
            if (!$query_sql) {
                die("Truy vấn một bản ghi thất bại");
            }
            return mysqli_fetch_object($query_sql);
        }

        public function execute($query)
        {
            $query_sql = mysqli_query($this->conn, $query);
            if (!$query_sql) {
                return false;
            }
            return true;
        }

        public function checkExistRecord($query)
        {
            $query_sql = mysqli_query($this->conn, $query);
            if (!$query_sql) {
                die("Truy vấn kiểm tra thất bại!");
            }
            return mysqli_num_rows($query_sql);
        }

        public function countRecords($query)
        {
            $sql_query = mysqli_query($this->conn, $query);
            return mysqli_num_rows($sql_query);
        }
    }