<x-app-layout>
    <x-slot name="header">
        <x-header title="Listado de Productos"></x-header>
    </x-slot>

    <div>
        <div class="max-w-6xl mx-auto py-6 px-6 lg:px-8">
            <div class="flex justify-end pb-3">
                <a href="{{ route('products.create') }}"
                    class="bg-green-500 hover:bg-green-700 text-white py-2 px-4 rounded text-sm">
                    Agregar Producto</a>
            </div>
            <div class="flex flex-col">

                <div class="w-full py-3">
                    <form action="{{ route('products.index') }}" method="get" name="form1" id="form1">
                        @csrf 
                        <div class="flex flex-col md:flex-row gap-3 w-full">
                            <div><x-input type="text" name="title" id="title" placeholder="Nombre del producto" value="{{ isset($_GET['title']) ? $_GET['title'] : '' }}"/></div>
                            <div><x-input type="text" name="item_code" id="item_code" placeholder="{{ __('Item Code') }}" value="{{ isset($_GET['item_code']) ? $_GET['item_code'] : '' }}" /></div>
                            <div><x-input type="number" name="min" id="min" placeholder="{{ __('Price')}} >= " value="{{ isset($_GET['min']) ? $_GET['min'] : '' }}" /></div>
                            <div><x-input type="number" name="max" id="max" placeholder="{{ __('Price')}} <= " value="{{ isset($_GET['min']) ? $_GET['max'] : '' }}"/></div>
                            <div class="flex items-center">
                                <x-button type="submit" class="bg-blue-400 mx-2" name="buscar" value="Buscar">Buscar</x-button>
                                <x-button type="reset" class="bg-slate-300 mx-2"> - </x-button>                                 
                            </div>                            
                        </div>
                         
                    </form>
                </div>
 
                @include('alerts')

                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg mx-2 sm:mx-0">

                            <div
                                class="encabezado sm:flex max-w-7xl w-full bg-white content-between 
                                items-center border-b hidden ">
                                <div class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 w-[1rem] ">#</div>
                                <div class="text-sm  w-[3rem]"> Logo </div>
                                <div class="text-sm flex-1 pl-3">Nombre</div>
                                <div class="text-sm flex-1 pl-3"> {{ __('Item code')}} </div>
                                <div class="text-sm flex-1 pl-3">Categoría</div>                                
                                <div class="text-sm flex-1 pl-3">Subcategorías</div>                                
                                <div class="text-sm flex-1 pl-3"> {{ __('Price')}} </div>                                
                                <div class="text-sm flex-1 pl-3"> {{ __('Active')}} </div>                                
                                <div class="text-sm flex-1 text-left"> </div>
                            </div>
                            @foreach ($products as $product)
                                <div
                                    class="content flex flex-col sm:flex-row max-w-7xl w-full bg-white content-between  
                            items-center border-b ">
                                    <div
                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 w-[1rem] hidden sm:flex">
                                        {{ $product->id }}
                                    </div>
                                    <div class="text-sm text-left w-[3rem] h-20 sm:h-auto flex items-center">
                                           

                                            <x-avatar 
                                            photopath="{{ $product->image }}" 
                                            id="{{ $product->id }}"
                                            title="{{ $product->title }}"
                                            w="w-12"
                                            h="h-12"
                                            route="#"
                                            > 
                                            </x-avatar>

                                    </div>
                                    <div class="text-sm flex-1 pl-3">
                                        {{ trim($product->title) }}                                          
                                    </div>                                    
                                    <div class="text-sm flex-1 pl-3 sm:flex"> {{ $product->item_code }} </div>
                                    <div class="text-sm flex-1 pl-3 sm:flex flex flex-col gap-2 py-2"> 
                                        @foreach($product->tags as $tag)
                                         @if($tag->parent_id == null)
                                         <span class="bg-slate-200 px-3 rounded-lg text-xs">{{ $tag->name }}</span> 
                                         @endif
                                        @endforeach
                                    </div>
                                    <div class="text-sm flex-1 pl-3 sm:flex flex flex-col gap-2 py-2"> 
                                        @foreach($product->tags as $tag)
                                         @if($tag->parent_id != null)
                                         <span class="bg-slate-200 px-3 rounded-lg text-xs">{{ $tag->name }}</span> 
                                         @endif
                                        @endforeach
                                    </div>
                                    <div class="text-sm flex-1 pl-3 sm:flex"> {{ $product->price }} </div>                                    
                                    <div class="text-sm flex-1 pl-3 sm:flex"> {{ $product->active == 1 ? 'Sí' : 'No' }} </div>                                    
                                     
                                    <div class="text-sm text-center flex-1 p-5 sm:p-0">
                                      
                                        <a href="{{ route('products.edit', $product->id) }}"
                                            class="text-indigo-600 hover:text-indigo-900 mb-2 mr-2">Editar</a>
                                        <form class="inline-block"
                                            action="{{ route('products.destroy', $product->id) }}" method="POST"
                                            onsubmit="return confirm('¿Está seguro?');">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="submit"
                                                class="text-red-600 hover:text-red-900 mb-2 mr-2"
                                                value="Eliminar">
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                 
                            <div class="flex flex-col justify-center px-3 py-5">
                                {{ $products->links() }}
                            </div>

                        </div>
                    </div>
                </div>
 

               
            </div>

        </div>
    </div>
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var formulario = document.getElementById('form1');
        var botonReset = formulario.querySelector('button[type="reset"]');

        botonReset.addEventListener('click', function () {
            var inputs = formulario.querySelectorAll('input');
            formulario.querySelector('#title').value = null;
            formulario.querySelector('#item_code').value = null;
            formulario.querySelector('#min').value = null;
            formulario.querySelector('#max').value = null;
            formulario.submit();                              
        });
    });
</script>