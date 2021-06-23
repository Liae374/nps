<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Affiche la page login.
     */
    public function index()
    {
        return view('login', [
            'logError' => ''
        ]);
    }  

    /**
     * Authentifie l'utilisateur, si réussi affiche la page admin, 
     * sinon redirige vers la page de login avec une erreur.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('admin')
                            ->withSuccess('Signed in');
        }
        return redirect('login')->withErrors(['login' => 'id ou mp incorrect']);
    }

    /**
     * Déconnecte l'utilisateur et affiche la vue de déconnexion.
     */
    public function logout() {
        Session::flush();
        Auth::logout();
        return view('logout');
    }

    /**
     * Affiche la vue d'enregistrement.
     */
    public function registration()
    {
        return view('registration');
    }

    /**
     * Enregistre l'utilisateur, et redirige vers la page admin.
     */
    public function registered(Request $request)
    {  
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
        $data = $request->all();
        $check = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
        return redirect('admin')->withSuccess('You have signed-in');
    }
}
