<?php 
require_once __DIR__ . '/../Core/Controller.php';
require_once __DIR__ . '/../Models/Agency.php';
require_once __DIR__ . '/../Core/Auth.php';

class AgencyController extends Controller
{
    private $agencyModel;

    public function __construct()
    {
        $this->agencyModel = new Agency();
        Auth::check();
    }

    public function index()
    {
        $agencies = $this->agencyModel->all();
        $this->view('agency/index', ['agencies' => $agencies]);
    }

    public function create()
    {
        $agency = [
            'Name' => '',
            'Description' => '',
            'StartDate' => '',
            'TargetDate' => ''
        ];
        $this->view('agency/detail',compact('agency'));
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'Name' => $_POST['Name'],
                'Description' => $_POST['Description'],
                'StartDate' => $_POST['StartDate'],
                'TargetDate' => $_POST['TargetDate']
            ];
            $lastInsertID = $this->agencyModel->create($data);
            $_SESSION['success'] = 'Instansi berhasil ditambahkan!';
            header('Location: ' . BASE_URL . '/agency/edit/' . $lastInsertID);
        }
    }

    public function edit($id)
    {
        $agency = $this->agencyModel->find($id);
        if (!$agency) {
            header('Location: ' . BASE_URL . '/agencies');
            exit;
        }
        $employee = $this->agencyModel->getEmployeeByAgencyId($id);
        $this->view('agency/detail', ['agency' => $agency, 'employee' => $employee]);
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['Id'];
            $data = [
                'Name' => $_POST['Name'],
                'Description' => $_POST['Description'],
                'StartDate' => $_POST['StartDate'],
                'TargetDate' => $_POST['TargetDate']
            ];
            $this->agencyModel->update($id, $data);
            $_SESSION['success'] = 'Instansi berhasil diperbarui!';
            header('Location: ' . BASE_URL . '/agency/edit/' . $id);
        }
    }

    public function delete($id)
    {
        $this->agencyModel->delete($id);
        header('Location: ' . BASE_URL . '/agencies');
    }
}
?>