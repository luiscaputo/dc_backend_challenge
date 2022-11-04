<?php

namespace App\Interfaces;

use App\Http\Requests\SaleRequest;

interface ISalesRepository
{
  public function create(SaleRequest $request);
  public function updateSaleById($request, int $id);
  public function findSaleById(int $id);
  public function deleteSaleById(int $id);
  public function findAllSales();
}
