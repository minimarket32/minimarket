<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenuController extends Controller


{
    public function index()
{
    if (!session()->has('usuario_id')) {
        return redirect('/login');
    }

    return view('menu');
}
}