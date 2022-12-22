<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
  public function index(Request $request)
  {
    $news = News::all();
    return View('news.index', compact('news'));
  }
  public function create(Request $request)
  {
    if ($request->isMethod('POST')) {
      $data = $request->all();
    }
    return view('news.create');
  }
}