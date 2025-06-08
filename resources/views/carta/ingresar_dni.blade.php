<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ingresar DNI</title>
</head>
<body>
    <h2>Bienvenido a la Mesa {{ $mesa }}</h2>

    //method Post para enviar los datos y lo pueda jalar con Request
    <form method="POST" action="{{ route('cliente.iniciar', ['mesa' => $mesa]) }}">
        @csrf
        <label for="dni">DNI:</label>
        <input type="text" name="dni" maxlength="8" required>

        <button type="submit">Entrar</button>
    </form>

    @if ($errors->any())
        <p style="color:red;">{{ $errors->first() }}</p>
    @endif
</body>
</html>
