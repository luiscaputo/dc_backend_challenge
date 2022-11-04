<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProviderRequest;
use App\Services\ProviderServices;
use Exception;
use Symfony\Component\HttpFoundation\Response;


class ProviderController extends Controller
{
  private $service;
  public function __construct(ProviderServices $service)
  {
    $this->service = $service;
  }
  /**
   * All providers.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    try {
      $providers = $this->service->index();
      return response()->json([
        "success" => true,
        "data" => $providers
      ], Response::HTTP_OK);
    } catch (Exception $e) {
      return response()->json([
        'success' => false,
        'message' => $e->getMessage(),
      ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
  }

  /**
   * New provider.
   *
   * @param  App\Http\Requests\IProvidersRepository  $request
   * @return \Illuminate\Http\Response
   */
  public function store(ProviderRequest $request)
  {
    try {
      $provider = $this->service->create($request->all());

      return response()->json([
        'success' => true,
        'data' => $provider,
      ], Response::HTTP_OK);
    } catch (Exception $e) {
      return response()->json([
        'success' => false,
        'message' => $e->getMessage(),
      ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
  }

  /**
   * Update Provider.
   *
   * @param  App\Http\Requests\ProviderRequest  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(ProviderRequest $request, $id)
  {
    try {
      $provider = $this->service->update($request->all(), $id);
      if ($provider == false) {
        return response()->json([
          'success' => true,
          'data' => "Provider " . $id . " is inexistent.",
        ], Response::HTTP_BAD_REQUEST);
      }
      return response()->json([
        'success' => true,
        'data' => $provider,
      ], Response::HTTP_OK);
    } catch (Exception $e) {
      return response()->json([
        'success' => false,
        'message' => $e->getMessage(),
      ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
  }

  /**
   * List Provider by ID.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    try {
      $provider = $this->service->findProviderById($id);
      return response()->json([
        'success' => true,
        'data' => $provider,
      ], Response::HTTP_OK);
    } catch (Exception $e) {
      return response()->json([
        'success' => false,
        'message' => $e->getMessage(),
      ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
  }

  /**
   * Remove Provider by id.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    try {
      $provider = $this->service->delete($id);
      return response()->json([
        'success' => true,
        'data' => $provider,
      ], Response::HTTP_OK);
    } catch (Exception $e) {
      return response()->json([
        'success' => false,
        'message' => $e->getMessage(),
      ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
  }
}
