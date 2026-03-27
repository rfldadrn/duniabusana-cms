<?php 
require_once __DIR__ . '/../Core/Model.php';

class Agency extends Model
{
    public function all()
    {
        $result = $this->query("SELECT * FROM agencies WHERE rowstatus = 1");
        return $this->fetchAll($result);
    }

    public function find($id)
    {
        $id = (int) $id;
        $result = $this->query("SELECT * FROM agencies WHERE id=$id AND rowstatus = 1");
        return $this->fetch($result);
    }

    public function getEmployeeByAgencyId($agencyId)
    {
        $agencyId = (int) $agencyId;
        $sql = "SELECT e.* FROM customers e
                JOIN agencies ae ON e.agencyId = ae.Id
                WHERE ae.Id = $agencyId AND e.rowstatus = 1 AND ae.rowstatus = 1";
        $result = $this->query($sql);
        return $this->fetchAll($result);
    }

    public function create($data)
    {
        $name = $this->escape($data['Name']);
        $description = $this->escape($data['Description']);
        $startDate = $this->escape($data['StartDate']);
        $targetDate = $this->escape($data['TargetDate']);
        $rowstatus = 1;
        $created_at = date('Y-m-d H:i:s');

        $sql = "INSERT INTO agencies (name, description, startDate, targetDate, rowstatus, created_at)
                VALUES ('$name', '$description', '$startDate', '$targetDate', '$rowstatus', '$created_at')";

        $this->query($sql);
        return $this->db->insert_id;
    }

    public function update($id, $data)
    {
        $id = (int) $id;
        $name = $this->escape($data['Name']);
        $description = $this->escape($data['Description']);
        $startDate = $this->escape($data['StartDate']);
        $targetDate = $this->escape($data['TargetDate']);
        $updated_at = date('Y-m-d H:i:s');

        $sql = "UPDATE agencies SET
                name='$name',
                description='$description',
                startDate='$startDate',
                targetDate='$targetDate',
                updated_at='$updated_at'
                WHERE id=$id";

        return $this->query($sql);
    }

    public function delete($id)
    {
        $id = (int) $id;
        return $this->query("UPDATE agencies SET rowstatus=0 WHERE id=$id");
    }
}
?>