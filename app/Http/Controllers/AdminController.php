<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index_form()
    {
        $data = Admin::get(); //Admin::all();

        return view('admin.page.tai_khoan.index_form', compact('data'));
    }

    public function create_form(Request $request)
    {
        $data = $request->all();

        Admin::create($data);

        return redirect('/admin/tai-khoan/index-form');
    }

    public function create_ajax(Request $request)
    {
        $data = $request->all();

        Admin::create($data);

        return response()->json([
            'status'    => true
        ]);
    }

    public function index_ajax()
    {
        return view('admin.page.tai_khoan.index_ajax');
    }

    public function index_vue()
    {
        return view('admin.page.tai_khoan.index_vue');
    }

    public function data()
    {
        $data = Admin::get();

        return response()->json([
            'data'  => $data,
        ]);
    }
}
