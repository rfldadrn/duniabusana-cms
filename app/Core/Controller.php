<?php

require_once __DIR__ . '/../Models/Menu.php';
require_once __DIR__ . '/../Core/Helper.php';

class Controller {

    protected function view($view, $data = [], $layout = 'app') {
        extract($data);

        if (isset($_SESSION['user'])) {
            $menuModel = new Menu();
            $menus = $menuModel->getByRole($_SESSION['user']['rolesId']);
            $menuTree = MenuHelper::buildTree($menus);
        } else {
            $menuTree = [];
        }
        ob_start();
        require __DIR__ . "/../../views/$view.php";
        $content = ob_get_clean();

        require __DIR__ . "/../../views/layouts/$layout.php";
    }

    protected function renderPage($view, $data = []) {
        extract($data);
        http_response_code(404);
        require __DIR__ . "/../../views/$view.php";
        exit;
    }
}
    