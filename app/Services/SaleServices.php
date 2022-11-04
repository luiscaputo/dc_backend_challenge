<?php

namespace App\Services;

use App\Interfaces\IProductsRepository;
use App\Interfaces\ISalesRepository;
use App\Models\Sale;
use Error;

class SaleServices
{
  private $repository;
  private $pRepository;


  public function __construct(
    IProductsRepository $pRepository,
    ISalesRepository $repository
  ) {
    $this->repository = $repository;
    $this->pRepository = $pRepository;
  }

  public function index()
  {
    $allSales = $this->repository->findAllSales();
    return $allSales;
  }

  public function create($request)
  {
    $product = $this->pRepository->findProductById($request['product_id']);
    if (empty($product)) {
      throw new Error('Product Not found', 401);
    }

    if ($request['quantity'] > $product->quantity) {
      throw new Error('Insufficient product quantity', 401);
    }


    if ($request['quantity'] <= 0) {
      throw new Error('Invalid quantity', 401);
    }

    $amount = $product->price * $request['quantity'];
    $product->quantity -= $request['quantity'];
    $product->save();

    // $id = $product->id;
    // $this->pRepository->updateProductById($product, $id);

    $saleModel = new Sale();
    $saleModel->client_name = $request->client_name;
    $saleModel->description = $request->description;
    $saleModel->quantity = $request->quantity;
    $saleModel->product_id = $request->product_id;
    $saleModel->amount = $amount;
    $saleModel->save();

    return $saleModel;
  }

  public function update($request, int $id)
  {
    $saleExists = $this->repository->findSaleById($id);
    if (!$saleExists) {
      return false;
    }
    $update = $this->repository->updateSaleById($request->all(), $id);

    return $update;
  }

  public function findSaleById($id)
  {
    $saleExists = $this->repository->findSaleById($id);
    if (!$saleExists) {
      return false;
    }

    return $saleExists;
  }

  public function delete(int $id)
  {
    $saleExists = $this->repository->findSaleById($id);
    if (!$saleExists) {
      return false;
    }
    $remove = $this->repository->deleteSaleById($id);

    return $remove;
  }
}
