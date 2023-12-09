<x-app-layout>
    <x-slot name="header">
        <x-header title="Listado de categorías"></x-header>
    </x-slot>

    <div>
        <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8">

            <div class="flex justify-end">
                <a href="{{ route('categorias.create') }}" class="bg-green-500 hover:bg-green-700 text-sm text-white py-2 px-4 rounded">Agregar Etiqueta</a>
            </div>

            <div class="flex flex-col ">

                <div class="mr-auto">
                    <form action="{{ route('categorias.index') }}" method="get" name="form1">
                        @csrf 
                        <div class="flex gap-3">
                            <div><x-input type="text" name="search" placeholder="Buscar" /></div>
                            <div><x-button type="submit" name="buscar" value="Buscar">Buscar</x-button></div>
                            
                        </div>
                    </form>
                </div>

                @include('alerts')

                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg mx-2 sm:mx-0">

                            <div class="flex max-w-7xl w-full bg-white content-between items-center">
                                <div class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">#</div>
                                <div class="text-sm flex-1"> Nombre </div>
                                <div class="text-sm text-left"> </div>
                            </div>
                            @foreach ($tags as $categoria)
                            <div class="flex max-w-7xl w-full bg-white content-between border items-center">
                                <div class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"> {{ $categoria->id }}</div>
                                <div class="text-sm text-left flex-1"> {{ $categoria->name }} </div>
                                <div class="text-sm text-left">
                                    <a href="{{ route('categorias.show', $categoria->id) }}" class="text-blue-600 hover:text-blue-900 mb-2 mr-2">Ver</a>
                                    <a href="{{ route('categorias.edit', $categoria->id) }}" class="text-indigo-600 hover:text-indigo-900 mb-2 mr-2">Editar</a>
                                    <form class="inline-block" action="{{ route('categorias.destroy', $categoria->id) }}" method="POST" onsubmit="return confirm('¿Está seguro?');">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="text-red-600 hover:text-red-900 mb-2 mr-2" value="Eliminar">
                                    </form>
                                </div>
                            </div>

                        @endforeach
                      
                            <div class="flex flex-col justify-center px-3 py-5">
                                {{ $tags->links() }}
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
