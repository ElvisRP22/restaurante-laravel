<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Repositories\IEmpleadosRepository;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/home';
    protected $empleadoRepository;

    public function __construct(IEmpleadosRepository $empleadoRepository)
    {
        $this->middleware('guest');
        $this->empleadoRepository = $empleadoRepository;
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'dni' => ['required', 'string', 'max:10', 'unique:empleados'],
            'nombre' => ['required', 'string', 'max:100'],
            'rol' => ['required', 'string', 'max:50'],
            'usuario' => ['required', 'string', 'max:50', 'unique:empleados'],
            'clave' => ['required', 'string', 'min:8', 'confirmed'],
            'fecha_ingreso' => ['required', 'date'],
        ]);
    }

    protected function create(array $data)
    {
        return $this->empleadoRepository->create([
            'dni' => $data['dni'],
            'nombre' => $data['nombre'],
            'usuario' => $data['usuario'],
            'clave' => Hash::make($data['clave']),
            'fecha_ingreso' => $data['fecha_ingreso'], // o `now()`
            'rol' => $data['rol'],
        ]);
    }
}
