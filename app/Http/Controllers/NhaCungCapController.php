<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateNhaCungCapRequest;
use App\Http\Requests\DeleteNhaCungCapRequest;
use App\Http\Requests\DeleteRequest;
use App\Http\Requests\UpdateNhaCungCapRequest;
use App\Models\NhaCungCap;
use Illuminate\Http\Request;

class NhaCungCapController extends Controller
{
    public function index()
    {
        return view('admin.page.nha_cung_cap.index');
    }

    public function store(CreateNhaCungCapRequest $request)
    {
        $data = $request->all();

        NhaCungCap::create($data);

        return response()->json([
            'status'    => true,
            'message'   => 'Đã tạo mới nhà cung cấp thành công!',
        ]);
    }

    public function data()
    {
        $data = NhaCungCap::all();

        return response()->json([
            'data'  => $data,
        ]);
    }

    public function destroy(DeleteNhaCungCapRequest $request)
    {
        $nhaCungCap = NhaCungCap::where('id', $request->id)->first();
        $nhaCungCap->delete();

        return response()->json([
            'status'    => true,
            'message'   => 'Đã xóa thành công nhà cung cấp!',
        ]);
    }

    public function update(UpdateNhaCungCapRequest $request)
    {
        $data    = $request->all();
        // dd($data);
        $nhaCungCap = NhaCungCap::find($request->id);
        $nhaCungCap->update($data);

        return response()->json([
            'status'    => true,
            'message'   => 'Đã cập nhật thành công nhà cung cấp!',
        ]);
    }
}
