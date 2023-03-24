<?php
    class DB
    {
        public $con;

        public function connectDB()
        {
            return mysqli_connect("localhost", "root", "password", "laravel");
        }

        public function getConnect()
        {
            return $this->con = $this->connectDB();
        }
    }
?>