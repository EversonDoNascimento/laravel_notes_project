<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function loginSubmit(Request $request){
        $request->validate(
        // Rules
        [
            'text_username' => 'required|email',
            'text_password' => 'required|min:4|max:16'
        ]
        // Messages
        ,
        [
            'text_username.required' => 'Username é obrigatório',
            'text_username.email' => 'Username deve ser um Email inválido',
            'text_password.required' => 'Senha é obrigatória',
            'text_password.min' => 'Senha deve ter no minimo :min caracteres',
            'text_password.max' => 'Senha deve ter no máximo :max caracteres'
        ]
        );
        $username = $request->input('text_username');
        $userpassword = $request->input('text_password');

        // Check if user exists
        $user = User::where('username', $username)->where('deleted_at', null)->first();
        if (!$user) {
            return redirect()
                   ->back()
                   ->withInput()
                   ->with('loginError', 'Username ou Senha inválidos');
        }

        // Check if password is correct
        if(!password_verify($userpassword, $user->password)){
            return redirect()
                   ->back()
                   ->withInput()
                   ->with('loginError', 'Username ou Senha inválidos');
        };

        // update last login
        $user->last_login = now();
        $user->save();

        // set session
        // session(
        //     [
        //         'id' => $user->id,
        //         'username' => $user->username
        //     ]
        // );
        \session()->put('user', [
            'id' => $user->id,
            'username' => $user->username
        ]);

        return redirect()->to('/');

        // get all the users from the database
        // $users = User::all()->toArray();
        // echo "<pre>";
        // print_r($users);

        // // Test database connection
        // try {
        //     DB::connection()->getPdo();
        //     echo 'ok!';
        // }
        // catch (\PDOException $e) {
        //     echo "Connection failed: " . $e->getMessage();
        // }
        // echo "fim!";
    }
    public function logout(){
        // Logout from the application
        session()->forget('user');
        return \redirect()->to('/login');
    }
}
