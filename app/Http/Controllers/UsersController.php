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

    /**
     * Show the users profile page
     *
     * @return void
     */
    public function profile()
    {
        return view('users.profile')->with('user', auth()->user());
    }

    /**
     * Edit user profile
     *
     * @return void
     */
    public function profileEdit()
    {
        return view('users.edit')->with('user', auth()->user());
    }

    public function profileUpdate(Request $request)
    {
        $user = auth()->user();
        $user->update([
            'name' => $request->name,
            'about' => $request->about
        ]);

        session()->flash('success', 'User setting updated');
        return redirect()->back();

    }
}
