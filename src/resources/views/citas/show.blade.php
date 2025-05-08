<x-app-layout>



    <div class="container mx-auto mt-2">
        <h1>Listado de Citas</h1>
        @if (session('success'))
            <div class="alert alert-success mx-auto">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger mx-auto">
                {{ session('error') }}
            </div>
        @endif
        <!-- solo el taller puede filtrar -->
        @if (auth()->user()->role === 'taller')


            <form method="GET" action="{{ route('citas.filtrar') }}">
                <label for="estado">Estado:</label>
                <select name="estado" id="estado" onchange="this.form.submit()">
                    <option value=""> Todas </option>
                    <option value="sincita" {{ request('estado') == 'sincita' ? 'selected' : '' }}>Sin cita</option>
                    <option value="concita" {{ request('estado') == 'concita' ? 'selected' : '' }}>Con cita</option>
                </select>
            </form>
        @endif
        <table class="table mt-2 ">
            <thead class="">
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Modelo</th>
                    <th>Matricula</th>
                    <th>fecha</th>
                    <th>Hora</th>
                    <th>duracion</th>
                    @if(auth()->user()->role === 'taller')
                        <th>Acciones</th>
                    @else
                        <th></th>
                    @endif
                </tr>
            </thead>
            <tbody>
              
                @if ($citas->isEmpty())
                    <tr>
                        <td class="text-center" colspan="8">No hay citas</td>
                    </tr>
                @else
                    @foreach ($citas as $cita)
                        <tr>
                            <td>{{ $cita->id }}</td>
                            <td>{{ $cita->user->name }}</td>
                            <td>{{ $cita->modelo }}</td>
                            <td>{{ $cita->matricula }}</td>


                            <td>{{ $cita->fecha }}</td>
                            <td>{{ $cita->hora }}</td>
                            <td>{{ $cita->duracion }}</td>

                            <td>
                                <!--  //ademas oculto la vista para el rol cliente en html-->
                                @if(auth()->user()->role === 'taller')
                                    <a href="{{ route('citas.modificar-cita', $cita->id) }}" class="btn btn-sm btn-outline-success"
                                        title="Editar">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>
                                    <form action="{{ route('citas.eliminar-cita', $cita->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('¿Estás seguro de que deseas eliminar esta cita?')"
                                            title="Eliminar">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>

        </table>
    </div>
</x-app-layout>