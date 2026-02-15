<?php

require_once __DIR__ . '/../Core/Model.php';

class Warga extends Model {
    
    public function findByUsername($username) {
        $username = $this->escape($username);

        $sql = "SELECT * FROM tb_warga 
                WHERE BINARY username='$username' LIMIT 1";

        $result = $this->query($sql);
        return $this->fetch($result);
    }

    public function login($username, $password) {
        $username = $this->escape($username);
        $password = $this->escape($password);

        $sql = "SELECT * FROM tb_warga 
                WHERE BINARY username='$username' 
                AND password='$password'";

        $result = $this->query($sql);
        return $this->fetch($result);
    }
    
    public function updatePassword($id, $hash) {
        $hash = $this->escape($hash);
        $sql  = "UPDATE tb_warga SET password='$hash' WHERE id='$id'";
        return $this->query($sql);
    }
}
