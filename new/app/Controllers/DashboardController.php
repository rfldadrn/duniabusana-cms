<?php

require_once __DIR__ . '/../Core/Controller.php';
require_once __DIR__ . '/../Core/Auth.php';
require_once __DIR__ . '/../Models/Dashboard.php';

class DashboardController extends Controller
{
    public function index()
    {
        Auth::check();

        $user = $_SESSION['user'];
        if ($user['rolesId'] !== null) {
            $dashboard = new Dashboard();
            $totals = [
                'customers' => $dashboard->totalCustomer(),
                // 'usaha' => $dashboard->totalUsaha(),
                // 'jenisUsaha' => $dashboard->totalJenisUsaha(),
                'pengguna' => $dashboard->totalPengguna(),
            ];
            $this->view('dashboard/index', compact('user', 'totals'));
        } else {
            // Role tidak dikenali, redirect ke halaman login
            header('Location: ' . BASE_URL . '/auth/login');
            exit;
        }
    }
}
