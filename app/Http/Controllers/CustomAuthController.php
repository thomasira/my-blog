<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class CustomAuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auth.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'min:3 | max:45',
            'email' => 'required | email | unique:users',
            'password' => 'min:6 | max: 20'
        ]);

        $user = new User;
        $user->fill($request->all());
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect(route('login'))->withSuccess('account created!');
    }

    public function authentification(Request $request) 
    {   
        $request->validate([
            'email' => 'email | required | exists:users',
            'password' => 'min:6 | max: 20 | alpha_dash'
        ]);

        $credentials = $request->only('email', 'password');
        if(!Auth::validate($credentials)) {
            return redirect(route('login'))->withErrors(trans('auth.password'))->withInput();
        }
        $user = Auth::getProvider()->retrieveByCredentials($credentials);
        Auth::login($user);
        return redirect()->intended(route('blog.index'));
    }

    public function logout() 
    {
        Auth::logout();
        return redirect(route('login'));
    }

    public function userList() 
    {
        $users = User::select()->paginate(5);
        return view('auth.user-list', compact('users'));
    }
}
