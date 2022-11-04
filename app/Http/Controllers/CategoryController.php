<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Services\CategoryServices;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
  private $service;
  public function __construct(CategoryServices $service)
  {
    $this->service = $service;
  }
  /**
   * All Categories.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    try {
      $categories = $this->service->index();
      return response()->json([
        "success" => true,
        "data" => $categories
      ], Response::HTTP_OK);
    } catch (Exception $e) {
      return response()->json([
        'success' => false,
        'message' => $e->getMessage(),
      ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
  }

  /**
   * New Category.
   *
   * @param  App\Http\Requests\ICategoriesRepository  $request
   * @return \Illuminate\Http\Response
   */
  public function store(CategoryRequest $request)
  {
    try {
      $category = $this->service->create($request->all());
      return response()->json([
        'success' => true,
        'data' => $category,
      ], Response::HTTP_OK);
    } catch (Exception $e) {
      return response()->json([
        'success' => false,
        'message' => $e->getMessage(),
      ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
  }

  /**
   * Update Category.
   *
   * @param  App\Http\Requests\CategoryRequest  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(CategoryRequest $request, $id)
  {
    try {
      $category = $this->service->update($request->all(), $id);
      if ($category == false) {
        return response()->json([
          'success' => true,
          'data' => "Category " . $id . " is inexistent.",
        ], Response::HTTP_BAD_REQUEST);
      }
      return response()->json([
        'success' => true,
        'data' => $category,
      ], Response::HTTP_OK);
    } catch (Exception $e) {
      return response()->json([
        'success' => false,
        'message' => $e->getMessage(),
      ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
  }

  /**
   * List Category by ID.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    try {
      $category = $this->service->findCategoryById($id);
      return response()->json([
        'success' => true,
        'data' => $category,
      ], Response::HTTP_OK);
    } catch (Exception $e) {
      return response()->json([
        'success' => false,
        'message' => $e->getMessage(),
      ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
  }

  /**
   * Remove Category by id.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    try {
      $category = $this->service->delete($id);
      return response()->json([
        'success' => true,
        'data' => $category,
      ], Response::HTTP_OK);
    } catch (Exception $e) {
      return response()->json([
        'success' => false,
        'message' => $e->getMessage(),
      ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
  }
}
