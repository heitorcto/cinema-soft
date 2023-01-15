<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use \Illuminate\Http\JsonResponse;
use App\Models\Administrador;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AdministradorController extends Controller
{
    /**
     * Método responsável por efetuar o registro do administrador.
     *
     * @param Request $request
     * @return JsonResponse
     */
    protected function registrar(Request $request): JsonResponse
    {
        $validar = Validator::make($request->all(), [
            'nome' => 'required|max:100|min:3|string',
            'email' => 'required|max:100|email:rfc,dns|string|unique:administradores,email',
            'senha' => 'required|max:20|min:5|string',
            'confirmar_senha' => 'required|max:20|min:3|same:senha|string',
            'nascimento' => 'required|date'
        ]);

        if ($validar->fails()) {
            return response()->json([
                'mensagem' => $validar->errors(),
            ], 406);
        }

        $administrador = new Administrador;
        $administrador->nome = Str::ucfirst($request->nome);
        $administrador->email = $request->email;
        $administrador->senha = Hash::make($request->senha);
        $administrador->nascimento = $request->nascimento;
        $administrador->criado_em = Carbon::now();
        $administrador->atualizado_em = null;
        $administrador->save();

        return response()->json([
            'mensagem' => 'Resgistrado com sucesso'
        ], 200);
    }

    /**
     * Método responsável por efetuar o login do administrador utilizando o Sanctum.
     *
     * @param Request $request
     * @return JsonResponse
     */
    protected function logar(Request $request): JsonResponse
    {
        $validar = Validator::make($request->all(), [
            'email' => 'required|max:100|email:rfc,dns|string',
            'senha' => 'required|max:20|min:5|string'
        ]);

        if ($validar->fails()) {
            return response()->json([
                'mensagem' => $validar->errors()
            ], 406);
        }

        $administrador = Administrador::where('email', '=', $request->email)->first();

        if (!$administrador && !Hash::check($request->senha, $administrador->senha)) {
            return response()->json([
                'mensagem' => 'Credenciais incorretas'
            ], 406);
        }

        $token = $administrador->createToken($administrador->nome)->plainTextToken;

        return response()->json([
            'mensagem' => 'Logado com sucesso',
            'token' => $token
        ], 200);
    }

    /**
     * Método responsável por efetuar a destruição do token da API e encerrar a sessão do administrador.
     *
     * @param Request $request
     * @return JsonResponse
     */
    protected function sair(Request $request): JsonResponse
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'mensagem' => 'Deslogado com sucesso'
        ], 200);
    }
}
