<?php

require_once __DIR__ . '/../Core/Controller.php';
require_once __DIR__ . '/../Models/User.php';
require_once __DIR__ . '/../Models/Role.php';
require_once __DIR__ . '/../Core/Auth.php';
require_once __DIR__ . '/../Models/Menu.php';

class UserController extends Controller
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        // pastikan hanya admin yang bisa mengakses UserController
        Auth::role('users') == false? $this->renderPage('errors/403') : '';
    }

    /* =======================
       LIST USER
    ======================= */
    public function index()
    {
        Auth::check();
        $users = $this->userModel->all();
        $this->view('user/index', compact('users'));
    }

    /* =======================
       FORM TAMBAH USER
    ======================= */
    public function create()
    {
        $user = [
            'Nama_pengguna' => '',
            'Username' => '',
            'Password' => '',
            'RolesId' => ''
        ];
        $roleModel = new Role();
        $roles = $roleModel->all();
        $this->view('user/detail', compact('user', 'roles'));
    }

    /* =======================
       SIMPAN USER
    ======================= */
    public function store()
    {
        $nama_pengguna = $_POST['Nama_pengguna'] ?? '';
        $username = $_POST['Username'] ?? '';
        $role     = $_POST['RolesId'] ?? '';

        if (!$username || !$nama_pengguna || !$role) {
            $_SESSION['error'] = 'Username, nama pengguna, dan role wajib diisi';
            header('Location: ' . BASE_URL . '/user/create');
            exit;
        }

        $validateUser = $this->userModel->findByUsername($username);
        if ($validateUser) {
            $_SESSION['error'] = 'Username sudah digunakan';
            header('Location: ' . BASE_URL . '/user/create');
            exit;
        }        

        $this->userModel->create([
            'Nama_pengguna' => $nama_pengguna,
            'Username' => $username,
            'RolesId'  => (int)$role
        ]);

        $_SESSION['success'] = 'User berhasil ditambahkan';
        header('Location: ' . BASE_URL . '/users');
        exit;
    }

    /* =======================
       FORM EDIT USER
    ======================= */
    public function edit($id = null)
    {
        if (!$id) {
            return $this->renderPage('errors/404_data');        
        }

        $user = $this->userModel->find($id);
        if (!$user) {
            return $this->renderPage('errors/404_data');
        }

        $roleModel = new Role();
        $roles = $roleModel->all();
        $this->view('user/detail', compact('user', 'roles'));
    }

    /* =======================
       UPDATE USER
    ======================= */
    public function update()
    {
        $id       = $_POST['Id'];
        $nama_pengguna = $_POST['Nama_pengguna'] ?? '';
        $username = $_POST['Username'] ?? '';
        $role     = $_POST['RolesId'] ?? '';

        if (!$username || !$nama_pengguna || !$role) {
            $_SESSION['error'] = 'Username, nama pengguna, dan role wajib diisi';
            header('Location: ' . BASE_URL . '/user/edit/' . $id);
            exit;
        }

        $validateUser = $this->userModel->findByUsername($username);
        if ($validateUser && $validateUser['Id'] != $id) {
            $_SESSION['error'] = 'Username sudah digunakan';
            header('Location: ' . BASE_URL . '/user/edit/' . $id);
            exit;
        }

        $this->userModel->update($id, [
            'Nama_pengguna' => $nama_pengguna,
            'Username' => $username,
            'RolesId'  => (int)$role
        ]);
        $_SESSION['success'] = 'User berhasil diupdate';
        header('Location: ' . BASE_URL . '/user/edit/' . $id);
        exit;
    }

    /* =======================
       HAPUS USER
    ======================= */
    public function delete($id)
    {
        $user = $this->userModel->find($id);
        if (!$user) {
            return $this->renderPage('errors/404_data');
        }

        $this->userModel->delete($id);
        $_SESSION['success'] = 'User berhasil dihapus';
        header('Location: ' . BASE_URL . '/users');
        exit;
    }
}
