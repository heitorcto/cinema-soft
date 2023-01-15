<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Cinema;
use Carbon\Carbon;

class CinemaController extends Controller
{
    /**
     * Método responsável por registrar um cinema.
     *
     * @param Request $request
     * @return JsonResponse
     */
    protected function registrar(Request $request): JsonResponse
    {
        $validar = Validator::make($request->all(), [
            'estado' => 'required|string|min:3|max:100',
            'cidade' => 'required|string|min:3|max:100'
        ]);

        if ($validar->fails()) {
            return response()->json([
                'mensagem' => $validar->errors()
            ], 406);
        }

        $cinema = new Cinema();
        $cinema->estado = Str::ucfirst($request->estado);
        $cinema->cidade = Str::ucfirst($request->cidade);
        $cinema->criado_em = Carbon::now();
        $cinema->save();

        return response()->json([
            'mensagem' => 'Registrado com sucesso'
        ], 200);
    }

    /**
     * Método responsável por atualizar um cinema.
     *
     * @param Request $request
     * @return JsonResponse
     */
    protected function atualizar(Request $request): JsonResponse
    {
        $validar = Validator::make($request->all(), [
            'estado' => 'required|string|min:3|max:100',
            'cidade' => 'required|string|min:3|max:100'
        ]);

        if ($validar->fails()) {
            return response()->json([
                'mensagem' => $validar->errors()
            ], 406);
        }

        $cinema = Cinema::find($request->id);
        $cinema->estado = Str::ucfirst($request->estado);
        $cinema->cidade = Str::ucfirst($request->cidade);
        $cinema->save();

        return response()->json([
            'mensagem' => 'Atualizado com sucesso'
        ], 200);
    }

    /**
     * Método responsável por excluir um cinema.
     *
     * @param Request $request
     * @return JsonResponse
     */
    protected function excluir(Request $request): JsonResponse
    {
        $validar = Validator::make($request->all(), ['id' => 'integer']);

        if ($validar->fails()) {
            return response()->json([
                'mensagem' => $validar->errors()
            ], 406);
        }

        $cinema = Cinema::find($request->id);
        $cinema->delete();

        return response()->json([
            'mensagem' => 'Excluído com sucesso'
        ], 200);
    }

    /**
     * Método responsável por listar um cinema em epecífico ou listor todos retornando a paginação.
     *
     * @param Request $request
     * @return JsonResponse
     */
    protected function listar(Request $request): JsonResponse
    {
        if ($request->id) {
            $validar = Validator::make($request->all(), ['id' => 'integer']);

            if ($validar->fails()) {
                return response()->json([
                    'mensagem' => $validar->errors()
                ], 406);
            }

            $cinema = Cinema::find($request->id);

            return response()->json([
                'mensagem' => $cinema
            ], 200);
        }

        $cinemas = Cinema::paginate(5);

        return response()->json([
            'mensagem' => $cinemas
        ], 200);
    }
}
