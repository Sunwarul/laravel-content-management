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
        session()->flash("User ".$user->name." made as an admin");
        return redirect(route('users.index'));
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
        session()->flash("User ".$user->name." made as an writer");
        return redirect(route('users.index'));
    }


}
