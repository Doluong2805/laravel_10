<?php

namespace App\Http\Controllers;

use App\Models\Config;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    public function index()
    {
        return view('admin.page.cau_hinh.index');
    }

    public function getData()
    {
        $data = Config::orderByDESC('id')->first();

        return response()->json([
            'data'  => $data
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->all();

        Config::create($data);

        return response()->json([
            'status'    => true,
            'mess'      => 'Đã cấu hình thành công!',
        ]);
    }
}
