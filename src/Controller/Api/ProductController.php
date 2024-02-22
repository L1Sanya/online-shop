<?php

namespace Controller\Api;

use Model\Product;

class ProductController
{
    public function index()
    {
        $products = Product::getAll();

        $products = json_encode($products, JSON_THROW_ON_ERROR);

        return $products;
    }
}