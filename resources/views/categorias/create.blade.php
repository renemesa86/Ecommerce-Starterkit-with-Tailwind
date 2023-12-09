<x-app-layout>
    <x-slot name="header">
        <x-header title="Crear categoría"></x-header>
    </x-slot>

    <div>
        <div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">

            <x-regresar></x-regresar>

            <div class="mt-5 md:mt-0 md:col-span-2">
                <form method="post" action="{{ route('categorias.store') }}">
                    @csrf
                    <div class="shadow overflow-hidden sm:rounded-md bg-white p-5">

                        <div class="px-4 py-2 bg-white sm:p-2">
                            <label for="name" class="block font-medium text-sm text-gray-700">Nombre</label>
                            <input type="text" name="name" id="name"
                                class="form-input rounded-md shadow-sm mt-1 block w-full"
                                value="{{ old('name', '') }}" />
                                @error('name')
                                @foreach ($errors->all() as $error)
                                    <p class="text-sm text-red-600">
                                        {{ $error }}
                                        {{-- {{ __('validation.required',['attribute' => __('Name')])}} --}}
                                    </p>
                                @endforeach
                                @enderror
                        </div>


                        <div class="flex items-center justify-end px-4 py-3  text-right sm:px-6">
                            <x-button class="mt-1 ml-3">Guardar</x-button>
                        </div>
                    </div>
                </form>
            </div>

            <x-regresar></x-regresar>

        </div>
    </div>
</x-app-layout>
