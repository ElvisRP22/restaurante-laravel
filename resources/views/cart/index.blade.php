<ul>
    @foreach(session('carrito') as $id => $details)>
        <li>{{ $details['nombre'] }} - {{ $details['cantidad'] }}</li>
    @endforeach
</ul>