<?php

namespace App\Interfaces;

use App\Http\Requests\ProductRequest;

interface IProductsRepository
{
  public function create(ProductRequest $request);
  public function updateProductById($request, int $id);
  public function findProductById(int $id);
  public function deleteProductById(int $id);
  public function findAllProducts();
}
