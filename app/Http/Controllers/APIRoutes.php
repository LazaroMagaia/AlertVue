<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class APIRoutes extends Controller
{
    public function edit($id)
    {
       return view("admin.alert.edit",["id"=>$id]);
    }
}
