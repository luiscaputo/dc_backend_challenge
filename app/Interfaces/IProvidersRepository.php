<?php

namespace App\Interfaces;

use App\Http\Requests\ProviderRequest;

interface IProvidersRepository
{
  public function create(ProviderRequest $request);
  public function updateProviderById($request, int $id);
  public function findProviderById(int $id);
  public function deleteProviderById(int $id);
  public function findAllProviders();
}
