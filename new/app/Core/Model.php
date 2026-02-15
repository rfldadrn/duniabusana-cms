<?php

require_once __DIR__ . '/Database.php';

class Model {

    protected $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    protected function query($sql) {
        return mysqli_query($this->db, $sql);
    }

    protected function fetch($result) {
        return mysqli_fetch_assoc($result);
    }

    protected function fetchAll($result) {
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }

    protected function escape($value) {
        return mysqli_real_escape_string($this->db, $value);
    }
}
?>