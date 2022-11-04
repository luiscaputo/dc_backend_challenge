<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Services\ProductServices;
use Exception;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;


class ProductController extends Controller
{
  private $service, $validationRules = [];
  public function __construct(ProductServices $service)
  {
    $this->service = $service;
    $this->validationRules = [
      'name' => 'required|unique:products',
      'description' => 'string|nullable',
      'quantity' => 'required|numeric',
      'price' => 'required|numeric',
    ];
  }
  /**
   * All products.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    try {
      $products = $this->service->index();
      return response()->json([
        "success" => true,
        "data" => $products
      ], Response::HTTP_OK);
    } catch (Exception $e) {
      return response()->json([
        'success' => false,
        'message' => $e->getMessage(),
      ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
  }

  /**
   * New Product.
   *
   * @param  App\Http\Requests\IProductsRepository  $request
   * @return \Illuminate\Http\Response
   */
  public function store(ProductRequest $request)
  {
    try {
      $validator = Validator::make($request->all(), $this->validationRules);

      if ($validator->fails()) {
        return response()->json([
          'success' => true,
          'data' => $validator->errors(),
        ], Response::HTTP_BAD_REQUEST);
      }
      $product = $this->service->create($request->all());
      return response()->json([
        'success' => true,
        'data' => $product,
      ], Response::HTTP_OK);
    } catch (Exception $e) {
      return response()->json([
        'success' => false,
        'message' => $e->getMessage(),
      ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
  }

  /**
   * Update Product.
   *
   * @param  App\Http\Requests\ProductRequest  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(ProductRequest $request, $id)
  {
    try {
      $product = $this->service->update($request->all(), $id);
      if ($product == false) {
        return response()->json([
          'success' => true,
          'data' => "product " . $id . " is inexistent.",
        ], Response::HTTP_BAD_REQUEST);
      }
      return response()->json([
        'success' => true,
        'data' => $product,
      ], Response::HTTP_OK);
    } catch (Exception $e) {
      return response()->json([
        'success' => false,
        'message' => $e->getMessage(),
      ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
  }

  /**
   * List product by ID.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    try {
      $product = $this->service->findProductById($id);
      return response()->json([
        'success' => true,
        'data' => $product,
      ], Response::HTTP_OK);
    } catch (Exception $e) {
      return response()->json([
        'success' => false,
        'message' => $e->getMessage(),
      ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
  }

  /**
   * Remove product by id.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    try {
      $product = $this->service->delete($id);
      return response()->json([
        'success' => true,
        'data' => $product,
      ], Response::HTTP_OK);
    } catch (Exception $e) {
      return response()->json([
        'success' => false,
        'message' => $e->getMessage(),
      ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
  }
}
