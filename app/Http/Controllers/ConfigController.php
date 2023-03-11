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

        $so_hinh = count(explode(",", $request->hinh_anh));

        $list_title = '';
        for($i = 1; $i <= $so_hinh; $i++) {
            $name_input  = 'title_' . $i;
            $list_title .= $request->$name_input;
            if($i != $so_hinh) {
                $list_title .= "|";
            }
        }

        $list_des = '';
        for($i = 1; $i <= $so_hinh; $i++) {
            $name_input  = 'des_' . $i;
            $list_des .= $request->$name_input;
            if($i != $so_hinh) {
                $list_des .= "|";
            }
        }

        $list_link = '';
        for($i = 1; $i <= $so_hinh; $i++) {
            $name_input  = 'link_' . $i;
            $list_link .= $request->$name_input;
            if($i != $so_hinh) {
                $list_link .= "|";
            }
        }

        Config::create([
            'list_image'    =>  $request->hinh_anh,
            'list_title'    =>  $list_title,
            'list_des'      =>  $list_des,
            'list_link'     =>  $list_link,
        ]);

        return response()->json([
            'status'    => true,
            'mess'      => 'Đã cấu hình thành công!',
        ]);
    }
}
