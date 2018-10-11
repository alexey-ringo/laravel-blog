<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    //Главная страница Админки
    public function dashboard() {
        return view('admin.dashboard');
    }
}
