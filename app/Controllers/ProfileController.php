<?php

require_once __DIR__ . '/../Core/Controller.php';
require_once __DIR__ . '/../Models/User.php';
require_once __DIR__ . '/../Models/Role.php';
require_once __DIR__ . '/../Core/Auth.php';
require_once __DIR__ . '/../Models/Menu.php';

class ProfileController extends Controller
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        // pastikan hanya admin yang bisa mengakses ProfileController
    }

    public function profile()
    {
        Auth::check();
        $userId = $_SESSION['user']['id'];
        $data_cek = $this->userModel->find($userId);
        if (!$data_cek) {
            return $this->renderPage('errors/404_data');
        }
        $this->view('user/profile', compact('data_cek'));
    }

    public function updateProfile()
    {
        Auth::check();
        $id = $_POST['id'];
        $nama_pengguna = $_POST['Nama_pengguna'] ?? '';
        $password = $_POST['Password'] ?? '';

        if (!$nama_pengguna) {
            $_SESSION['error'] = 'Nama pengguna wajib diisi';
            header('Location: ' . BASE_URL . '/userProfile');
            exit;
        }

        $checkUser = $this->userModel->find($id);
        if (!$checkUser) {
            return $this->renderPage('errors/404_data');
        }

        
        $updateData = ['Nama_pengguna' => $nama_pengguna];
        
        if ($password) {
            if (strlen($password) < 6) {
                $_SESSION['error'] = 'Password minimal 6 karakter';
                header('Location: ' . BASE_URL . '/user/profile');
                exit;
            }
            $updateData['Password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        $this->userModel->update($id, $updateData);
    
        // Update session user data
        $_SESSION['user']['nama'] = $nama_pengguna;

        if ($password) {
            $_SESSION['user']['password'] = $updateData['Password'];
        }

        $_SESSION['success'] = 'Profil berhasil diupdate';
        header('Location: ' . BASE_URL . '/user/profile');
        exit;
    }
}
