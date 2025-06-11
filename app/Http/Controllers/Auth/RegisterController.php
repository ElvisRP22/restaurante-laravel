<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Repositories\IEmpleadoRepository;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/home/empleados';
    protected $empleadoRepository;

    public function __construct(IEmpleadoRepository $empleadoRepository)
    {
        $this->middleware(['auth', 'admin']);
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
            'fecha_ingreso' => ['required', 'date', 'before_or_equal'],
        ]);
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $empleado = $this->create($request->all());

        // NO loguear al nuevo empleado
        // $this->guard()->login($empleado);
        return redirect()->route('home.empleados.index')->with('success', 'Empleado registrado correctamente');
    }

    protected function create(array $data)
    {
        //Agregar log
        Log::channel('empleados')->info('Registro de empleado', [
            'dni' => $data['dni'],
            'nombre' => $data['nombre'],
            'creado por' => auth()->user()->nombre,
        ]);
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
