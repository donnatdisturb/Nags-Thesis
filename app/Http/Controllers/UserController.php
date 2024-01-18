<?php

namespace App\Http\Controllers;

use App\Models\User;
use DB;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);

        // $users = DB::table('users')
        //     ->join('students', 'students.id', '=', 'users.id')
        //     ->join('guidances', 'guidances.id', '=', 'users.id')
        //     ->orderBy('users.id', 'DESC')
        //     ->paginate(10);

        return view('users.index', compact('users'));
    }
}
