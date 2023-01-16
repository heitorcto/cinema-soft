<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Sala;

class SalaController extends Controller
{
    /**
     * Método responsável por registrar uma sala.
     *
     * @param Request $request
     * @return JsonResponse
     */
    protected function registrar(Request $request): JsonResponse
    {
        $validar = Validator::make($request->all(), [
            'sala' => 'integer|min:1|max:100|required',
            'cinema_id' => 'integer|required'
        ]);

        if ($validar->fails()) {
            return response()->json([
                'mensagem' => $validar->errors()
            ], 406);
        }

        $sala = new Sala;
        $sala->sala = Str::ucfirst($request->sala);
        $sala->cinema_id = $request->cinema_id;
        $sala->save();

        return response()->json([
            'mensagem' => "Sucesso ao registrar"
        ], 200);
    }

    /**
     * Método responsável por atualizar uma sala.
     *
     * @param Request $request
     * @return JsonResponse
     */
    protected function atualizar(Request $request): JsonResponse
    {
        $validar = Validator::make($request->all(), [
            'id' => 'required|integer',
            'sala' => 'integer',
            'cinema_id' => 'integer'
        ]);

        if ($validar->fails()) {
            return response()->json([
                'mensagem' => $validar->errors()
            ], 406);
        }

        $sala = Sala::find($request->id);
        $sala->sala = $request->sala;
        $sala->cinema_id = $request->cinema_id;
        $sala->save();

        return response()->json([
            'mensagem' => 'Sala atualizada com sucesso'
        ], 200);
    }

    /**
     * Método responsável por excluir uma sala.
     *
     * @param Request $request
     * @return JsonResponse
     */
    protected function excluir(Request $request): JsonResponse
    {
        $validar = Validator::make($request->all(), [
            'id' => 'required|integer'
        ]);

        if ($validar->fails()) {
            return response()->json([
                'mensagem' => $validar->errors()
            ], 406);
        }

        $sala = Sala::find($request->id);
        $sala->delete();

        return response()->json([
            'mensagem' => 'Excluído com sucesso'
        ], 200);
    }

    /**
     * Método responsável por listar uma ou mais salas retornando uma paginação.
     *
     * @param Request $request
     * @return JsonResponse
     */
    protected function listar(Request $request): JsonResponse
    {
        if ($request->id) {
            $validar = Validator::make($request->all(), [
                'id' => 'integer|required'
            ]);

            if ($validar->fails()) {
                return response()->json([
                    'mensagem' => $validar->errors()
                ], 406);
            }

            $sala = Sala::find($request->id);

            return response()->json([
                'mensagem' => $sala
            ], 200);
        }

        if ($request->cinema_id) {
            $salas = Sala::where('cinema_id', '=', $request->cinema_id)->paginate(5);

            return response()->json([
                'mensagem' => $salas
            ], 200);
        }
    }
}
