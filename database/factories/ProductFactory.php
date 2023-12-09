<?php

namespace Database\Factories;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        
        $name = fake()->name;
        $_name = strtolower($name);
        $_name = str_replace('.','',$_name);
        $_name = str_replace(' ','-',$_name);
        $slug = strtolower($_name);

        $images = ['images/products/product-01.png','images/products/product-02.png','images/products/product-03.png'] ;
        $index = array_rand($images);
        $imagen_url = $images[$index];

        return [
            'title' => $name,
            'slug'  => $slug,
            'item_code' => 'IC-1000'.rand(10,100),
            'price' => mt_rand(5,1000),
            'description' => fake()->sentence(5),
            'image' => $imagen_url,
            //'tags' => Tag::inRandomOrder()->limit(4)->pluck('id')->toArray()
        ];
    }
}
