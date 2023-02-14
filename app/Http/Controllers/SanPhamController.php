<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaoSanPhamRequest;
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

    public function store(TaoSanPhamRequest $request)
    {
        $data = $request->all();

        SanPham::create($data);

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
