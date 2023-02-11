<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
        return view('admin.share.master_page');
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
}
