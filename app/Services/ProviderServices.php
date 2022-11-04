<?php

namespace App\Services;

use App\Interfaces\IProvidersRepository;

class ProviderServices
{
  private $repository;

  public function __construct(IProvidersRepository $repository)
  {
    $this->repository = $repository;
  }

  public function index()
  {
    $allProviders = $this->repository->findAllProviders();
    return $allProviders;
  }

  public function create($request)
  {
    $provider = $this->repository->create($request);

    return $provider;
  }

  public function update($request, int $id)
  {
    $providerExists = $this->repository->findProviderById($id);
    if (!$providerExists) {
      return false;
    }
    $update = $this->repository->updateProviderById($request->all(), $id);

    return $update;
  }

  public function findProviderById($id)
  {
    $providerExists = $this->repository->findProviderById($id);
    if (!$providerExists) {
      return false;
    }

    return $providerExists;
  }

  public function delete(int $id)
  {
    $providerExists = $this->repository->findProviderById($id);
    if (!$providerExists) {
      return false;
    }
    $remove = $this->repository->deleteProviderById($id);

    return $remove;
  }
}
