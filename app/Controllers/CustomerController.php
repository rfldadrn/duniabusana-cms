<?php 
require_once __DIR__ . '/../Core/Controller.php';
require_once __DIR__ . '/../Models/Customer.php';
require_once __DIR__ . '/../Core/Auth.php';
require_once __DIR__ . '/../Models/Item.php';
require_once __DIR__ . '/../Models/DropdownMapping.php';

class CustomerController extends Controller
{
    private $customerModel;
    private $itemModel;
    private $dropdownMappingModel;

    public function __construct()
    {
        $this->customerModel = new Customer();
        $this->itemModel = new Item();
        $this->dropdownMappingModel = new DropdownMapping();
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
            'No_telepon' => '',
        ];
        $agencies = $this->dropdownMappingModel->getAllAgencies();
        $this->view('customer/detail', compact('customer', 'agencies'));
    }

    /* =======================
       SIMPAN CUSTOMER
    ======================= */
    public function store()
    {
        $nama_customer = $_POST['Nama_pelanggan'] ?? '';
        $gender = $_POST['Gender'] ?? '';
        $nomor_telp = $_POST['Nomor_telp'] ?? '';
        $agencyId = $_POST['Instansi'] ?? '';



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

        $lastInsertId = $this->customerModel->create($_POST);
        $_SESSION['success'] = 'Customer berhasil ditambahkan!';
        header('Location: ' . BASE_URL . '/customer/edit/' . $lastInsertId);
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
        $getSizeCustomer = $this->customerModel->getAllSizes($id, null);
                
        $result = [];

        foreach ($getSizeCustomer as $row) {
            $id = $row['HeaderSizeCustomerId'];
            $itemName = $row['ItemName'];

            // jika item belum ada, buat parent-nya
            if (!isset($result[$id])) {
                $result[$id] = [
                    'id' => $row['HeaderSizeCustomerId'],
                    'itemId' => $row['ItemId'],
                    'itemName' => $itemName,
                    'note' => $row['Note'],
                    'details' => []
                ];
            }

            // push detail size
            $result[$id]['details'][] = [
                'itemSizeId' => $row['ItemSizeId'],
                'sizeName' => $row['SizeName'],
                'size' => $row['Size'],
                'isMandatory' => $row['isMandatory']
            ];
        }

        // reset index array
        $sizeCustomer = array_values($result);
        $agencies = $this->dropdownMappingModel->getAllAgencies();
        $items = $this->itemModel->all();
        $this->view('customer/detail', compact('customer', 'items', 'sizeCustomer', 'agencies'));
    }
    public function getSizeDetail()
    {
        header('Content-Type: application/json');
        $customerId = $_GET['customerId'] ?? '';
        $itemId = $_GET['itemId'] ?? '';
         $headerSizeCustomerId = $_GET['headerSizeCustomerId'] ?? '';
         if (!$customerId || !$itemId || !$headerSizeCustomerId) {
            echo json_encode(['success' => false, 'message' => 'Missing parameters']);
            exit;
        }
        $sizeCustomer = $this->customerModel->getAllSizes($customerId, $headerSizeCustomerId);
        echo json_encode([
                'success' => true,
                'data' => $sizeCustomer
            ]);
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

    public function addAndUpdateSize()
    {
        $data = $_POST;
        $headerSizeCustomerId = $_POST['HeaderSizeCustomerId'] ?? '';
        $customerId = $_POST['customerId'] ?? '';
        $itemId = $_POST['itemId'] ?? '';
        $note = $_POST['note'] ?? '';
        if (!$customerId || !$itemId) {
            $_SESSION['error'] = 'Semua field harus diisi!';
            header('Location: ' . BASE_URL . "/customer/edit/$customerId");
            exit;
        }
        // Update
        if ($headerSizeCustomerId != '') {
            $getHeaderSizeCustomer = $this->customerModel->getHeaderSizeByHeaderId($headerSizeCustomerId);
            if (!$getHeaderSizeCustomer) {
                $_SESSION['error'] = 'Data ukuran tidak ditemukan!';
                header('Location: ' . BASE_URL . "/customer/edit/$customerId");
                exit;
            }
            // update note jika header sudah ada
            if ($getHeaderSizeCustomer['Note'] != $note) {
                $updateNote = $this->customerModel->updateHeader($headerSizeCustomerId, $note);

            }
            //delete size lama
            $deleteSize = $this->customerModel->deleteSize($headerSizeCustomerId);
            if (!$deleteSize) {
                $_SESSION['error'] = 'Terjadi kesalahan!';
                header('Location: ' . BASE_URL . "/customer/edit/$customerId");
                exit;
            }
            foreach ($data as $key => $value) {
                // cek apakah key diawali dengan "prop_"
                if (strpos($key, 'prop_') === 0) {

                    // ambil angka setelah prop_
                    $itemSizeId = str_replace('prop_', '', $key);
                    $value = (float)($_POST[$key] ?? 0);
                    // insert ke database
                    $sql = $this->customerModel->addSize($itemSizeId, $headerSizeCustomerId, $value);
                    if (!$sql) {
                        $_SESSION['error'] = 'Gagal menambahkan ukuran!';
                        header('Location: ' . BASE_URL . "/customer/edit/$customerId");
                        exit;
                    }
                }
            }
            $_SESSION['success'] = 'Ukuran berhasil diperbarui!';
        } else {
            // buat header baru jika belum ada
            $headerSizeCustomerId = $this->customerModel->addHeaderSize($customerId, $note);
            if (!$headerSizeCustomerId) {
                $_SESSION['error'] = 'Gagal menambahkan ukuran!';
                header('Location: ' . BASE_URL . "/customer/edit/$customerId");
                exit;
            } 
            foreach ($data as $key => $value) {
                // cek apakah key diawali dengan "prop_"
                if (strpos($key, 'prop_') === 0) {

                    // ambil angka setelah prop_
                    $itemSizeId = str_replace('prop_', '', $key);
                    $value = (float)($_POST[$key] ?? 0);
                    // insert ke database
                    $sql = $this->customerModel->addSize($itemSizeId, $headerSizeCustomerId, $value);
                    if (!$sql) {
                        $_SESSION['error'] = 'Gagal menambahkan ukuran!';
                        header('Location: ' . BASE_URL . "/customer/edit/$customerId");
                        exit;
                    }
                }
            }
            $_SESSION['success'] = 'Ukuran berhasil ditambahkan!';
        }
        header('Location: ' . BASE_URL . "/customer/edit/$customerId");
    }

    public function deleteSize($headerSizeCustomerId, $customerId)
    {
        if (!$headerSizeCustomerId) {
            return $this->renderPage('errors/404_data');
            exit;
        }
        $deleteSize = $this->customerModel->deleteHeaderSize($headerSizeCustomerId);
        if (!$deleteSize) {
            return $this->renderPage('errors/404_data');
            exit;
        }
        $_SESSION['success'] = 'Ukuran berhasil dihapus!';
        header('Location: ' . BASE_URL . "/customer/edit/$customerId");
        exit;
    }

    public function getAllSizes($customerId = null, $headerSizeCustomerId = null, $itemId = null)
    {
        header('Content-Type: application/json');
        if ($customerId == null) {
            echo json_encode(['success' => false, 'message' => 'Missing parameters']);
            exit;
        }
        $sizes = $this->customerModel->getAllSizes($customerId, $headerSizeCustomerId, $itemId);
        echo json_encode([
                'success' => true,
                'data' => [$sizes]
            ]);
    }
}

?>