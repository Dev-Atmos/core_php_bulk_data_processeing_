<?php

namespace App\Models;

use PDO;

class ImportStagingData
{
    private $db;

    public function __construct()
    {
        global $pdo; // Use the global PDO instance
        $this->db = $pdo;
    }

    // Model properties and methods go here
    public function importData(array $data)
    {
        $this->db->beginTransaction();
        // Example method to import data into the staging table
        $stmt = $this->db->prepare("INSERT INTO staging_table ( Customer_Id,First_Name,Last_Name,Company,City,Country,Phone_1,Phone_2,Email,Subscription_Date,Website
            ) VALUES (:customer_id, :first_name, :last_name, :company, :city, :country, :phone1, :phone2, :email, :subscription_date, :website)");

        foreach ($data as $row) {
            $stmt->execute([
                ':customer_id' => $row['Customer_Id'],
                ':first_name' => $row['First_Name'],
                ':last_name' => $row['Last_Name'],
                ':company' => $row['Company'],
                ':city' => $row['City'],
                ':country' => $row['Country'],
                ':phone1' => $row['Phone_1'],
                ':phone2' => $row['Phone_2'],
                ':email' => $row['Email'],
                ':subscription_date' => $row['Subscription_Date'],
                ':website' => $row['Website']
            ]);
        }

        $this->db->commit();
    }

    public function getStagingData()
    {
        $stmt = $this->db->query("SELECT * FROM staging_table");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function clearStagingData()
    {
        $this->db->exec("TRUNCATE TABLE staging_table");
    }
    public function deleteStagingData($customerId)
    {
        $stmt = $this->db->prepare("DELETE FROM staging_table WHERE Customer_Id = :customer_id");
        $stmt->execute([':customer_id' => $customerId]);
    }
}
//         
