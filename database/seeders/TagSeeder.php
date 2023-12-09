<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $electronicos = Tag::create(['name'=>'Electrónicos']);

        $child = $electronicos->children()->create(['name'=>'Teléfonos y Accesorios']);
        $child = $electronicos->children()->create(['name'=>'Computadoras y Accesorios']);
        $child = $electronicos->children()->create(['name'=>'Dispositivos Wearables']);
        $child = $electronicos->children()->create(['name'=>'Cámaras y Fotografía']);
        $child = $electronicos->children()->create(['name'=>'Audio y Sonido']);     

        $moda = Tag::create(['name'=>'Moda']);

        $child = $moda->children()->create(['name'=>'Ropa para Hombres']);
        $child = $moda->children()->create(['name'=>'Ropa para Mujeres']);
        $child = $moda->children()->create(['name'=>'Calzado']);
        $child = $moda->children()->create(['name'=>'Accesorios']);
        $child = $moda->children()->create(['name'=>'Joyería y Relojes']); 
 
        $hogaryjardin = Tag::create(['name'=>'Hogar y Jardín']);

        $child = $hogaryjardin->children()->create(['name'=>'Muebles']);
        $child = $hogaryjardin->children()->create(['name'=>'Decoración del Hogar']);
        $child = $hogaryjardin->children()->create(['name'=>'Electrodomésticos']);
        $child = $hogaryjardin->children()->create(['name'=>'Jardinería y Exteriores']); 
  
        $salud = Tag::create(['name'=>'Salud y Belleza']);

        $child = $salud->children()->create(['name'=>'Cuidado Personal']);
        $child = $salud->children()->create(['name'=>'Maquillaje y Cosméticos']);
        $child = $salud->children()->create(['name'=>'Productos de Cuidado de la Piel']);
        $child = $salud->children()->create(['name'=>'Vitaminas y Suplementos']); 
 
        $deportes = Tag::create(['name'=>'Deportes y Aire Libre']);

        $child = $deportes->children()->create(['name'=>'Ropa Deportiva']);
        $child = $deportes->children()->create(['name'=>'Equipamiento para Deportes']);
        $child = $deportes->children()->create(['name'=>'Actividades al Aire Libre']);
        $child = $deportes->children()->create(['name'=>'Camping y Senderismo']); 
  
        $juguetes = Tag::create(['name'=>'Juguetes y Niños']);

        $child = $juguetes->children()->create(['name'=>'Juguetes']);
        $child = $juguetes->children()->create(['name'=>'Ropa para Niños']);
        $child = $juguetes->children()->create(['name'=>'Artículos para Bebés']);
        $child = $juguetes->children()->create(['name'=>'Material Escolar']); 
 
        $electro = Tag::create(['name'=>'Electrodomésticos']);

        $child = $electro->children()->create(['name'=>'Cocina y Utensilios']);
        $child = $electro->children()->create(['name'=>'Limpieza del Hogar']);
        $child = $electro->children()->create(['name'=>'Climatización']);
        $child = $electro->children()->create(['name'=>'Pequeños Electrodomésticos']); 

        $mascotas = Tag::create(['name'=>'Mascotas']);

        $child = $mascotas->children()->create(['name'=>'Alimentos para Mascotas']);
        $child = $mascotas->children()->create(['name'=>'Juguetes y Accesorios']);
        $child = $mascotas->children()->create(['name'=>'Cuidado y Salud Animal']);
 
        $automotriz = Tag::create(['name'=>'Automotriz']);

        $child = $automotriz->children()->create(['name'=>'Repuestos y Accesorios']);
        $child = $automotriz->children()->create(['name'=>'Herramientas y Equipamiento']);
        $child = $automotriz->children()->create(['name'=>'Electrónica para Automóviles']);
        $child = $automotriz->children()->create(['name'=>'Aceites y Fluidos']);
  

    }
}
