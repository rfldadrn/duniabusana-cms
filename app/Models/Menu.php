<?php
require_once __DIR__ . '/../Core/Model.php';
class Menu extends Model {

    public function getByRole($roleId) {
        $roleId = $this->escape($roleId);
        $sql = "
            SELECT m.*
            FROM menus m
            JOIN rolemapping rm ON rm.menusId = m.id                
            WHERE rm.rolesId = '$roleId'
              AND m.rowstatus = 1
            ORDER BY m.parentId, m.orderNo
        ";
        $result = $this->query($sql);
        return $this->fetchAll($result);
    }
    public function getByMenuSlug($menuSlug) {
        $menuSlug = $this->escape($menuSlug);
        $sql = "SELECT rm.rolesId
                FROM menus m
                JOIN rolemapping rm ON rm.menusId = m.id                
                WHERE m.MenuSlug = '$menuSlug'
                AND m.rowstatus = 1
                ORDER BY m.parentId, m.orderNo";
        $result = $this->query($sql);
        return $this->fetch($result);
    }
}
