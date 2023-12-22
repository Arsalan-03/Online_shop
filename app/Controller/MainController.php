<?php

namespace Controller;

use Model\Product;
use PDO;

class MainController
{
    private Product $productModel;

    public function __construct()
    {
        $this->productModel = new Product();
    }
    public function getProducts()
    {
        session_start();
        if(!isset($_SESSION['user_id'])) {
            header("Location: /login");
        }else{
            $pdo = new PDO("pgsql:host=db;port=5432;dbname=postgres;", "arsik", "0000");
            $products = $this->productModel->getAll();
        }
        require_once "./../View/main.php";
    }
}