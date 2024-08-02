<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EstudianteController extends Controller
{
    public function index()
    {
        $estudiante = Estudiante::all();

        if ($estudiante->isEmpty()) {
            $data = [
                'message' => 'No hay estudiantes registrados en este momento.',
                'status' => 200
            ];
            return response()->json($data, 200);
        }

        $data = [
            'estudiantes' => $estudiante,
            'status' => 200
        ];

        return response()->json($data, 200);
        //return 'Listando los estudiantes desde el controlador';
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'email' => 'required|email',
            'telefono' => 'required',
            'lenguaje_programacion' => 'required'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error validando los datos.',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $estudiante = Estudiante::create([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'telefono' => $request->telefono,
            'lenguaje_programacion' => $request->lenguaje_programacion
        ]);

        if (!$estudiante) {
            $data = [
                'message' => 'Error al momento de crear un estudiante.',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'message' => 'El estudiante fue registrado correctamente.',
            'status' => 201
        ];

        return response()->json($data, 201);
    }

    public function show($id)
    {
        $estudiante = Estudiante::find($id);

        if(!$estudiante){
            $data = [
                'message' => 'No se encontro el estudiante.',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'estudiante' => $estudiante,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    public function delete($id)
    {
        $estudiante = Estudiante::find($id);

        if (!$estudiante) {
            $data = [
                'message' => 'No se encontro el estudiante.',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $estudiante->delete();

        $data = [
            'message' => "El estudiante con id: {$estudiante->id}, fue eliminado.",
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    public function update(Request $request, $id)
    {
        $estudiante = Estudiante::find($id);

        if(!$estudiante){
            $data = [
                'message' => 'No se encontro el estudiante.',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'email' => 'required|email',
            'telefono' => 'required',
            'lenguaje_programacion' => 'required'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error validando los datos.',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $estudiante->nombre = $request->nombre;
        $estudiante->email = $request->email;
        $estudiante->telefono = $request->telefono;
        $estudiante->lenguaje_programacion = $request->lenguaje_programacion;

        $estudiante->save();

        $data = [
            'message' => "El estudiante fue actualizado.",
            'estudiante' => $estudiante,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    public function updatePartial(Request $request, $id)
    {
        $estudiante = Estudiante::find($id);

        if(!$estudiante){
            $data = [
                'message' => 'No se encontro el estudiante.',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'nombre' => '',
            'email' => 'email',
            'telefono' => '',
            'lenguaje_programacion' => ''
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error validando los datos.',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        if ($request->has('nombre')) {
            $estudiante->nombre = $request->nombre;
        }

        if ($request->has('email')) {
            $estudiante->email = $request->email;
        }

        if ($request->has('telefono')) {
            $estudiante->telefono = $request->telefono;
        }

        if ($request->has('lenguaje_programacion')) {
            $estudiante->lenguaje_programacion = $request->lenguaje_programacion;
        }

        $estudiante->save();

        $data = [
            'message' => "El estudiante fue actualizado.",
            'estudiante' => $estudiante,
            'status' => 200
        ];
        return response()->json($data, 200);
    }
}
