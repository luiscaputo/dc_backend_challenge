<?php

namespace App\Services;

use App\Interfaces\ICategoriesRepository;
use App\Interfaces\IProductsRepository;
use App\Interfaces\IProvidersRepository;
use Error;

class ProductServices
{
  private $repository;

  public function __construct(
    IProductsRepository $repository,
    IProvidersRepository $pRepository,
    ICategoriesRepository $cRepository
  ) {
    $this->repository = $repository;
    $this->pRepository = $pRepository;
    $this->cRepository = $cRepository;
  }

  public function index()
  {
    $allProducts = $this->repository->findAllProducts();
    return $allProducts;
  }

  public function create($request)
  {
    $provider = $this->pRepository->findProviderById($request['provider_id']);
    if (empty($provider)) {
      throw new Error('Provider Not found', 401);
    }

    $category = $this->cRepository->findCategoryById($request['categories_id']);
    if (empty($category)) {
      throw new Error('Category Not found', 401);
    }

    if ($request['quantity'] <= 0) {
      throw new Error('Invalid quantity', 401);
    }
    $product = $this->repository->create($request);

    return $product;
  }

  public function update($request, int $id)
  {
    $productExists = $this->repository->findProductById($id);
    if (!$productExists) {
      return false;
    }
    $update = $this->repository->updateProductById($request->all(), $id);

    return $update;
  }

  public function findProductById($id)
  {
    $productExists = $this->repository->findProductById($id);
    if (!$productExists) {
      return false;
    }

    return $productExists;
  }

  public function delete(int $id)
  {
    $productExists = $this->repository->findProductById($id);
    if (!$productExists) {
      return false;
    }
    $remove = $this->repository->deleteProductById($id);

    return $remove;
  }
}
