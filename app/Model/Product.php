<?php

namespace Model;


class Product extends Model
{

    public function getAll(): array
    {
        $statement = $this->pdo->query("SELECT * FROM products");
        $products = $statement->fetchAll();

        return $products;
    }
}


