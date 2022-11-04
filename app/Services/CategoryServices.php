<?php

namespace App\Services;

use App\Interfaces\ICategoriesRepository;

class CategoryServices
{
  private $repository;

  public function __construct(ICategoriesRepository $repository)
  {
    $this->repository = $repository;
  }

  public function index()
  {
    $allCategories = $this->repository->findAllCategories();
    return $allCategories;
  }

  public function create($request)
  {
    $category = $this->repository->create($request);

    return $category;
  }

  public function update($request, int $id)
  {
    $categoryExists = $this->repository->findCategoryById($id);
    if (!$categoryExists) {
      return false;
    }
    $update = $this->repository->updateCategoryById($request->all(), $id);

    return $update;
  }

  public function findCategoryById($id)
  {
    $categoryExists = $this->repository->findCategoryById($id);
    if (!$categoryExists) {
      return false;
    }

    return $categoryExists;
  }

  public function delete(int $id)
  {
    $categoryExists = $this->repository->findCategoryById($id);
    if (!$categoryExists) {
      return false;
    }
    $remove = $this->repository->deleteCategoryById($id);

    return $remove;
  }
}
