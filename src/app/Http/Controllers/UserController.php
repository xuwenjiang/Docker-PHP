<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function getUsers(Request $request)
    {
        $queryResult = DB::select('select * from users');
        $response = [];
        foreach ($queryResult as $_user) {
            $response[] = [
                'id' => $_user->id,
                'email' => $_user->email,
                'name' => $_user->name
            ];
        }

        return response()->json($response);
    }
}
