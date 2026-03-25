<?php

require_once __DIR__ . '/../Core/Model.php';

class Dashboard extends Model
{
    public function totalCustomer()
    {
        $result = $this->query("SELECT COUNT(*) as customers FROM customers WHERE rowstatus = 1");
        return $this->fetch($result)['customers'];
    }

    // public function totalUsaha()
    // {
    //     $result = $this->query("SELECT COUNT(*) as total FROM tb_usaha");
    //     return $this->fetch($result)['total'];
    // }

    // public function totalJenisUsaha()
    // {
    //     $result = $this->query("SELECT COUNT(*) as total FROM tb_jenisusaha");
    //     return $this->fetch($result)['total'];
    // }

    public function totalPengguna()
    {
        $result = $this->query("SELECT COUNT(*) as total FROM users WHERE rowstatus = 1");
        return $this->fetch($result)['total'];
    }
}
?>