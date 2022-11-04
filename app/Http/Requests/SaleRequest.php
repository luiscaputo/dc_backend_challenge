<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaleRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    return [
      'client_name' => 'required|string',
      'description' => 'nullable',
      'phone' => 'nullable|string',
      'quantity' => 'required|integer',
      'amount' => 'required|numeric',
      'product_id' => 'integer|products,id',
    ];
  }
}
