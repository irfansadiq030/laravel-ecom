<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GeneralSettings extends Controller
{
    public function index(){
        return view('admin.general-settings');
    }
}
