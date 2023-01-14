<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cinema;
use Illuminate\Support\Facades\Validator;

class CinemaController extends Controller
{
    protected function registrar(Request $request)
    {
        $validar = Validator::make($request->all(), [
            'nome' => 'string|min:3'
        ]);

        if ($validar->fails()) {
            return response()->json([
                'msg' => $validar->errors()
            ], 406);
        }

        return response()->json([
            'msg' => 'opa'
        ], 200);
    }
}
