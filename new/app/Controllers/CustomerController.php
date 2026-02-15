<?php 
require_once __DIR__ . '/../Core/Controller.php';
require_once __DIR__ . '/../Models/Customer.php';
require_once __DIR__ . '/../Core/Auth.php';

class CustomerController extends Controller
{
    private $customerModel;

    public function __construct()
    {
        $this->customerModel = new Customer();
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        // pastikan hanya admin yang bisa mengakses CustomerController
        Auth::role('customers') == false? $this->renderPage('errors/403') : ''; // 1 = Admin
    }

    /* =======================
       LIST CUSTOMER
    ======================= */
    public function index()
    {
        Auth::check();
        $customers = $this->customerModel->all();
        $this->view('customer/index', compact('customers'));
    }

    /* =======================
       FORM TAMBAH CUSTOMER
    ======================= */
    public function create()
    {
        $customer = [
            'Nama_customer' => '',
            'Alamat' => '',
            'No_telepon' => ''
        ];
        $this->view('customer/detail', compact('customer'));
    }

    /* =======================
       SIMPAN CUSTOMER
    ======================= */
    public function store()
    {
        $nama_customer = $_POST['Nama_pelanggan'] ?? '';
        $gender = $_POST['Gender'] ?? '';
        $nomor_telp = $_POST['Nomor_telp'] ?? '';



        if (!$nama_customer || !$gender || !$nomor_telp) {
            $_SESSION['error'] = 'Semua field harus diisi!';
            header('Location: ' . BASE_URL . '/customer/create');
            exit;
        }

        $validity = preg_match("/^[0-9]+$/", $nomor_telp);
        if (!$validity) {
            $_SESSION['error'] = 'Nomor telepon harus berupa angka!';
            header('Location: ' . BASE_URL . '/customer/create');
            exit;
        }

        $validity = $this->customerModel->findByPhone($nomor_telp);
        if ($validity) {
            $_SESSION['error'] = 'Pelanggan dengan nomor telepon tersebut sudah terdaftar!';
            header('Location: ' . BASE_URL . '/customer/create');
            exit;
        }

        $this->customerModel->create($_POST);
        $_SESSION['success'] = 'Customer berhasil ditambahkan!';
        header('Location: ' . BASE_URL . '/customers');
    }

    /* =======================
       FORM EDIT CUSTOMER
    ======================= */
    public function edit($id)
    {
        $customer = $this->customerModel->find($id);
        if (!$customer) {
            $this->renderPage('errors/404_data');
            exit;
        }
        $this->view('customer/detail', compact('customer'));
    }

    /* =======================
       UPDATE CUSTOMER
    ======================= */
    public function update()
    {
        $id = $_POST['Id'] ?? '';
        $nama_customer = $_POST['Nama_pelanggan'] ?? '';
        $gender = $_POST['Gender'] ?? '';
        $no_telepon = $_POST['Nomor_telp'] ?? '';
        if (!$nama_customer || !$gender || !$no_telepon) {
            $_SESSION['error'] = 'Semua field harus diisi!';
            header('Location: ' . BASE_URL . "/customer/edit/$id");
            exit;
        }
        $this->customerModel->update($id, $_POST);
        $_SESSION['success'] = 'Customer berhasil diperbarui!';
        header('Location: ' . BASE_URL . '/customer/edit/' . $id);
    }

    public function delete($id)
    {
        $customer = $this->customerModel->find($id);
        if (!$customer) {
            $this->renderPage('errors/404_data');
            exit;
        }
        $this->customerModel->delete($id);
        $_SESSION['success'] = 'Customer berhasil dihapus!';
        header('Location: ' . BASE_URL . '/customers');
    }
}

?>