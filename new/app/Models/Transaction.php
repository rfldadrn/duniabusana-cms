<?php

require_once __DIR__ . '/../Core/Model.php';


class Transaction extends Model{
    public function all(){
        $result = $this->query("SELECT 
                                    t.Id,
                                    t.TransactionCode,
                                    t.Amount,
                                    t.TransactionDate,
                                    t.CompletionDate,
                                    t.Created_At,
                                    c.Name AS CustomerName,
                                    c.PhoneNumber AS CustomerPhone,
                                    IFNULL(a.Name, 'Pribadi') AS AgencyName
                                FROM Transactions t
                                INNER JOIN Customers c ON t.CustomerId = c.Id
                                LEFT JOIN Agencies a ON t.AgencyId = a.Id
                                WHERE t.RowStatus = 1
                                ORDER BY t.Id DESC
                            ");

        return $this->fetchAll($result);   
    }   

    public function find($id){
        $result = $this->query("SELECT transactions.id, transactions.amount, transactions.description, transactions.created_at, customers.nama_pelanggan, customers.phone_number
                                FROM transactions JOIN customers ON transactions.customerId = customers.id 
                                WHERE transactions.id = ? AND transactions.rowstatus = 1 AND customers.rowstatus = 1", [$id]);
        return $this->fetch($result);
    }

    public function create($data){

    }

    public function update($id, $data){

    }

    public function delete($id){

    }

    function generateTransactionNumber()
    {
        $prefix = date('Ym'); // Example: 202602

        try {
            $stmt = $this->query("
                SELECT TransactionCode 
                FROM Transactions 
                WHERE LEFT(TransactionCode, 6) = '$prefix'
                ORDER BY TransactionCode DESC
                LIMIT 1
                FOR UPDATE
            ");
            $row = $this->fetch($stmt);

            if ($row) {
                $lastIncrement = (int) substr($row['TransactionCode'], -4);
                $newIncrement = $lastIncrement + 1;
            } else {
                $newIncrement = 1;
            }

            $newNumber = $prefix . str_pad($newIncrement, 4, '0', STR_PAD_LEFT);

            return $newNumber;

        } catch (Exception $e) {
            throw $e;
        }
    }

}