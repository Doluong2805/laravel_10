<?php

namespace App\Http\Controllers;

use App\Models\ChuyenMuc;
use App\Models\SanPham;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {

        return view('admin.demo');
    }

    public function jquery()
    {
        return view('admin.page.demo.jquery');
    }

    public function vue()
    {
        return view('admin.page.demo.vue');
    }

    public function demoData()
    {
        return response()->json([
            'message'   => 'Xin chào data demo!',
            'gia_tri'   => random_int(1, 100),
        ]);
    }

    public function chart()
    {
        $chuyenMuc = ChuyenMuc::get();
        $data_chuyen_muc = [];
        $data_id_chuyen_muc = [];
        foreach ($chuyenMuc as $key => $value) {
            array_push($data_chuyen_muc, $value->ten_chuyen_muc);
            array_push($data_id_chuyen_muc, $value->id);
        }

        $sanPham = SanPham::get();
        $data_san_pham = [];
        foreach ($data_id_chuyen_muc as $key => $value) {
            $gia_tri = 0;
            foreach ($sanPham as $key_sp => $value_sp) {
                if($value_sp->id_chuyen_muc == $value) {
                    $gia_tri = $gia_tri + 1;
                }
            }
            array_push($data_san_pham, $gia_tri);
        }

        return view('chart', compact('data_chuyen_muc', 'data_san_pham'));
    }
}
