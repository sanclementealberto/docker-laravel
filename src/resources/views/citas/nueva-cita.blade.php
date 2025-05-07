<x-app-layout>

<div class="container mx-auto mt-2">
    <h2>Nueva Cita</h2>

</div>

<div class="container mx-auto py-10">
    <div class="mx-auto ">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <divc class="p-6 text-gray-900">
                <form action="{{ route('citas.store') }}" method="POST">
                    @csrf
                        <div class="mb-4">
                            <label for="marca" class="block text-gray-700">{{ __('Marca') }}</label>
                            <input type="text" name="marca" id="marca" class="w-full border-gray-300 rounded-md shadow-sm @error('marca') border-red-500 @enderror" value="{{ old('marca') }}" required>
                            @error('marca')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="modelo" class="block text-gray-700">{{ __('modelo') }}</label>
                            <input type="text" name="modelo" id="modelo" class="w-full border-gray-300 rounded-md shadow-sm @error('modelo') border-red-500 @enderror" value="{{ old('modelo') }}" required>
                            @error('modelo')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="matricula" class="block text-gray-700">{{ __('matricula') }}</label>
                            <input type="text" name="matricula"   oninput="this.value = this.value.toUpperCase();" id="matricula" class="w-full border-gray-300 rounded-md shadow-sm @error('matricula') border-red-500 @enderror" required>
                            @error('matricula')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                     
                        <button type="submit" class="btn btn-outline-primary px-4 py-2 rounded-md">
                            {{ __('Guardar') }}
                        </button>


                </form>

            </div>

        </div>
    </div>

</div>
</x-app-layout>