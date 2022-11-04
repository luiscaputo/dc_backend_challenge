<?php

namespace App\Repositories;

use App\Interfaces\IProductsRepository;
use App\Models\Products;

class ProductRepository implements IProductsRepository
{
  private $product;

  public function __construct(Products $product)
  {
    $this->product = $product;
  }

  public function create($request)
  {
    return $this->product::create($request);
  }

  public function updateProductById($request, int $id)
  {
    $productExists = $this->findProductById($id);

    if (!$productExists) return false;

    return $this->product::where('id', $id)->update($request);
  }

  public function findProductById($id)
  {
    $productExists = $this->product::find($id);

    return $productExists;
  }

  public function deleteProductById($id)
  {
    $productExists = $this->product::find($id);

    if (!$productExists) return false;

    return $this->product::destroy($id);
  }

  public function findAllProducts()
  {
    return $this->product::all();
  }
}
