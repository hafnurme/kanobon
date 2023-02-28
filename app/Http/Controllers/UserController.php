<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Token;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;





class UserController extends Controller
{
    /**
     * Display a Login of the form.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $usr = null;
        $err = null;
        $pass = null;
        if ($request->session()->has(['err', 'username', 'password'])) {
            $usr = $request->session()->get('username');
            $err = $request->session()->get('err');
            $pass = $request->session()->get('password');
        }
        return response(view('login', ['title' => 'Login', 'err' => $err, 'username' => $usr, 'password' => $pass]));
    }
    /**
     * Authenticate an user.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function auth(Request $request)
    {
        //$user = User::where('username', $request->username)->first();
        if (User::all()->count() == 0 && Profile::all()->count() == 0) {
            $loginCompany  = Http::asForm()->post(env('API_URL') . 'login', ['username' => $request->username, 'password' => $request->password]);
            if ($loginCompany->ok()) {
                $data = $loginCompany->object();
                $token = $data->token;
                if ($data->pos != 'branch') {
                    return redirect()->route('login')->with(['title' => 'Logined', 'err' => 'Username Not Found', 'username' => $request->username, 'password' => $request->password]);
                }
                $branchData = Http::withToken($token)->get(env('API_URL') . 'branch')->object();
                $userData = Http::withToken($token)->get(env('API_URL') . 'user')->object();
                
                $profil = Profile::create([
                    'branch_id' => $branchData->branch_id,
                    'name' => $branchData->branch_name,
                    'leader_name' => $branchData->leader_name,
                    'contact' => $branchData->contact,
                    'email' => $userData->email,
                    'adress' => $branchData->address
                ]);
       $role = DB::table('roles')->where('name', 'admin')->first();
                $admin = User::create([
                    'user_id' => Str::uuid()->toString(),
                    'username' => $userData->username,
                    'name' => $userData->name,
                    'contact' => $userData->contact,
                    'email' => $userData->email,
                    'password' => Hash::make($request->password),
                    'role_id'=> $role->role_id,
                ]);
                if ($profil && $admin) {
                    $user = User::where('username', $request->username)->first();
                    if($request->remember){
                        $rm = true;
                    }else{$rm=false;}
                    Auth::login($user, $rm);
                    return redirect()->route('dashboard')->with(['title' => 'Dashboard', 'err' => $profil && $admin, 'username' => $request->username, 'password' => $request->password]);
                }
                abort(500);
                return redirect()->route('login')->with(['title' => 'Logined', 'err' => $userData, 'username' => $request->username, 'password' => $request->password]);
            }
            if ($loginCompany->serverError()) {
                $data = 'Server err';
                return redirect()->route('login')->with(['title' => 'Logined', 'err' => $data, 'username' => $request->username, 'password' => $request->password]);
            }
            if ($loginCompany->unauthorized()) {
                $data = $loginCompany->object()->message;
                return redirect()->route('login')->with(['title' => 'Logined', 'err' => $data, 'username' => $request->username, 'password' => $request->password]);
            }
        } elseif (Profile::all()->count() == 1) {
            $user = User::where('username', $request->username)->first();
            //if (!$user) {
            //    return redirect()->route('login')->with(['title' => 'Logined', 'err' => 'Username not found', 'username' => $request->username, 'password' => $request->password]);
            //}
            //if (!Hash::check($request->password, $user->password)) {
            //    return redirect()->route('login')->with(['title' => 'Logined', 'err' => 'wrong password', 'username' => $request->username, 'password' => $request->password]);
            //}
            if ($request->remember) {
                $rm = true;
            } else {
                $rm = false;
            }
            //Auth::login($user, $rm);
            $credentials = $request->validate([
                'username' => ['required'],
                'password' => ['required'],
            ]);

            if (Auth::attempt($credentials, $rm)) {
                $request->session()->regenerate();
                if ($user->role == 'admin') {
                    $loginCompany  = Http::asForm()->post(env('API_URL') . 'login', ['username' => $request->username, 'password' => $request->password]);
                    $data = $loginCompany->object();
                  $ftoken = Hash::make(bin2hex(random_bytes(50)) . $request->username);
                    Token::updateOrCreate(['user_id' => $user->user_id], ['token' => str_replace("\\", random_bytes(1), $ftoken)]);
                    session(['token' => $data->token]);
                }
                return redirect()->intended('dashboard');
            }

            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }
        $loginCompany  = Http::asForm()->post(env('API_URL') . 'login', ['username' => $request->username, 'password' => $request->password]);
        if ($loginCompany->ok()) {
            $response = $loginCompany->collect();
        }
        if ($loginCompany->serverError()) {
            $response = 'Server err';
        }
        if ($loginCompany->unauthorized()) {
            $response = $loginCompany->object()->message;
        }
        return redirect()->route('login')->with(['title' => 'Logined', 'err' => $response, 'username' => $request->username, 'password' => $request->password]);
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
