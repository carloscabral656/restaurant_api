<?php

namespace Database\Factories;

use App\Models\Menu;
use App\Models\Sale;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{  

    static $tipicalDish = array(
        'Arabic' => array('Hummus', 'Falafel', 'Tabbouleh', 'Shawarma', 'Baklava'),
        'Brazilian' => array('Feijoada', 'Pão de Queijo', 'Moqueca', 'Coxinha', 'Brigadeiro'),
        'Japanese' => array('Sushi', 'Tempura', 'Ramen', 'Okonomiyaki', 'Tonkatsu'),
        'Italian' => array('Pizza', 'Pasta Carbonara', 'Tiramisu', 'Lasanha', 'Risoto'),
        'Thai' => array('Pad Thai', 'Tom Yum Goong', 'Green Curry', 'Som Tum', 'Mango Sticky Rice'),
        'French' => array('Croissant', 'Coq au Vin', 'Ratatouille', 'Escargot', 'Crème Brûlée'),
        'German' => array('Bratwurst', 'Sauerkraut', 'Pretzel', 'Schnitzel', 'Black Forest Cake'),
        'British' => array('Fish and Chips', "Shepherd's Pie", 'Roast Beef', 'Full English Breakfast', 'Bangers and Mash'),
        'Chinese' => array('Peking Duck', 'Kung Pao Chicken', 'Dim Sum', 'Hot Pot', 'Mapo Tofu'),
        'Indian' => array('Curry', 'Tandoori Chicken', 'Samosa', 'Biryani', 'Butter Chicken'),
        'Korean' => array('Kimchi', 'Bibimbap', 'Korean BBQ', 'Tteokbokki', 'Japchae'),
        'Peruvian' => array('Ceviche', 'Lomo Saltado', 'Anticuchos', 'Aji de Gallina', 'Causa Rellena'),
        'Vegetarian' => array('Vegetable Curry', 'Quinoa Salad', 'Stuffed Bell Peppers', 'Eggplant Parmesan', 'Vegetarian Sushi Rolls')
    ); 

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {       
        $sales = Sale::all()->pluck('id');
        $unitPrice = rand(0, 100) / 3;

        return [
            "id_sale"      => $sales->random(),
            "description"  => '-',
            "unit_price"   => $unitPrice
        ];
    }

    public function dishForCustomMenu(int $idMenu)
    {
        return $this->state(function(array $attributes) use($idMenu) {
            $gastronomy = Menu::with(['restaurant'])->where('id', '=', $idMenu)->first()->restaurant->gastronomy->description;
            $foodsName = self::$tipicalDish[$gastronomy];
            $foodName = $this->faker->randomElement($foodsName);
            return [
                "id_type_item" => 1,
                'name' => $foodName,
                'img_item' => strtolower(str_replace(' ', '', $foodName) . '.jpg'),
                'id_menu' => $idMenu
            ];
        });
    }

    public function drinkForCustomMenu(int $idMenu)
    {
        $drinks = array(
            'Água com gás',
            'Refrigerante',
            'Suco natural',
            'Cerveja',
            'Vinho'
        );

        return $this->state(function(array $attributes) use($idMenu, $drinks) {
            $drink = array_shift($drinks);
            return [
                "id_type_item" => 2,
                'name' => $drink,
                'img_item' => mb_strtolower(str_replace(' ', '', $drink) . '.jpg'),
                'id_menu' => $idMenu
            ];
        });
    }
}
