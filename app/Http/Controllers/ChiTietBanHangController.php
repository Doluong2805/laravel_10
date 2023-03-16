<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddToCartRequest;
use App\Models\ChiTietBanHang;
use App\Models\SanPham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChiTietBanHangController extends Controller
{
    public function addToCart(AddToCartRequest $request)
    {
        $khachhang = Auth::guard('customer')->check();
        if($khachhang) {
            $khachhang = Auth::guard('customer')->user();
            $sanPham   = SanPham::find($request->id_san_pham);
            $donGia    = $sanPham->gia_khuyen_mai ? $sanPham->gia_khuyen_mai : $sanPham->gia_ban;
            $check     = ChiTietBanHang::where('id_san_pham', $request->id_san_pham)
                                       ->where('id_khach_hang', $khachhang->id)
                                       ->where('id_don_hang', 0)
                                       ->first();
            if($check) {
                $so_luong_new       = $check->so_luong + $request->so_luong;
                $check->so_luong    = $so_luong_new;
                $check->thanh_tien  = $so_luong_new * $donGia;
                $check->save();

                return response()->json([
                    'status'    => 2,
                    'message'   => 'Đã cập nhật số lượng trong giỏ hàng!',
                ]);

            } else {
                ChiTietBanHang::create([
                    'id_san_pham'       =>  $request->id_san_pham,
                    'id_khach_hang'     =>  $khachhang->id,
                    'so_luong'          =>  $request->so_luong,
                    'don_gia'           =>  $donGia,
                    'thanh_tien'        =>  $request->so_luong * $donGia,
                ]);

                return response()->json([
                    'status'    => true,
                    'message'   => 'Đã thêm mới vào giỏ hàng!',
                ]);
            }

        } else {
            return response()->json([
                'status'    => false,
                'message'   => 'Bạn phải đăng nhập trước!',
            ]);
        }
    }
}
