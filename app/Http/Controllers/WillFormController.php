<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WillFormController extends Controller
{
    public function show()
    {
        return view('dashboard.willform.create');
    }
}
