<?php

namespace App\Http\Controllers;

use App\Http\Requests\Customer\CreateCustomerRequest;
use App\Http\Requests\Customer\LoginCustomerRequest;
use App\Models\KhachHang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KhachHangController extends Controller
{
    public function index()
    {
        return view('client.auth');
    }

    public function register(CreateCustomerRequest $request)
    {
        $data               = $request->all();
        $data['ho_va_ten']  = $request->ho_lot . " " . $request->ten_khach;
        KhachHang::create($data);

        return response()->json([
            'status'    => 1,
            'message'   => 'Đã tạo tài khoản thành công, vui lòng kiểm tra email!',
        ]);
    }
}
