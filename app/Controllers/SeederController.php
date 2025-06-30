<?php

namespace App\Controllers;

use App\Seeders\EcommerceSeeder;
use App\Seeders\ProductOrderSeeder;

class SeederController
{
    public function runEcommerceSeeder()
    {
        global $pdo;
        $seeder = new EcommerceSeeder($pdo);
        $seeder->run();
    }

    public function runProductOrderSeeder()
    {
        global $pdo;
        $seeder = new ProductOrderSeeder($pdo);
        $status = $seeder->run();
        $data= array('data' => $status);
        load_view('seeder/product_order_seeder',$data);
    }
}
