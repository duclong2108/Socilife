<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Banner;
class BannerController extends Controller
{
    public function index(Request $request){
        $banner=Banner::first();
        if($request->isMethod('post')){
            $data=$request->all();
            $banner->update($data);
            ALert::success('Thành công', 'Cập Nhật Thành Công');
            return redirect()->back();
        }
        return View('banner.index', compact('banner'));
    }
}
