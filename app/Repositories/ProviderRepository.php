<?php

namespace App\Repositories;

use App\Interfaces\IProvidersRepository;
use App\Models\Provider;

class ProviderRepository implements IProvidersRepository
{
  private $provider;

  public function __construct(Provider $provider)
  {
    $this->provider = $provider;
  }

  public function create($request)
  {
    return $this->provider::create($request);
  }

  public function updateProviderById($request, int $id)
  {
    $providerExists = $this->findProviderById($id);

    if (!$providerExists) return false;

    return $this->provider::where('id', $id)->update($request);
  }

  public function findProviderById($id)
  {
    $providerExists = $this->provider::find($id);

    return $providerExists;
  }

  public function deleteProviderById($id)
  {
    $providerExists = $this->provider::find($id);

    if (!$providerExists) return false;

    return $this->provider::destroy($id);
  }

  public function findAllProviders()
  {
    return $this->provider::all();
  }
}
