<?php

require_once __DIR__ . '/../Core/Model.php';

class User extends Model
{
    public function all()
    {
        $result = $this->query("SELECT users.id, users.nama_pengguna, users.username, users.rolesId, users.password, roles.RoleName
                                FROM users JOIN roles ON users.rolesId = roles.id 
                                WHERE users.rowstatus = 1 AND roles.rowstatus = 1");
        return $this->fetchAll($result);
    }

    public function find($id)
    {
        $id = (int) $id;
        $result = $this->query("SELECT users.id as Id, users.nama_pengguna as Nama_pengguna, users.username as Username, users.rolesId as RolesId, users.password as Password, roles.RoleName as RoleName
                                FROM users JOIN roles ON users.rolesId = roles.id 
                                WHERE users.id=$id AND users.rowstatus = 1 AND roles.rowstatus = 1");
        return $this->fetch($result);
    }

    public function findByUsername($username)
    {
        $username = $this->escape($username);
        $result = $this->query("SELECT users.id as Id, users.nama_pengguna as Nama_pengguna, users.username as Username, users.rolesId as RolesId, users.password as Password, roles.RoleName as RoleName
                                FROM users JOIN roles ON users.rolesId = roles.id 
                                WHERE users.username='$username' AND users.rowstatus = 1 AND roles.rowstatus = 1");
        return $this->fetch($result);
    }

    public function create($data)
    {
        $nama_pengguna = $this->escape($data['Nama_pengguna']);
        $username = $this->escape($data['Username']);
        $password = password_hash(PASSWORD_DEFAULT_APP, PASSWORD_DEFAULT);
        $rolesId     = $this->escape($data['RolesId']);
        $rowstatus = 1;
        $created_at = date('Y-m-d H:i:s');

        $sql = "INSERT INTO users (nama_pengguna, username, password, rolesId, rowstatus, created_at)
                VALUES ('$nama_pengguna', '$username', '$password', '$rolesId', '$rowstatus', '$created_at')";

        return $this->query($sql);
    }

    public function update($id, $data)
    {
        $id = (int) $id;
        $nama_pengguna = $this->escape($data['Nama_pengguna']);
        $username = isset($data['Username']) ? $this->escape($data['Username']) : '';
        $rolesId     = isset($data['RolesId']) ? $this->escape($data['RolesId']) : '';
        $updated_at = date('Y-m-d H:i:s');
        $password = $data['Password'] ?? '';
        $sql = "UPDATE users SET";
        if ($username) {
            $sql .= " username='$username',";
        }
        if ($rolesId) {
            $sql .= " rolesId='$rolesId',";
        }
             $sql .= " nama_pengguna='$nama_pengguna',
                updated_at='$updated_at'";
        if ($password) {
            $sql .= ", password='$password'";
        }
        $sql .= " WHERE id=$id";

        return $this->query($sql);
    }

    public function delete($id)
    {
        $id = (int) $id;
        return $this->query("DELETE FROM users WHERE id=$id");
    }

    public function login($username, $password) {
        $username = $this->escape($username);
        $password = $this->escape($password);

        $sql = "SELECT * FROM users 
                WHERE BINARY username='$username' 
                AND password='$password'";

        $result = $this->query($sql);
        return $this->fetch($result);
    }

     public function updatePassword($id, $hash) {
        $hash = $this->escape($hash);
        $sql  = "UPDATE users SET password='$hash' WHERE id='$id'";
        return $this->query($sql);
    }
}
