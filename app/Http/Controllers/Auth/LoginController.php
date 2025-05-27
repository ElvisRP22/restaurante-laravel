<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Repositories\IEmpleadosRepository;

class LoginController extends Controller
{
    protected $redirectTo = '/home';
    protected $empleadoRepository;

    public function __construct(IEmpleadosRepository $empleadoRepository)
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
        $this->empleadoRepository = $empleadoRepository;
    }

    public function login(Request $request)
    {
        $request->validate([
            'usuario' => 'required|string',
            'clave' => 'required|string',
        ]);

        $empleado = $this->empleadoRepository->findByUsername($request->input('usuario'));

        if ($empleado && Hash::check($request->input('clave'), $empleado->clave)) {
            Auth::login($empleado);
            return redirect()->intended($this->redirectTo);
        }

        return back()->withErrors([
            'usuario' => 'Credenciales inválidas',
        ]);
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
