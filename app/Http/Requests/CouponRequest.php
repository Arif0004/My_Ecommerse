<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
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
        if ($this->method() === 'POST') {
            return [
                'name' => ['required', 'unique:coupons,name'],
                'discount' => ['required', 'numeric'],
                'expired_date' => ['required', 'after_or_equal:today'],
            ];
        } else {
            return [
                'name' => ['required', "unique:coupons,name,{$this->coupon->id}"],
                'discount' => ['required', 'numeric'],
                'expired_date' => ['required', 'after_or_equal:today'],
            ];
        }
    }
}
