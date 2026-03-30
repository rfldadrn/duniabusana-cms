<?php 
require_once __DIR__ . '/../Core/Controller.php';
require_once __DIR__ . '/../Models/Customer.php';
require_once __DIR__ . '/../Core/Auth.php';

class SettingsController extends Controller
{
    private $customerModel;

    public function __construct()
    {
        $this->customerModel = new Customer();
        Auth::check();
    }

    public function index()
    {
        $this->view('settings/index', []);
    }
}
?>