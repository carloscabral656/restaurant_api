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

    static $tipicalDishDescription = array(
        'Arabic' => array(
            'Hummus' => 'Pasta cremosa feita com grão-de-bico, tahine, limão e alho.',
            'Falafel' => 'Bolinhos ou hambúrgueres fritos feitos de grão-de-bico ou fava, frequentemente servidos no pão sírio.',
            'Tabbouleh' => 'Salada refrescante feita com salsa, tomate, hortelã, cebola e trigo para quibe.',
            'Shawarma' => 'Carne grelhada fatiada (geralmente cordeiro, frango ou carne bovina) servida em pão sírio.',
            'Baklava' => 'Doce feito com camadas de massa filo recheadas com nozes e adoçadas com xarope ou mel.'
        ),
        'Brazilian' => array(
            'Feijoada' => 'Ensopado rico feito com feijão-preto e vários cortes de carne de porco.',
            'Pão de Queijo' => 'Bolinhos de queijo feitos com polvilho e queijo.',
            'Moqueca' => 'Ensopado saboroso de frutos do mar feito com peixe, camarão, leite de coco e azeite de dendê.',
            'Coxinha' => 'Coxinhas de frango fritas com uma massa macia.',
            'Brigadeiro' => 'Bombons de chocolate feitos com leite condensado, cacau, manteiga e granulado.'
        ),
        'Japanese' => array(
            'Sushi' => 'Arroz temperado com peixe cru, legumes ou ovo.',
            'Tempura' => 'Frutos do mar ou vegetais levemente empanados e fritos.',
            'Ramen' => 'Sopa de macarrão com caldo, carne e vários acompanhamentos.',
            'Okonomiyaki' => 'Panqueca salgada com repolho, carne e outros ingredientes por cima.',
            'Tonkatsu' => 'Costeleta de porco empanada e frita.'
        ),
        'Italian' => array(
            'Pizza' => 'Massa plana com molho de tomate, queijo e diversos ingredientes.',
            'Pasta Carbonara' => 'Massa com ovos, queijo, pancetta e pimenta-do-reino.',
            'Tiramisu' => 'Sobremesa com camadas de biscoitos embebidos em café e creme de queijo mascarpone.',
            'Lasanha' => 'Camadas de massa, carne, molho e queijo.',
            'Risoto' => 'Prato de arroz cremoso cozido com caldo e ingredientes como cogumelos ou frutos do mar.'
        ),
        'French' => array(
            'Croissant' => 'Um pão de massa folhada, em formato de meia lua, crocante por fora e macio por dentro, geralmente servido no café da manhã ou lanche.',
            'Coq au Vin' => 'Um prato de frango cozido lentamente em vinho tinto, frequentemente acompanhado de cogumelos, bacon e temperos aromáticos.',
            'Ratatouille' => 'Um prato de legumes cozidos, incluindo berinjela, abobrinha, pimentão, tomate e temperos provençais, muitas vezes servido como acompanhamento ou como prato principal.',
            'Escargot' => 'Caracóis preparados com manteiga, alho e ervas, assados no forno em suas conchas, é uma iguaria tradicional na culinária francesa.',
            'Crème Brûlée' => 'Uma sobremesa de creme de baunilha com uma camada de açúcar caramelizado por cima, formando uma crosta crocante.'
        ),
        'German' => array(
            'Bratwurst' => 'Uma salsicha alemã feita de carne suína temperada e geralmente grelhada ou frita.',
            'Sauerkraut' => 'Repolho fermentado, é um acompanhamento popular na culinária alemã, conhecido por seu sabor azedo.',
            'Pretzel' => 'Um pão torcido cozido, muitas vezes servido salgado e crocante por fora.',
            'Schnitzel' => 'Uma fina fatia de carne, geralmente porco, empanada e frita.',
            'Black Forest Cake' => 'Bolo de chocolate com camadas de chantilly e cerejas, muitas vezes embebido em kirsch (licor de cereja) e decorado com raspas de chocolate.'
        ),
        'Thai' => array(
            'Pad Thai' => 'Um prato de macarrão de arroz frito com tofu, camarão ou frango, geralmente servido com amendoim moído, limão e vegetais.',
            'Tom Yum Goong' => 'Uma sopa picante de camarão com ervas como capim-limão, galanga e folhas de limão kaffir.',
            'Green Curry' => 'Um curry tailandês feito com leite de coco, pasta de curry verde, vegetais e carne.',
            'Som Tum' => 'Salada de papaia verde picante com tomate, feijão-de-vagem, amendoim, alho, chilli, e suco de limão ou tamarindo.',
            'Mango Sticky Rice' => 'Sobremesa feita de arroz glutinoso cozido no vapor, servido com manga fresca e regado com leite de coco adoçado.'
        ),
        'British' => array(
            'Fish and Chips' => 'Um prato de peixe empanado e frito servido com batatas fritas, geralmente acompanhado de molho tártaro.',
            "Shepherd's Pie" => 'Um prato cozido de carne moída com legumes, coberto com purê de batatas e gratinado no forno.',
            'Roast Beef' => 'Carne de vaca assada lentamente no forno, muitas vezes servida com legumes e molho.',
            'Full English Breakfast' => 'Um café da manhã completo com ovos, bacon, salsichas, feijão, cogumelos, tomate grelhado e torradas.',
            'Bangers and Mash' => 'Salsichas grelhadas servidas com purê de batatas e molho de cebola.'
        ),
        'Chinese' => array(
            'Peking Duck' => 'Uma especialidade chinesa de pato assado, tradicionalmente servido com panquecas finas, cebolinha, pepino e molho hoisin.',
            'Kung Pao Chicken' => 'Um prato picante de frango frito com amendoins, pimentas, e vegetais.',
            'Dim Sum' => 'Uma variedade de pequenos pratos, incluindo dumplings, rolinhos primavera, bolinhos de massa e outros aperitivos.',
            'Hot Pot' => 'Um método de cozinhar onde ingredientes crus são cozidos em um caldo fervente na mesa, semelhante ao fondue.',
            'Mapo Tofu' => 'Um prato picante de tofu cozido com molho de pimenta, carne moída e vegetais.'
        ),
        'Indian' => array(
            'Curry' => 'Um prato preparado com uma variedade de especiarias e temperos, podendo conter legumes, carne, peixe ou frango.',
            'Tandoori Chicken' => 'Frango temperado com iogurte e especiarias, assado em forno de barro tradicionalmente conhecido como "tandoor".',
            'Samosa' => 'Pastéis fritos ou assados, recheados com batatas, ervilhas, especiarias e, por vezes, carne ou lentilhas.',
            'Biryani' => 'Um prato de arroz aromático cozido com especiarias, ervas e carne ou vegetais.',
            'Butter Chicken' => 'Frango marinado em um molho de tomate cremoso e temperado, geralmente servido com naan ou arroz.'
        ),
        'Korean' => array(
            'Kimchi' => 'Repolho fermentado com especiarias como pimenta, alho e gengibre, é um prato tradicional na culinária coreana.',
            'Bibimbap' => 'Um prato de arroz coberto com legumes, carne, ovo frito e molho de pimenta gochujang.',
            'Korean BBQ' => 'Um método de churrasco coreano onde a carne, geralmente de porco ou boi, é grelhada à mesa.',
            'Tteokbokki' => 'Bolinhos de arroz cozidos em um molho picante de gochujang, um prato popular de rua na Coreia.',
            'Japchae' => 'Macarrão coreano de batata-doce frito com legumes e carne, geralmente servido como prato principal ou acompanhamento.'
        ),
        'Peruvian' => array(
            'Ceviche' => 'Prato de peixe cru marinado em suco de limão ou lima, com cebola, pimenta e coentro.',
            'Lomo Saltado' => 'Prato de carne (geralmente bife) salteada com cebola, tomate, pimentões e temperos, frequentemente servido com batatas fritas e arroz.',
            'Anticuchos' => 'Espetinhos de carne de boi ou coração de frango marinados e grelhados, muitas vezes servidos com batatas e molho.',
            'Aji de Gallina' => 'Prato feito com frango desfiado em um molho cremoso de pimenta amarela, leite, pão e nozes, servido com arroz e batatas cozidas.',
            'Causa Rellena' => 'Um prato frio feito de purê de batata temperado com limão e pimenta, recheado com atum, frango ou outro recheio, muitas vezes acompanhado de abacate e ovo.'
        ),
        'Vegetarian' => array(
            'Vegetable Curry' => 'Um prato de curry feito com uma variedade de legumes, cozidos em um molho de especiarias.',
            'Quinoa Salad' => 'Salada feita com quinoa, geralmente combinada com legumes frescos, ervas e um molho leve.',
            'Stuffed Bell Peppers' => 'Pimentões recheados com uma mistura de arroz, legumes e temperos, assados até ficarem macios.',
            'Eggplant Parmesan' => 'Fatias de berinjela empanadas, fritas e assadas com molho de tomate e queijo.',
            'Vegetarian Sushi Rolls' => 'Rolinhos de sushi recheados com legumes, como pepino, abacate, cenoura e outros ingredientes vegetarianos.'
        ),
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
            'description' => '-',
            "unit_price"   => $unitPrice
        ];
    }

    public function dishForCustomMenu(int $idMenu)
    {
        return $this->state(function(array $attributes) use($idMenu) {

            // Take Gastronomy
            $gastronomy = Menu::with(['restaurant'])->where('id', '=', $idMenu)->first()->restaurant->gastronomy->description;

            // Take Food And Description
            $foodsAndDescription = self::$tipicalDishDescription[$gastronomy];

            // Take a random dish
            $dish = array_rand($foodsAndDescription);

            return [
                "id_type_item" => 1,
                'name' => $dish,
                'description' =>  $foodsAndDescription[$dish],
                'img_item' => strtolower(str_replace(' ', '', $dish) . '.jpg'),
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
            $drink = $this->faker->randomElement($drinks);
            return [
                "id_type_item" => 2,
                'name' => $drink,
                'img_item' => mb_strtolower(str_replace(' ', '', $drink) . '.jpg'),
                'id_menu' => $idMenu
            ];
        });
    }
}
