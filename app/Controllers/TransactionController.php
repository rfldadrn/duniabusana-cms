<?php

require_once __DIR__ . '/../Core/Controller.php';
require_once __DIR__ . '/../Models/User.php';
require_once __DIR__ . '/../Models/Role.php';
require_once __DIR__ . '/../Core/Auth.php';
require_once __DIR__ . '/../Models/Menu.php';
require_once __DIR__ . '/../Models/Transaction.php';
require_once __DIR__ . '/../Models/Customer.php';
require_once __DIR__ . '/../Models/DropdownMapping.php';
require_once __DIR__ . '/../Models/Item.php';

class TransactionController extends Controller{
    private $transactionModel;
    private $customerModel;
    private $dropdownMappingModel;
    private $itemModel;
    public function __construct()
    {
        $this->transactionModel = new Transaction();
        $this->customerModel = new Customer();
        $this->dropdownMappingModel = new DropdownMapping();
        $this->itemModel = new Item();
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        // pastikan hanya admin yang bisa mengakses TransactionController
        Auth::role('transactions') == false? $this->renderPage('errors/403') : '';
    }

    public function index()
    {
        Auth::check();
        $transactions = $this->transactionModel->all();
        return $this->view('transaction/index', compact('transactions'));
    }

    public function create()
    {
        $transaction = [
            'CustomerId' => '',
            'AgencyId' => '',
            'TransactionDate' => '',
            'CompletionDate' => '',
            'Status' => ''
        ];
        $customers = $this->customerModel->all();
        $agencies = $this->dropdownMappingModel->getAllAgencies();
        $paymentMethods = $this->dropdownMappingModel->getPaymentMethods();
        $items = $this->itemModel->all();
        $transactionCode = $this->transactionModel->generateTransactionNumber();
        $this->view('transaction/detail', compact('transaction', 'transactionCode', 'customers', 'agencies', 'paymentMethods', 'items'));
    }

    public function getSizeProperties()
    {
        header('Content-Type: application/json');
        
        $itemId = $_GET['itemId'] ?? null;
        
        if (!$itemId) {
            echo json_encode([
                'success' => false,
                'message' => 'Item ID is required'
            ]);
            return;
        }

        try {
            // Query to get size properties for the item
            // Adjust this query based on your database structure
            $query = $this->itemModel->itemProperties($itemId);


            echo json_encode([
                'success' => true,
                'data' => $query
            ]);
        } catch (Exception $e) {
            echo json_encode([
                'success' => false,
                'message' => 'Error fetching size properties: ' . $e->getMessage()
            ]);
        }
    }
}