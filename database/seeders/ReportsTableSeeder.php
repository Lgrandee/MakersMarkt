<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Report;
use App\Models\User;
use Illuminate\Database\Seeder;

class ReportsTableSeeder extends Seeder
{
    public function run(): void
    {
        $buyers = User::where('role', 'koper')->get();
        $products = Product::all();

        $reports = [
            [
                'reason' => 'Dit product lijkt niet handgemaakt te zijn, maar wordt massaal geproduceerd.',
                'buyer_index' => 0,
                'product_index' => 2,
            ],
            [
                'reason' => 'De beschrijving klopt niet. Het materiaal is anders dan vermeld.',
                'buyer_index' => 1,
                'product_index' => 5,
            ],
            [
                'reason' => 'Dit product gebruikt mogelijk auteursrechtelijk beschermd materiaal.',
                'buyer_index' => 2,
                'product_index' => 8,
            ],
            [
                'reason' => 'De foto\'s komen niet overeen met het product dat ik heb ontvangen.',
                'buyer_index' => 3,
                'product_index' => 11,
            ],
            [
                'reason' => 'Spelfouten en misleidende informatie in de productbeschrijving.',
                'buyer_index' => 4,
                'product_index' => 14,
            ],
            [
                'reason' => 'De maker reageert niet op vragen. Lijkt inactief.',
                'buyer_index' => 5,
                'product_index' => 17,
            ],
        ];

        foreach ($reports as $reportData) {
            $buyer = $buyers[$reportData['buyer_index'] % $buyers->count()];
            $product = $products[$reportData['product_index'] % $products->count()];

            Report::create([
                'user_id' => $buyer->user_id,
                'product_id' => $product->product_id,
                'reason' => $reportData['reason'],
                'created_at' => now()->subDays(rand(1, 60)),
            ]);
        }

        // Add some random reports
        for ($i = 0; $i < 5; $i++) {
            $buyer = $buyers[rand(0, $buyers->count() - 1)];
            $product = $products[rand(0, $products->count() - 1)];

            Report::create([
                'user_id' => $buyer->user_id,
                'product_id' => $product->product_id,
                'reason' => 'Andere reden: ' . fake()->sentence(),
                'created_at' => now()->subDays(rand(1, 90)),
            ]);
        }
    }
}
