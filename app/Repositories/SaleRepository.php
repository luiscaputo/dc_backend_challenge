<?php

namespace App\Repositories;

use App\Interfaces\ISalesRepository;
use App\Models\Sale;

class SaleRepository implements ISalesRepository
{
  private $sale;

  public function __construct(Sale $sale)
  {
    $this->sale = $sale;
  }

  public function create($request)
  {
    return $this->sale::create($request);
  }

  public function updateSaleById($request, int $id)
  {
    $SaleExists = $this->findSaleById($id);

    if (!$SaleExists) return false;

    return $this->Sale::where('id', $id)->update($request);
  }

  public function findSaleById($id)
  {
    $SaleExists = $this->Sale::find($id);

    return $SaleExists;
  }

  public function deleteSaleById($id)
  {
    $SaleExists = $this->Sale::find($id);

    if (!$SaleExists) return false;

    return $this->Sale::destroy($id);
  }

  public function findAllSales()
  {
    return $this->Sale::all();
  }
}
