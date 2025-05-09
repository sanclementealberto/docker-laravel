<x-app-layout>

    

    <div class="container mx-auto py-10 ">
    <h1 class="alert alert-info w-15">Listado de Citas</h1>
        <div class="mx-auto">
            <div class=" bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('citas.update', $cita) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <!--- fecha hora y duracion -->
                        <label for="fecha" class="block text-gray-700">{{ __('Fecha') }}</label>
                        <input type="date" name="fecha" id="fecha" class="w-full border-gray-300 rounded-md shadow-sm
                        value={{ old('fecha', $cita->fecha) }}" required>
                        @error('fecha')
                        <p class="alert alert-danger text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="hora" class="block text-gray-700">{{ __('Hora') }}</label>
                        <input type="time" name="hora" id="hora" class="w-full border-gray-300 rounded-md shadow-sm
                        value={{ old('hora', $cita->hora) }}" required>
                        @error('hora')
                        <p class="alert alert-danger text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="Duracion" class="block text-gray-700">{{ __('Duracion') }}</label>
                        <input type="time" name="duracion" id="duracion" class="w-full border-gray-300 rounded-md shadow-sm
                        value={{ old('hora', $cita->duracion) }}" required>
                        @error('duracion')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary px-4 py-2 rounded-md">
                        {{ __('Actualizar') }}
                    </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>