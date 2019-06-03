<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ImageController extends Controller
{
    public function upload(Request $request) 
    {
        //'image' - имя в форме, 'uploads' - последняя папка на диске, 'not_public' - имя диска
        $path = $request->file('image')->store('uploads', 'not_public');
        
        //Путь к изображению в БД для вывода в шаблон
        //Image::create();
        
        //return view('admin.articles.partials.form', ['path' => $path]);
        //return view('admin.articles.partials.form', compact('path');
    }
}
