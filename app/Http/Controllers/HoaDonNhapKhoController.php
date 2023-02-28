<?php

namespace App\Http\Controllers;

use App\Models\HoaDonNhapKho;
use App\Models\NhaCungCap;
use Illuminate\Http\Request;

class HoaDonNhapKhoController extends Controller
{
    public function index($id_nha_cung_cap)
    {
        // $nhaCungCap = NhaCungCap::where('id', $id_nha_cung_cap)->first();
        $nhaCungCap = NhaCungCap::find($id_nha_cung_cap);
        if($nhaCungCap) {
            $hoaDonNhapKho = HoaDonNhapKho::where('id_nha_cung_cap', $id_nha_cung_cap)
                                          ->where('tinh_trang', 0) // Đang nhập liệu
                                          ->first();
            if(!$hoaDonNhapKho) {
                $hoaDonNhapKho = HoaDonNhapKho::create([
                    'id_nha_cung_cap'   => $id_nha_cung_cap
                ]);
            }
            return view('admin.page.nhap_kho.index', compact('hoaDonNhapKho'));
        } else {
            toastr()->error('Nhà cung cấp không tồn tại.', "Error!");
            return redirect('/admin/nha-cung-cap/index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HoaDonNhapKho  $hoaDonNhapKho
     * @return \Illuminate\Http\Response
     */
    public function show(HoaDonNhapKho $hoaDonNhapKho)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HoaDonNhapKho  $hoaDonNhapKho
     * @return \Illuminate\Http\Response
     */
    public function edit(HoaDonNhapKho $hoaDonNhapKho)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HoaDonNhapKho  $hoaDonNhapKho
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HoaDonNhapKho $hoaDonNhapKho)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HoaDonNhapKho  $hoaDonNhapKho
     * @return \Illuminate\Http\Response
     */
    public function destroy(HoaDonNhapKho $hoaDonNhapKho)
    {
        //
    }
}
