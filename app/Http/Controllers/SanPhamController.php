<?php

namespace App\Http\Controllers;

use App\Models\SanPham;
use Illuminate\Http\Request;

class SanPhamController extends Controller
{
    public function index_old()
    {
        return view('admin.page.san_pham.index');
    }

    public function index()
    {
        return view('admin.page.san_pham.index_vue');
    }

    public function store(Request $request)
    {
        SanPham::create([
            'ten_san_pham'                  => $request->ten_san_pham,
            'slug_san_pham'                 => $request->slug_san_pham,
            'hinh_anh'                      => $request->hinh_anh,
            'mo_ta'                         => $request->mo_ta,
            'id_chuyen_muc'                 => $request->id_chuyen_muc,
            'trang_thai'                    => $request->trang_thai,
        ]);

        return response()->json([
            'status'    => true,
            'message'   => 'Đã thêm mới sản phẩm thành công!',
        ]);
    }

    public function data()
    {
        $data = SanPham::get();

        return response()->json([
            'data'  => $data,
        ]);
    }
}
