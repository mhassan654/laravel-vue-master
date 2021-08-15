<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function controllerMethod()
    {

        return response()->json([
            'msg' => 'we should return jsom'
        ]);
    }

    public function test()
    {
        return response()->json([
            'msg' =>'some error'
        ], 422);
    }
}
