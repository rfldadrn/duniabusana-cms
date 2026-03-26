<?php

require_once __DIR__ . '/../Core/Model.php';

class DropdownMapping extends Model {

    public function getAllAgencies() {
        $result = $this->query("SELECT * FROM agencies WHERE rowstatus = 1");
        return $this->fetchAll($result);
    }
    public function getPaymentMethods() {
        $result = $this->query("SELECT * FROM paymenttypes WHERE rowstatus = 1");
        return $this->fetchAll($result);
    }
}
