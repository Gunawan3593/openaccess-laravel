<?php

namespace Modules\Product\Repositories;

use Modules\Product\Interfaces\ProductRepositoryInterface;
use Modules\Product\Entities\Product;

class ProductRepository implements ProductRepositoryInterface 
{
    public function getAllProducts() 
    {
        return Product::all();
    }

    public function getProductById($id) 
    {
        return Product::findOrFail($id);
    }

    public function deleteProduct($id) 
    {
        return Product::destroy($id);
    }

    public function createProduct(array $Product) 
    {
        return Product::create($Product);
    }

    public function updateProduct($id, array $Product) 
    {
        Product::whereId($id)->update($Product);
        return Product::findOrFail($id);
    }
}
