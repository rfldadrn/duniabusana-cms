<?php

require_once __DIR__ . '/../Core/Model.php';

class Customer extends Model
{
    public function all()
    {
        $result = $this->query("SELECT c.*, a.Name AS AgencyName FROM customers c LEFT JOIN agencies a ON c.agencyId = a.Id WHERE c.rowstatus = 1");
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
        $agencyId = $data['Instansi'] ? (int)$data['Instansi'] : 'NULL';
        $rowstatus = 1;
        $created_at = date('Y-m-d H:i:s');

        $sql = "INSERT INTO customers (name, gender, phoneNumber, agencyId, rowstatus, created_at)
                VALUES ('$nama_customer', '$gender', '$no_telepon', $agencyId, '$rowstatus', '$created_at')";

        $this->query($sql);
        return $this->db->insert_id;
    }

    public function update($id, $data)
    {
        $id = (int) $id;
        $nama_customer = $this->escape($data['Nama_pelanggan']);
        $gender = $this->escape($data['Gender']);
        $no_telepon = $this->escape($data['Nomor_telp']);
        $agencyId = $data['Instansi'] ? (int)$data['Instansi'] : 'NULL';
        $updated_at = date('Y-m-d H:i:s');

        $sql = "UPDATE customers SET
                name='$nama_customer',
                gender='$gender',
                phoneNumber='$no_telepon',
                agencyId=$agencyId,
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

    public function addSize($itemSizeId, $headerSizeCustomerId, $size)
    {
        $itemSizeId = (int) $itemSizeId;
        $headerSizeCustomerId = (int) $headerSizeCustomerId;
        $size = $size;
        $rowstatus = 1;

        $sql = "INSERT INTO itemsizecustomer (itemSizeId, HeaderSizeCustomerId, size, rowstatus)
                VALUES ('$itemSizeId', '$headerSizeCustomerId', '$size', '$rowstatus')";

        return $this->query($sql);
    }
    public function updateSize($id, $size)
    {
        $id = (int) $id;
        $size = (float)($this->escape($size));
        $updated_at = date('Y-m-d H:i:s');

        $sql = "UPDATE itemsizecustomer SET
                size='$size',
                updatedBy='" . (int)$_SESSION['user']['id'] . "',
                updated_at='$updated_at'
                WHERE Id=$id";

        return $this->query($sql);
    }
    public function deleteHeaderSize($headerSizeCustomerId){
        $headerSizeCustomerId = (int) $headerSizeCustomerId;
        // Set rowstatus=0 untuk header dan semua item size terkait
        $sqlHeader = "UPDATE headersizecustomer SET rowstatus=0 WHERE Id=$headerSizeCustomerId";
        $sqlItems = "UPDATE itemsizecustomer SET rowstatus=0 WHERE HeaderSizeCustomerId=$headerSizeCustomerId";
        $this->query($sqlHeader);
        return $this->query($sqlItems);
    }
    public function deleteSize($headerSizeCustomerId){
        $headerSizeCustomerId = (int) $headerSizeCustomerId;
        return $this->query("UPDATE itemsizecustomer SET rowstatus=0 WHERE HeaderSizeCustomerId = '$headerSizeCustomerId' AND rowstatus = 1");
    }
     public function getSizeById($id, $headerSizeCustomerId){
        $id = (int) $id;
        $headerSizeCustomerId = (int) $headerSizeCustomerId;
        $sql = "SELECT * FROM itemsizecustomer WHERE Id=$id AND HeaderSizeCustomerId = $headerSizeCustomerId AND rowstatus = 1";
        $result = $this->query($sql);
        return $this->fetch($result);
    }
    public function addHeaderSize($customerId, $note){
        $customerId = (int) $customerId;
        $note = $this->escape($note);
        $rowstatus = 1;
        $created_at = date('Y-m-d H:i:s');

        $sql = "INSERT INTO headersizecustomer (customerId, note, rowstatus, createdBy, created_at)
                VALUES ('$customerId', '$note', '$rowstatus', '" . (int)$_SESSION['user']['id'] . "' , '$created_at')";

        $result = $this->query($sql);
        if ($result) {
            return $this->getLastInsertId();
        }
        return false;
    }
    public function updateHeader($headerSizeCustomerId, $note){
        $headerSizeCustomerId = (int) $headerSizeCustomerId;
        $note = $this->escape($note);
        $updated_at = date('Y-m-d H:i:s');

        $sql = "UPDATE headersizecustomer SET
                note='$note',
                updated_at='$updated_at'
                WHERE Id=$headerSizeCustomerId";

        return $this->query($sql);
    }
    public function getHeaderSizeByHeaderId($headerSizeCustomerId){
        $headerSizeCustomerId = (int) $headerSizeCustomerId;
        $sql = "SELECT * FROM headersizecustomer WHERE Id=$headerSizeCustomerId AND rowstatus = 1";
        $result = $this->query($sql);
        return $this->fetch($result);
    }
    public function getAllSizes($customerId, $headerSizeCustomerId = null, $itemId = null){
        $customerId = (int) $customerId;
        $headerSizeCustomerId = (int) $headerSizeCustomerId;
        $sql = "SELECT hsc.Id AS HeaderSizeCustomerId, hsc.Note, isc.ItemSizeId, isc.Size, isz.ItemId, i.Name as ItemName, isz.Name as SizeName, isz.isMandatory
                FROM headersizecustomer hsc
					 JOIN itemsizecustomer isc ON isc.HeaderSizeCustomerId = hsc.Id
                JOIN itemsize isz ON isc.itemSizeId = isz.Id
                JOIN items i ON isz.ItemId = i.Id
                WHERE hsc.customerId = $customerId AND hsc.rowstatus = 1 AND isz.rowstatus = 1 AND isc.rowstatus = 1";

        if ($headerSizeCustomerId) {
            $sql .= " AND hsc.Id = $headerSizeCustomerId";
        }
        if ($itemId) {
            $itemId = (int) $itemId;
            $sql .= " AND isz.ItemId = $itemId";
        }
        $sql .= " ORDER BY hsc.created_at DESC";
        $result = $this->query($sql);
        return $this->fetchAll($result);
    }
    public function test($customerId, $headerSizeCustomerId = null, $itemId = null){
        $sql = "SELECT hsc.Id AS HeaderSizeCustomerId, hsc.Note, isc.ItemSizeId, isc.Size, isz.ItemId, i.Name as ItemName, isz.Name as SizeName, isz.isMandatory
                FROM headersizecustomer hsc
					 JOIN itemsizecustomer isc ON isc.HeaderSizeCustomerId = hsc.Id
                JOIN itemsize isz ON isc.itemSizeId = isz.Id
                JOIN items i ON isz.ItemId = i.Id
                WHERE hsc.rowstatus = 1 AND isz.rowstatus = 1 AND isc.rowstatus = 1";
        $result = $this->query($sql);
        return $this->fetchAll($result);
    }
}