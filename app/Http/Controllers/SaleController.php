<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaleRequest;
use App\Services\SaleServices;
use Exception;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;


class SaleController extends Controller
{
  private $service, $validationRules = [];
  public function __construct(SaleServices $service)
  {
    $this->service = $service;
    $this->validationRules = [
      'client_name' => 'required|string',
      'description' => 'nullable|string',
      'quantity' => 'required|numeric',
      'product_id' => 'required|numeric',
    ];
  }
  /**
   * All Sales.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    try {
      $sales = $this->service->index();
      return response()->json([
        "success" => true,
        "data" => $sales
      ], Response::HTTP_OK);
    } catch (Exception $e) {
      return response()->json([
        'success' => false,
        'message' => $e->getMessage(),
      ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
  }

  /**
   * New Sale.
   *
   * @param  App\Http\Requests\ISalesRepository  $request
   * @return \Illuminate\Http\Response
   */
  public function store(SaleRequest $request)
  {
    try {
      $validator = Validator::make($request->all(), $this->validationRules);

      if ($validator->fails()) {
        return response()->json([
          'success' => true,
          'data' => $validator->errors(),
        ], Response::HTTP_BAD_REQUEST);
      }
      $sale = $this->service->create($request);
      return response()->json([
        'success' => true,
        'data' => $sale,
      ], Response::HTTP_OK);
    } catch (Exception $e) {
      return response()->json([
        'success' => false,
        'message' => $e->getMessage(),
      ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
  }

  /**
   * Update Sale.
   *
   * @param  App\Http\Requests\SaleRequest  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(SaleRequest $request, $id)
  {
    try {
      $sale = $this->service->update($request->all(), $id);
      if ($sale == false) {
        return response()->json([
          'success' => true,
          'data' => "sale " . $id . " is inexistent.",
        ], Response::HTTP_BAD_REQUEST);
      }
      return response()->json([
        'success' => true,
        'data' => $sale,
      ], Response::HTTP_OK);
    } catch (Exception $e) {
      return response()->json([
        'success' => false,
        'message' => $e->getMessage(),
      ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
  }

  /**
   * List sale by ID.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    try {
      $sale = $this->service->findSaleById($id);
      return response()->json([
        'success' => true,
        'data' => $sale,
      ], Response::HTTP_OK);
    } catch (Exception $e) {
      return response()->json([
        'success' => false,
        'message' => $e->getMessage(),
      ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
  }

  /**
   * Remove sale by id.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    try {
      $sale = $this->service->delete($id);
      return response()->json([
        'success' => true,
        'data' => $sale,
      ], Response::HTTP_OK);
    } catch (Exception $e) {
      return response()->json([
        'success' => false,
        'message' => $e->getMessage(),
      ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
  }
}
