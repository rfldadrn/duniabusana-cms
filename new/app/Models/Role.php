<?php

require_once __DIR__ . '/../Core/Model.php';

class Role extends Model {

    public function all() {
        $result = $this->query("SELECT * FROM roles WHERE rowstatus = 1");
        return $this->fetchAll($result);
    }
}
