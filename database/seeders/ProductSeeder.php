<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Tag;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Product::factory(250)->create();

        $products = Product::all();
        
        foreach($products as $product){

            //Obtengo los tags que son categorías
            $categorias = Tag::categories()->get();
            //Convierto a un arreglo
            $arrCategories = $categorias->pluck('id')->toArray();
            //Obtengo un valor aleatorio del arreglo de tags categorias
            $randomCategoryId = $arrCategories[array_rand($arrCategories)];
            //$tagsIDs = Tag::inRandomOrder()->limit($total)->pluck('id')->toArray();
            $product->tags()->attach($randomCategoryId);

            //Obtengo tags que son subcategorias que pertenecen a la anterior categoría generada
            $subcategorias = Tag::SubCategoriesByParentId($randomCategoryId)->get();
            $subcategorias = $subcategorias->pluck('id')->toArray();
            $idsSubcategoria = $subcategorias[array_rand($subcategorias)];

            $product->tags()->attach($idsSubcategoria);
        }
    }
}
