<?php

namespace App\Seeders;

use PDO;
ini_set('memory_limit', '512M');
ini_set('max_execution_time', '600'); // 10 minutes
class ProductOrderSeeder
{
    private PDO $db;
    private $chunkSize = 1000;

    public function __construct(PDO $pdo)
    {
        $this->db = $pdo;
    }

    public function run()
    {
        // $seededCategories = $this->seedCategories();
        // $seededProducts = $this->seedProducts();
        $orderSeeding = $this->seedOrdersLinkedToStagingCustomers();
        return [
            // 'message' => $orderSeeding ?? 'No message provided.',
            // 'seededCategories' => $seededCategories,
            // 'seededProducts' => $seededProducts,
            'orderSeeding' => $orderSeeding
        ];
    }

    private function seedCategories(): void
    {
        $categories = [
            'Electronics',
            'Books',
            'Clothing',
            'Home & Kitchen',
            'Beauty & Health',
            'Toys & Games',
            'Sports & Outdoors',
            'Automotive',
            'Grocery',
            'Office Supplies'
        ];

        $stmt = $this->db->prepare("INSERT INTO categories (name, slug) VALUES (?, ?)");
        foreach ($categories as $name) {
            $slug = strtolower(str_replace([' & ', ' '], [' and ', '_'], $name));
            $stmt->execute([$name, $slug]);
        }
    }

    private function seedProducts(): void
    {
        $stmt = $this->db->prepare("
            INSERT INTO products (name, slug, description, price, stock, category_id)
            VALUES (?, ?, ?, ?, ?, ?)
        ");

        for ($i = 1; $i <= 100; $i++) {
            $name = "Product $i";
            $slug = "product_$i";
            $desc = "This is the description of $name.";
            $price = rand(100, 2000) / 10;
            $stock = rand(10, 300);
            $catId = rand(1, 10);
            $stmt->execute([$name, $slug, $desc, $price, $stock, $catId]);
        }
    }

    private function seedOrdersLinkedToStagingCustomers()
    {
        // Map: staging_table.Customer_Id → customers.id
        $mapStmt = $this->db->query("
            SELECT c.id, s.Customer_Id
            FROM customers c
            INNER JOIN staging_table s ON c.customer_uid = s.Customer_Id
        ");
        $customerMap = $mapStmt->fetchAll(PDO::FETCH_KEY_PAIR); // [Customer_Id => customer.id]

        if (empty($customerMap)) {
            echo "⚠ No customer mapping found between staging_table and customers.";
            return;
        }

        $insertOrder = $this->db->prepare("
            INSERT INTO orders (customer_id, order_date, total, status)
            VALUES (?, NOW(), ?, 'paid')
        ");
        $insertItem = $this->db->prepare("
            INSERT INTO order_items (order_id, product_id, quantity, price)
            VALUES (?, ?, ?, ?)
        ");
        $insertPayment = $this->db->prepare("
            INSERT INTO payments (order_id, payment_date, amount, method, status)
            VALUES (?, NOW(), ?, 'credit_card', 'completed')
        ");

        $i = 0;
        $lastid = 0;
        $totalSeeded = 0;

        $customerChunk = $this->getCustomerChunk($lastid);
        if (empty($customerChunk)) {
            echo "⚠ No customers found in the chunk.";
            return;
        }


        do {
            $customerChunk = $this->getCustomerChunk($lastid);
            if (empty($customerChunk)) {
                echo "⚠ No customers found in the chunk.";
                return;
            }

            foreach ($customerChunk as $customer) {

                $total = 0;
                $items = [];

                $numItems = rand(1, 5);
                for ($j = 0; $j < $numItems; $j++) {
                    $productId = rand(1, 10);
                    $qty = rand(1, 3);
                    $price = rand(100, 1500) / 10;
                    $total += $price * $qty;
                    $items[] = [$productId, $qty, $price];
                }

                $insertOrder->execute([$customer['id'], $total]);
                $orderId = $this->db->lastInsertId();

                foreach ($items as [$pid, $qty, $price]) {
                    $insertItem->execute([$orderId, $pid, $qty, $price]);
                }

                $insertPayment->execute([$orderId, $total]);
                $lastid = $customer['id'];
            }
            $totalSeeded += count($customerChunk);
            // Update last ID for next chunk
        } while (count($customerChunk) <= $this->chunkSize);

        $data = [
            'lastid' => $lastid,
            'totalSeeded' => $totalSeeded,
            'customerMapCount' => count($customerMap),
            'customersCount' => $this->db->query("SELECT COUNT(*) FROM customers")->fetchColumn()
        ];
        return $data;
    }

    private function getCustomerChunk(int $lastId): array
    {
        $stmt = $this->db->prepare(
            "SELECT c.id from customers c
             INNER JOIN staging_table s ON c.customer_uid = s.Customer_Id
             WHERE c.id > ? 
             ORDER BY c.id ASC
             LIMIT ?"
        );
        $stmt->execute([$lastId, $this->chunkSize]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
