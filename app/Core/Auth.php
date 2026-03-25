<?php
require_once __DIR__ . '/../Models/Menu.php';
class Auth {
    public static function check() {
        if (!isset($_SESSION['user'])) {
            header('Location: ' . BASE_URL . '/auth/login');
            exit;
        }
    }

    public static function role($slug) {
        self::check();
        $rolesModel = new Menu();
        $rolesId = $rolesModel->getByMenuSlug($slug)['rolesId'] ?? null;
        if (!in_array($_SESSION['user']['rolesId'], (array)$rolesId)) {
            return false;
        }
        return true;
    }
}
