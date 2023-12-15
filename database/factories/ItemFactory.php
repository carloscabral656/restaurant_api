<?php

namespace Database\Factories;

use App\Models\Menu;
use App\Models\Sale;
use App\Models\TypeItem;
use Database\Seeders\MenuSeeder;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $menus = Menu::all()->pluck('id');
        $typeItem = TypeItem::all()->pluck('id');
        $sales = Sale::all()->pluck('id');
        $unitPrice = rand(0, 100) / 3;

        return [
            "id_menu"      => $menus->random(),
            "id_type_item" => $typeItem->random(),
            "id_sale"      => $sales->random(),
            "name"         => $this->faker->name(),
            "description"  => 'asdasdasdasdasdasda',
            "img_item"     => 'asdasdadasdasdasd',
            "unit_price"   => $unitPrice
        ];
    }

    public function withCustomMenu(int $idMenu)
    {
        return $this->state(function(array $attributes) use($idMenu) {
            return [
                'id_menu' => $idMenu
            ];
        });
    }
}
