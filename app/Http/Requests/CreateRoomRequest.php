<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateRoomRequest extends FormRequest
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
      'name' => 'required|unique:rooms,name',
      'description' => 'required|string',
      'size' => 'required',
      'price' => 'required',
      'images' => 'required|array|min:4',
      'images.*' => 'file|mimes:jpeg,jpg,png,gif',
    ];
  }
}
