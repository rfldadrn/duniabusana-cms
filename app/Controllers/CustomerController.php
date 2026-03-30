<?php 
require_once __DIR__ . '/../Core/Controller.php';
require_once __DIR__ . '/../Models/Customer.php';
require_once __DIR__ . '/../Core/Auth.php';
require_once __DIR__ . '/../Models/Item.php';
require_once __DIR__ . '/../Models/DropdownMapping.php';
require_once __DIR__ . '/../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

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

    public function importCustomers()
    {
        $data = array();
        $agencyId = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $file_tmp = $_FILES['file']['tmp_name'];
            $file_name = $_FILES['file']['name'];
            $extension = pathinfo($file_name, PATHINFO_EXTENSION);
            $agencyId = $_POST['agencyId'] ?? null;

            $allowed_extensions = ['xls', 'xlsx'];
            if (!in_array($extension, $allowed_extensions)) {
                echo json_encode(['success' => false, 'message' => 'Format file harus .xls atau .xlsx']);
                exit;
            }

            try {
                // Load file excel
                $spreadsheet = IOFactory::load($file_tmp);
                $sheetData = $spreadsheet->getActiveSheet()->toArray();

                //Validasi template
                if (empty($sheetData) || count($sheetData[0]) < 3) {
                    echo json_encode([
                        'success' => false, 
                        'message' => 'Format template salah. Pastikan file memiliki minimal 3 kolom (Nama, No Telp, Gender).'
                    ]);
                    exit;
                }

                // Hapus baris pertama jika itu adalah header kolom
                array_shift($sheetData); 

                $dataImport = [];
                $errors = [];
                $line = 2;
                
                foreach ($sheetData as $row) {
                    $nama     = $row[0];
                    $nomor_telp    = $row[1];
                    $gender   = $row[2];
                    
                    if (empty($nama) || empty($nomor_telp) || empty($gender)) {
                        $errors[] = "Baris $line: Semua field (Nama, Nomor Telepon, Jenis Kelamin) wajib diisi.";
                    }

                    if (!empty($nomor_telp) && !filter_var($nomor_telp, FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => '/^\+?[0-9\s\-]+$/']])) {
                        $errors[] = "Baris $line: Format nomor telepon tidak valid.";
                    }

                    if (!empty($gender) && !in_array(strtoupper($gender), ['L', 'P'])) {
                        $errors[] = "Baris $line: Jenis kelamin harus 'L' untuk Laki-laki atau 'P' untuk Perempuan.";
                    }

                    $dataImport[] = [
                        'nama'   => $nama,
                        'nomor_telp'  => $nomor_telp,
                        'gender' => $gender == 'L' ? 'Laki-laki' : ($gender == 'P' ? 'Perempuan' : $gender)
                    ];
                    $line++;
                }
                if(!empty($errors)){
                    echo json_encode(['success' => false, 'message' => 'Terdapat error pada data yang diimport.', 'errors' => $errors]);
                    exit;
                }
                // Simpan data ke database
                foreach ($dataImport as $employee) {
                    $existingCustomer = $this->customerModel->findByPhone($employee['nomor_telp']);
                    if ($existingCustomer) {
                        continue; // Lewati pelanggan yang sudah ada
                    }

                    $this->customerModel->create([
                        'Nama_pelanggan' => $employee['nama'],
                        'Nomor_telp' => $employee['nomor_telp'],
                        'Gender' => $employee['gender'],
                        'Instansi' => $agencyId,
                    ]);
                }
            } catch (Exception $e) {
                echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
            }
            //response
            header('Content-Type: application/json');
            echo json_encode([
                'success' => true,
                'message' => 'Data berhasil diimport!',
                'data' => $data,
                'error' => $errors
                ]);
        }else{
            header('Content-Type: application/json');
            echo json_encode([
                'success' => false,
                'message' => 'Metode request tidak valid!',
                'data' => $data
                ]);
        }
        exit;
    }

    public function fetchEmployees()
    {
        $agencyId = isset($_GET['id']) ? (int) $_GET['id'] : null;
        $employees = $this->customerModel->getEmployeesByAgencyId($agencyId);
        if ($employees == null || count($employees) == 0) {
            echo "<div class=\"text-center text-muted py-4\">
                <i class=\"bi bi-inbox\" style=\"font-size: 3rem;\"></i>
                <p class=\"mt-2\">No employees added yet</p>
            </div>";
        } else {
            echo "<div class=\"overflow-auto\">
                <table class=\"table table-bordered table-striped w-100\" id=\"example1\">
                    <thead>
                        <tr>
                            <th>Nama Pegawai</th>
                            <th>Nomor Telepon</th>
                            <th>Jenis Kelamin</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>";
                        foreach ($employees as $index => $emp) {
                            echo "<tr>";
                                echo "<td>" . htmlspecialchars($emp['Name']) . "</td>";
                                echo "<td>" . htmlspecialchars($emp['PhoneNumber']) . "</td>";
                                echo "<td>" . htmlspecialchars($emp['Gender']) . "</td>";
                                echo "<td>
                                    <div class=\"d-flex gap-2 justify-content-center\">
                                        <button class=\"btn btn-sm btn-warning\" onclick=\"editEmployee(" . $emp['Id'] . ")\">
                                            <i class=\"bi bi-pencil-square\"></i>
                                        </button>
                                        <button class=\"btn btn-sm btn-danger\" onclick=\"deleteEmployee(" . $emp['Id'] . ")\">
                                            <i class=\"bi bi-trash\"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>";
                        }
                    echo "</tbody>
                </table>
            </div>";
        }
    }
    public function getCustomerByAgencyId($id)
    {
        header('Content-Type: application/json');
        $customers = $this->customerModel->getEmployeesByAgencyId($id);
        echo json_encode([
                'success' => true,
                'data' => $customers
            ]);
            exit;
    }
}

?>