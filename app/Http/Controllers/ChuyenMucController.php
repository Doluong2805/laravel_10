<?php

namespace App\Http\Controllers;

use App\Models\ChuyenMuc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChuyenMucController extends Controller
{
    public function index()
    {
        return view('admin.page.chuyen_muc.index');
    }

    public function data()
    {
        $sql  = "SELECT A.*, B.ten_chuyen_muc as ten_chuyen_muc_cha
                 FROM chuyen_mucs A LEFT JOIN chuyen_mucs B
                 on A.id_chuyen_muc_cha = B.id";
        $data = DB::select($sql);
        return response()->json([
            'list' => $data
        ]);
    }

    public function store(Request $request)
    {
        ChuyenMuc::create([
            'ten_chuyen_muc'        => $request->ten_chuyen_muc,
            'slug_chuyen_muc'       => $request->slug_chuyen_muc,
            'tinh_trang'            => $request->tinh_trang,
            'id_chuyen_muc_cha'     => $request->id_chuyen_muc_cha,
        ]);

        return response()->json([
            'xxx' => true
        ]);
    }

    public function doiTrangThai($id)
    {
        $chuyenMuc = ChuyenMuc::where('id', $id)->first(); // ChuyenMuc::find($id);
        if($chuyenMuc) {
            $chuyenMuc->tinh_trang = !$chuyenMuc->tinh_trang;
            $chuyenMuc->save();

            return response()->json([
                'status' => 'ABC',
            ]);
        } else {
            return response()->json([
                'status' => 'XYZ',
            ]);
        }
    }

    public function destroy($id)
    {
        $chuyenMuc = ChuyenMuc::find($id); // ChuyenMuc::where('id', $id)->first();
        if($chuyenMuc) {
            $chuyenMuc->delete();
            return response()->json([
                'status' => true
            ]);
        } else {
            return response()->json([
                'status' => false
            ]);
        }
    }

    public function edit($id)
    {
        $chuyenMuc = ChuyenMuc::find($id); // ChuyenMuc::where('id', $id)->first();
        if($chuyenMuc) {
            return response()->json([
                'status' => true,
                'data'   => $chuyenMuc,
            ]);
        } else {
            return response()->json([
                'status' => false
            ]);
        }
    }

    public function update(Request $request)
    {
        $chuyenMuc = ChuyenMuc::find($request->id);
        if($chuyenMuc) {
            // update và return true
            $chuyenMuc->ten_chuyen_muc        = $request->ten_chuyen_muc;
            $chuyenMuc->slug_chuyen_muc       = $request->slug_chuyen_muc;
            $chuyenMuc->tinh_trang            = $request->tinh_trang;
            $chuyenMuc->id_chuyen_muc_cha     = $request->id_chuyen_muc_cha;
            $chuyenMuc->save();

            return response()->json([
                'status' => true
            ]);
        } else {
            return response()->json([
                'status' => false
            ]);
        }
    }
}
