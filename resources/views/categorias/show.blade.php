<x-app-layout>
    <x-slot name="header">
        <x-header title="Show Categoría"></x-header>
    </x-slot>

    <div>
        <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8">
            
            <x-regresar></x-regresar>

            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="  overflow-hidden     sm:rounded-lg">
 
                           
                                            {{ $category->name }}




                        </div>
                    </div>
                </div>
            </div>
            <x-regresar></x-regresar>
        </div>
    </div>
</x-app-layout>
