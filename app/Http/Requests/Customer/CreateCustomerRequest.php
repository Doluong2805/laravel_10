<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class CreateCustomerRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'ho_va_ten'         =>  'required|min:5|max:100',
            'email'             =>  'required|email|unique:khach_hangs,email',
            'password'          =>  'required|min:6|max:30',
            'so_dien_thoai'     =>  'required|digits:10',
            'ngay_sinh'         =>  'required|date',
            'gioi_tinh'         =>  'required',
        ];
    }

    public function messages()
    {
        return [
            'ho_va_ten.*'         =>  'Họ và tên phải từ 5 ký tự',
            'email.*'             =>  'Email không đúng định dạng hoặc đã tồn tại!',
            'password.*'          =>  'Mật khẩu phải từ 6 đến 30 ký tự!',
            'so_dien_thoai.*'     =>  'Số điện thoại chỉ được 10 số!',
            'ngay_sinh.*'         =>  'Ngày sinh không giống định dạng!',
            'gioi_tinh.*'         =>  'Bạn phải chọn giới tính!',
        ];
    }
}
