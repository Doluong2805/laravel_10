<?php

namespace App\Http\Controllers;

use App\Http\Requests\Customer\CreateCustomerRequest;
use App\Http\Requests\Customer\LoginCustomerRequest;
use App\Models\KhachHang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KhachHangController extends Controller
{
    public function viewRegister()
    {
        return view('customer.registerCustomer');
    }

    public function actionRegister(CreateCustomerRequest $request)
    {
        $data = $request->all();

        $data['password'] = bcrypt($request->password);

        KhachHang::create($data);

        return response()->json([
            'status'     =>  true,
            'message'    => 'Đã tạo tài khoản thành công!',
        ]);
    }




    public function viewLogin()
    {
        return view('customer.loginCustomer');
    }

    public function actionLogin(LoginCustomerRequest $request)
    {

        $data['email']      = $request->email;
        $data['password']   = $request->password;

        $check = Auth::guard('customer')->attempt($data);

        return response()->json([
            'status'    => $check,
        ]);
    }
}
