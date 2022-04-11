<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Models\UserDetail;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function index(User $model)
    {
        return view('users.index');
    }

    public function view()
    {
        // dd($userDetails);
        // auth()->user()->assignRole('User');
        $users = User::all();

        // dd($users[1]->userDetail->phone_no);

        return view('pages.user_management', compact('users'));
    }
}
