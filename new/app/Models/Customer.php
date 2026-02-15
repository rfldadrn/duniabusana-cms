<?php

require_once __DIR__ . '/../Core/Model.php';

class Customer extends Model
{
    public function all()
    {
        $result = $this->query("SELECT * FROM customers WHERE rowstatus = 1");
        return $this->fetchAll($result);
    }

    public function find($id)
    {
        $id = (int) $id;
        $result = $this->query("SELECT * FROM customers WHERE id=$id AND rowstatus = 1");
        return $this->fetch($result);
    }

    public function create($data)
    {
        $nama_customer = $this->escape($data['Nama_pelanggan']);
        $gender = $this->escape($data['Gender']);
        $no_telepon = $this->escape($data['Nomor_telp']);
        $rowstatus = 1;
        $created_at = date('Y-m-d H:i:s');

        $sql = "INSERT INTO customers (name, gender, phoneNumber, rowstatus, created_at)
                VALUES ('$nama_customer', '$gender', '$no_telepon', '$rowstatus', '$created_at')";

        return $this->query($sql);
    }

    public function update($id, $data)
    {
        $id = (int) $id;
        $nama_customer = $this->escape($data['Nama_pelanggan']);
        $gender = $this->escape($data['Gender']);
        $no_telepon = $this->escape($data['Nomor_telp']);
        $updated_at = date('Y-m-d H:i:s');

        $sql = "UPDATE customers SET
                name='$nama_customer',
                gender='$gender',
                phoneNumber='$no_telepon',
                updated_at='$updated_at'
                WHERE id=$id";

        return $this->query($sql);
    }

    public function delete($id)
    {
        $id = (int) $id;
        return $this->query("UPDATE customers SET rowstatus=0 WHERE id=$id");
    }

    public function findByPhone($no_telepon)
    {
        $no_telepon = $this->escape($no_telepon);
        $result = $this->query("SELECT * FROM customers WHERE PhoneNumber='$no_telepon' AND rowstatus = 1");
        return $this->fetch($result);
    }
}