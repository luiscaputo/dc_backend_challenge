<?php

namespace App\Interfaces;

use App\Http\Requests\CategoryRequest;

interface ICategoriesRepository
{
  public function create(CategoryRequest $request);
  public function updateCategoryById($request, int $id);
  public function findCategoryById(int $id);
  public function deleteCategoryById(int $id);
  public function findAllCategories();
}
