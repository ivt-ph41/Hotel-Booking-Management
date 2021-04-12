<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateBookingRequest extends FormRequest
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
            'email' => 'required',
            'phone' => 'required|numeric',
            'address' => 'required',
            'date_start' => 'required|before:date_end',
            'date_end' => 'required'
        ];
    }
    public function messages()
    {
      return [
        'email.required' => 'Please enter your email!',
        'phone.required' => 'Please enter your phone number!',
        'address.required' => 'Please enter your address!',
        'phone.numeric' => 'Phone number must be a numeric!',
        'date_start.before' => 'The date start must less than the date end'
      ];
    }
}
