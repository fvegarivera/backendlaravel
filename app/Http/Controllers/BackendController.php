<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;

class BackendController extends Controller
{
    private $names = [
        1 => ['name' => 'Kpita', 'age' => 14],
        2 => ['name' => 'Knita', 'age' => 15],
        3 => ['name' => 'Gellercito', 'age' => 13],
        4 => ['name' => 'Jingita', 'age' => 8],
    ];

    public function getAll() {
        return response()->json($this->names);
    }

    public function get(int $id = 0) {
        if (isset($this->names[$id])) {
            return response()->json($this->names[$id]);
        }   

        return response()->json(['error' => 'Name not found'], Response::HTTP_NOT_FOUND);
    }

    public function create(Request $request) {
        $person = [
            "id" => count($this->names) + 1,
            "name" => $request->input("name"),
            "age" => $request->input("age"),
        ];

        $this->names[$person["id"]] = $person;

        return response()->json(["message" => "Persona creada", "person" => $person], Response::HTTP_CREATED);
    }
}
