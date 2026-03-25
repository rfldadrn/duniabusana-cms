<?php

class MenuHelper {

    public static function buildTree(array $menus, $parentId = null) {
        $branch = [];
        foreach ($menus as $menu) {
            if ((int)$menu['ParentId'] == (int)$parentId) {
                $children = self::buildTree($menus, $menu['Id']);
                if ($children) {
                    $menu['children'] = $children;
                }
                $branch[] = $menu;
            }
        }
        return $branch;
    }

    public static function bgColor(){
        return $colors = ['primary', 'success', 'warning', 'danger', 'info', 'secondary'];
    }
}
