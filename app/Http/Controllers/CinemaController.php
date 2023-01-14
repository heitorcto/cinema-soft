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
            'estado' => 'required|string|min:3',
            'cidade' => 'required|string|min:3',
            'criado_em' => 'required|date'
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
