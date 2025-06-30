<?php

namespace App\Seeders;

use PDO;

ini_set('memory_limit', '512M');
ini_set('max_execution_time', '600'); // 10 minutes
class EcommerceSeeder
{
    private PDO $db;

    public function __construct(PDO $pdo)
    {
        $this->db = $pdo;
    }

    public function run(): void
    {
        $query = $this->db->query("SELECT * FROM staging_table");
        $total = 0;

        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            // 1. Insert or get company ID
            $companyId = $this->getOrInsertCompany($row['Company']);

            // 2. Insert or get location ID
            $locationId = $this->getOrInsertLocation($row['City'], $row['Country']);

            // 3. Insert customer
            $customerId = $this->getOrInsertCustomer([
                'customer_uid' => $row['Customer_Id'],
                'first_name' => $row['First_Name'],
                'last_name' => $row['Last_Name'],
                'email' => $row['Email'],
                'subscription_date' => $row['Subscription_Date'],
                'company_id' => $companyId,
                'location_id' => $locationId
            ]);

            // 4. Insert contact
            $this->insertContact($customerId, $row['Phone_1'], $row['Phone_2'], $row['Website']);

            $total++;
        }

        echo "<h3>✅ Seeder completed. Total customers seeded: $total</h3>";
    }

    private function getOrInsertCompany(string $name): int
    {
        $stmt = $this->db->prepare("SELECT id FROM companies WHERE name = ?");
        $stmt->execute([$name]);
        $id = $stmt->fetchColumn();

        if (!$id) {
            $stmt = $this->db->prepare("INSERT INTO companies (name) VALUES (?)");
            $stmt->execute([$name]);
            return (int)$this->db->lastInsertId();
        }

        return (int)$id;
    }

    private function getOrInsertLocation(string $city, string $country): int
    {
        $stmt = $this->db->prepare("SELECT id FROM locations WHERE city = ? AND country = ?");
        $stmt->execute([$city, $country]);
        $id = $stmt->fetchColumn();

        if (!$id) {
            $stmt = $this->db->prepare("INSERT INTO locations (city, country) VALUES (?, ?)");
            $stmt->execute([$city, $country]);
            return (int)$this->db->lastInsertId();
        }

        return (int)$id;
    }

    private function getOrInsertCustomer(array $data): int
    {
        $stmt = $this->db->prepare("SELECT id FROM customers WHERE customer_uid = ?");
        $stmt->execute([$data['customer_uid']]);
        $id = $stmt->fetchColumn();

        if (!$id) {
            $stmt = $this->db->prepare("
                INSERT INTO customers (customer_uid, first_name, last_name, email, subscription_date, company_id, location_id)
                VALUES (:customer_uid, :first_name, :last_name, :email, :subscription_date, :company_id, :location_id)
            ");
            $stmt->execute($data);
            return (int)$this->db->lastInsertId();
        }

        return (int)$id;
    }

    private function insertContact(int $customerId, string $phone1, string $phone2, string $website): void
    {
        $stmt = $this->db->prepare("
            INSERT INTO contacts (customer_id, phone_1, phone_2, website)
            VALUES (?, ?, ?, ?)
        ");
        $stmt->execute([$customerId, $phone1, $phone2, $website]);
    }
}
