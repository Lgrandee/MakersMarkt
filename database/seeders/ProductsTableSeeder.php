<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    public function run(): void
    {
        $makers = User::where('role', 'maker')->get();

        $products = [
            // Woodcraft by Jan
            [
                'name' => 'Handgemaakt Eiken Bijzettafeltje',
                'description' => 'Prachtig ambachtelijk bijzettafeltje gemaakt van massief eiken hout. Elk stuk is uniek en met de hand afgewerkt met natuurlijke olie. Perfect naast de bank of als plantenstandaard.',
                'type' => 'meubels',
                'material' => 'hout',
                'production_time' => 14,
                'status' => 'approved',
            ],
            [
                'name' => 'Walnoten Snijplank met Handgreep',
                'description' => 'Stijlvolle snijplank van duurzaam walnoot hout. Voorzien van een handige handgreep en olie-afwerking. Formaat: 40x25 cm. Perfect voor kaas, vlees of als serveerplank.',
                'type' => 'keuken',
                'material' => 'hout',
                'production_time' => 7,
                'status' => 'approved',
            ],
            [
                'name' => 'Gepersonaliseerde Houten Liefdeslot',
                'description' => 'Houten hangslot met persoonlijke gravure. Perfect voor bruiloften of jubilea. Wordt geleverd met een mooie cadeauverpakking.',
                'type' => 'cadeau',
                'material' => 'hout',
                'production_time' => 5,
                'status' => 'pending',
            ],

            // Ceramic Art by Emma
            [
                'name' => 'Keramiek Theeset - Handgedraaid',
                'description' => 'Complete theeset met theepot en 4 kopjes, allemaal met de hand gedraaid op de pottenbakkersschijf. Geglazuurd in een prachtige blauwe tint. Elke set is uniek.',
                'type' => 'keramiek',
                'material' => 'keramiek',
                'production_time' => 21,
                'status' => 'approved',
            ],
            [
                'name' => 'Minimalistische Keramieken Vaas',
                'description' => 'Elegante vaas van steengoed, met matte witte glazuur. Perfect voor droogbloemen of als sculpturaal object. Hoogte: 25 cm.',
                'type' => 'keramiek',
                'material' => 'keramiek',
                'production_time' => 10,
                'status' => 'approved',
            ],
            [
                'name' => 'Handgemaakte Keramieken Bordenset',
                'description' => 'Set van 4 handgemaakte eetborden met unieke glazuur patronen. Elke bord is anders vanwege het handmatige proces. Geschikt voor de vaatwasser.',
                'type' => 'keramiek',
                'material' => 'keramiek',
                'production_time' => 14,
                'status' => 'pending',
            ],

            // Textile Dreams by Lisa
            [
                'name' => 'Handgeweven Woondeken - Gebreid',
                'description' => 'Luxe woondeken van 100% merinowol, met de hand geweven op een weefgetouw. Zachte aardetinten en subtiel patroon. Afmeting: 130x170 cm.',
                'type' => 'textiel',
                'material' => 'textiel',
                'production_time' => 12,
                'status' => 'approved',
            ],
            [
                'name' => 'Macramé Wandkleed',
                'description' => 'Prachtig macramé wandkleed met franjes, perfect voor een boho interieur. Handgeknoopt van natuurlijk katoen. Breedte: 80 cm, lengte: 120 cm.',
                'type' => 'textiel',
                'material' => 'textiel',
                'production_time' => 8,
                'status' => 'approved',
            ],

            // Jewelry Designs by Sophie
            [
                'name' => 'Zilveren Ketting met Bergkristal',
                'description' => 'Elegante ketting van sterling zilver met een echte bergkristal als hangertje. Uniek en handgemaakt. Lengte: 45 cm met verstelbare sluiting.',
                'type' => 'sieraden',
                'material' => 'metaal',
                'production_time' => 7,
                'status' => 'approved',
            ],
            [
                'name' => 'Goudkleurige Oorbellen met Bladmotief',
                'description' => 'Handgemaakte oorbellen in de vorm van bladeren, gemaakt van messing met een 14-karaats goudlaag. Lichtgewicht en comfortabel om te dragen.',
                'type' => 'sieraden',
                'material' => 'metaal',
                'production_time' => 5,
                'status' => 'approved',
            ],
            [
                'name' => 'Gepersonaliseerde Naamketting',
                'description' => 'Stijlvolle ketting met jouw naam of initialen in sierlijk schrift. Verkrijgbaar in zilver, goud en rosegoud. Wordt geleverd in een luxe doosje.',
                'type' => 'sieraden',
                'material' => 'metaal',
                'production_time' => 4,
                'status' => 'pending',
            ],

            // Metal Art Studio by Thomas
            [
                'name' => 'Metalen Sculptuur - Abstract',
                'description' => 'Moderne metalen sculptuur van gerecycled staal, perfect voor in de tuin of op het terras. Uniek kunstwerk dat roestvrij blijft door speciale behandeling.',
                'type' => 'kunst',
                'material' => 'metaal',
                'production_time' => 21,
                'status' => 'approved',
            ],
            [
                'name' => 'Handgesmede Kaarsenstandaard',
                'description' => 'Minimalistische kaarsenstandaard van handgesmeed ijzer. Geschikt voor theelichtjes of smalle kaarsen. Stevig en stabiel.',
                'type' => 'woonaccessoires',
                'material' => 'metaal',
                'production_time' => 7,
                'status' => 'approved',
            ],

            // Glass Artisan by Anna
            [
                'name' => 'Geblazen Glas Vase - Uniek',
                'description' => 'Prachtige handgeblazen glazen vaas in levendige kleuren. Elk exemplaar is uniek vanwege het ambachtelijke proces. Hoogte: 30 cm.',
                'type' => 'glas',
                'material' => 'glas',
                'production_time' => 14,
                'status' => 'approved',
            ],
            [
                'name' => 'Glas-in-Lood Raamhanger',
                'description' => 'Kleurrijke glas-in-lood raamhanger met vlindermotief. Brengt een vrolijke sfeer in huis. Wordt geleverd met zuignap voor in het raam.',
                'type' => 'glas',
                'material' => 'glas',
                'production_time' => 5,
                'status' => 'pending',
            ],

            // Furniture Craft by Robert
            [
                'name' => 'Industriele Eettafel - Hout en Metaal',
                'description' => 'Stoere eettafel van massief eiken met een metalen frame in industriele stijl. Perfect voor 6-8 personen. Afmeting: 200x90 cm.',
                'type' => 'meubels',
                'material' => 'hout',
                'production_time' => 28,
                'status' => 'approved',
            ],
            [
                'name' => 'Wandplank met Haken - Set van 3',
                'description' => 'Praktische wandplanken met geïntegreerde haken, ideaal voor in de gang of keuken. Gemaakt van gerecycled hout met natuurlijke afwerking.',
                'type' => 'meubels',
                'material' => 'hout',
                'production_time' => 10,
                'status' => 'approved',
            ],

            // Knit Creations by Maria
            [
                'name' => 'Handgebreide Trui - Unisex',
                'description' => 'Warme handgebreide trui van 100% alpacawol. Verkrijgbaar in verschillende maten en kleuren. Handwas aanbevolen.',
                'type' => 'kleding',
                'material' => 'textiel',
                'production_time' => 14,
                'status' => 'approved',
            ],
            [
                'name' => 'Gebreide Babydeken',
                'description' => 'Zachte babydeken van biologisch katoen, perfect als kraamcadeau. Patroon met kabels en liefdessymbolen. Afmeting: 70x90 cm.',
                'type' => 'textiel',
                'material' => 'textiel',
                'production_time' => 8,
                'status' => 'pending',
            ],
        ];

        // Distribute products among makers
        $makerCount = $makers->count();
        $productIndex = 0;

        foreach ($products as $productData) {
            $maker = $makers[$productIndex % $makerCount];

            Product::create([
                'user_id' => $maker->user_id,
                'name' => $productData['name'],
                'description' => $productData['description'],
                'type' => $productData['type'],
                'material' => $productData['material'],
                'production_time' => $productData['production_time'],
                'status' => $productData['status'],
            ]);

            $productIndex++;
        }
    }
}
