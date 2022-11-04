<?php

namespace App\Repositories;

use App\Interfaces\ICategoriesRepository;
use App\Models\Category;

class CategoryRepository implements ICategoriesRepository
{
  private $category;

  public function __construct(Category $category)
  {
    $this->category = $category;
  }

  public function create($request)
  {
    return $this->category::create($request);
  }

  public function updateCategoryById($request, int $id)
  {
    $categoryExists = $this->findCategoryById($id);

    if (!$categoryExists) return false;

    return $this->category::where('id', $id)->update($request);
  }

  public function findCategoryById($id)
  {
    $categoryExists = $this->category::find($id);

    return $categoryExists;
  }

  public function deleteCategoryById($id)
  {
    $categoryExists = $this->category::find($id);

    if (!$categoryExists) return false;

    return $this->category::destroy($id);
  }

  public function findAllCategories()
  {
    return $this->category::all();
  }
}
