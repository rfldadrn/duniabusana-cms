<?php

require_once __DIR__ . '/../Core/Model.php';

class Item extends Model {

    public function all() {
        $result = $this->query("SELECT * FROM items WHERE rowstatus = 1");
        return $this->fetchAll($result);
    }
    public function itemProperties($itemId) {
        $itemId = (int) $itemId;
        $result = $this->query("SELECT * FROM itemSize WHERE itemId = $itemId AND rowstatus = 1");
        return $this->fetchAll($result);
    }
}
