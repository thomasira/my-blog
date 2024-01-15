<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

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
            'password' => 'min:6 | max:20'
        ]);

        $user = new User;
        $user->fill($request->all());
        $user->password = Hash::make($request->password);
        $user->save();

        $to_name = $request->name;
        $to_email = $request->email;
        $body = "<a href='http://www.localhost:8000'>Cliquez pour modifier votre mot de passe</a>";

        Mail::send('email.mail', ['name' => $to_name, 'body' => $body], 
        function($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)->subject('login test');
        });

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

    public function forgotPassword() 
    {
        return view('auth.forgot-password');
    }

    public function tempPassword(Request $request) 
    {
        $request->validate([
            'email' => 'required | email | exists:users',
        ]);

        $user = User::where('email', $request->email)->first();
        $userId = $user->id;

        $tempPassword = Str::random(20);
        $user->temp_password = $tempPassword;
        $user->save();

        $to_name = $user->name;
        $to_email = $user->email;
        $body = "<a href='http://www.localhost:8000/new-password/$userId/$tempPassword'>Cliquez pour réinitialiser votre mot de passe</a>";

        Mail::send('email.mail', ['name' => $to_name, 'body' => $body], 
        function($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)->subject('login test');
        });

        return redirect(route('login'))->withSuccess('a message was sent to your account');
    }

    public function newPassword(User $user, $tempPassword) 
    {
        if($user->temp_password === $tempPassword) {
            return view('auth.new-password');
        } else return redirect('forgot-password')->withErrors(trans('auth.failed'));
    }

    public function storeNewPassword(User $user, $tempPassword, Request $request) {
        if($user->temp_password === $tempPassword) {
            $request->validate([
                'password' => 'min:6 | max:20 | confirmed'
            ]);
            $user->password = Hash::make($request->password);
            $user->temp_password = null;
            $user->save();
            return redirect(route('login'))->withSuccess('password changed!');
        } else return redirect('forgot-password')->withErrors(trans('auth.failed'));
    }
}
