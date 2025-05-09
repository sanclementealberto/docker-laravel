<x-app-layout>



    <div class="container mx-auto mt-2">
        <h1 class="alert alert-info w-15">Listado de Citas</h1>
        @if (session('success'))
        <div class="alert alert-success mx-auto  ">
            {{ session('success') }}
        </div>
        @endif

        @if (session('error'))
        <div class="alert alert-danger  ">
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
        <table class="table table-bordered  table-hover mt-2 ">
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
                    @endif

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

                    @if(auth()->user()->role === 'taller')
                    <td>
                        <a href="{{ route('citas.modificar-cita', $cita->id) }}" class="btn btn-sm btn-outline-success"
                            title="Editar">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <button type="button" class="btn btn-sm btn-outline-danger"
                            data-bs-toggle="modal" data-bs-target="#modalEliminarCita{{ $cita->id }}"
                            title="Eliminar">
                            <i class="bi bi-trash3"></i>
                        </button>

                        <!-- modal eliminar -->
                        <div class="modal fade" id="modalEliminarCita{{ $cita->id }}" tabindex="-1" aria-labelledby="modalEliminarLabel{{ $cita->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content border-danger">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-danger" id="modalEliminarLabel{{ $cita->id }}">Confirmar eliminación</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                    </div>
                                    <div class="modal-body">
                                        ¿Estas seguro de que quieres eliminar la cita ?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>

                                        
                                        <form action="{{ route('citas.eliminar-cita', $cita->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Eliminar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    @endif
                </tr>
                @endforeach
                @endif
            </tbody>

        </table>
    </div>
</x-app-layout>