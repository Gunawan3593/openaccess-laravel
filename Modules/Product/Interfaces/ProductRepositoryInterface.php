<?php

namespace Modules\Product\Interfaces;

interface ProductRepositoryInterface 
{
    public function getAllProducts();
    public function getProductById($id);
    public function deleteProduct($id);
    public function createProduct(array $product);
    public function updateProduct($id, array $product);
}
