<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.index')->with('users', User::all());
    }

    /**
     * Make a user admin --> when you are admin yourself.
     *
     * @return \Illuminate\Http\Response
     */
    public function makeAdmin(User $user)
    {
        $user->role = 'admin';
        $user->save();
        return redirect(route('users.index'))->with('success', "User ".$user->name." made as an admin");
    }


    /**
     * Make a user admin --> when you are admin yourself.
     *
     * @return \Illuminate\Http\Response
     */
    public function makeWriter(User $user)
    {
        $user->role = 'writer';
        $user->save();
        return redirect(route('users.index'))->with('warning', "User ".$user->name." made as an writer");
    }


}
