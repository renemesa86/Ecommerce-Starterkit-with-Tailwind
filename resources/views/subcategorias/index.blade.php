<x-app-layout>
    <x-slot name="header">
        <x-header title="Listado de subcategorías"></x-header>
    </x-slot>

    <div>
        <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8">

            <div class="flex justify-end">
                <a href="{{ route('subcategorias.create') }}" class="bg-green-500 hover:bg-green-700 text-sm text-white py-2 px-4 rounded">Agregar Etiqueta</a>
            </div>

            <div class="flex flex-col ">

                <div class="mr-auto">
                    <form action="{{ route('subcategorias.index') }}" method="get" name="form1">
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
                                <div class="pr-10 pl-4 py-4 whitespace-nowrap text-sm text-gray-900 w-10">#</div>
                                <div class="text-sm flex-1">Nombre</div>
                                <div class="text-sm flex-1">Categoría</div>
                                <div class="text-sm text-right flex-1 px-3"> </div>
                            </div>
                            @foreach ($subcategories as $category)
                            <div class="flex max-w-7xl w-full bg-white content-between border items-center">
                                <div class="pr-10 pl-4 py-4 whitespace-nowrap text-sm text-gray-900 w-10"> {{ $category->id }}</div>
                                <div class="text-sm text-left flex-1">{{ $category->name }}</div>
                                <div class="text-sm text-left flex-1">{{ $category->parents->name }}</div>
                                <div class="text-sm text-right flex-1 px-3">
                                    <a href="{{ route('subcategorias.show', $category->id) }}" class="text-blue-600 hover:text-blue-900 mb-2 mr-2">Ver</a>
                                    <a href="{{ route('subcategorias.edit', $category->id) }}" class="text-indigo-600 hover:text-indigo-900 mb-2 mr-2">Editar</a>
                                    <form class="inline-block" action="{{ route('subcategorias.destroy', $category->id) }}" method="POST" onsubmit="return confirm('¿Está seguro?');">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="text-red-600 hover:text-red-900 mb-2 mr-2" value="Eliminar">
                                    </form>
                                </div>
                            </div>

                        @endforeach
                      
                            <div class="flex flex-col justify-center px-3 py-5">
                                {{ $subcategories->links() }}
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
