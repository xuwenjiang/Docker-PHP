<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class UserController extends Controller
{
    public function getUsers(Request $request, $id = null)
    {
        $condition = $id? " WHERE id=$id" : null;
        $sql = "SELECT * FROM users". $condition;
        $queryResult = DB::select($sql);
        $response = [];
        foreach ($queryResult as $_user) {
            $response[] = [
                'id' => $_user->id,
                'email' => $_user->email,
                'name' => $_user->name
            ];
        }

        return response()->json($response, 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function postUser(Request $request)
    {
        $email = $request->input('email');
        $name = $request->input('name');
        $insertSql = "INSERT INTO users (email, name) values ('$email', '$name')";

        try {
            DB::insert($insertSql);
            $responseCode = 201;
        } catch (QueryException $e) {
            $responseCode = 409;
        }

        $selectSql = "SELECT * FROM users WHERE email = '$email'";
        $queryResult = DB::select($selectSql);
        $response = [];
        foreach ($queryResult as $_user) {
            $response[] = [
                'id' => $_user->id,
                'email' => $_user->email,
                'name' => $_user->name
            ];
        }
        $id = $response[0]['id'];
        $location = $request->url().'/'.$id;
        return response()->json($response, $responseCode, ['Location' => $location], JSON_UNESCAPED_UNICODE);
    }
}
