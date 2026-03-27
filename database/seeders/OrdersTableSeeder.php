<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    public function run(): void
    {
        $buyers = User::where('role', 'koper')->get();
        $approvedProducts = Product::where('status', 'approved')->get();

        $orders = [
            [
                'buyer_index' => 0,
                'product_index' => 0,
                'status' => 'verzonden',
                'comment' => 'Graag inpakken als cadeau, het is een verrassing!',
            ],
            [
                'buyer_index' => 1,
                'product_index' => 3,
                'status' => 'in productie',
                'comment' => 'Kan het in blauw?',
            ],
            [
                'buyer_index' => 2,
                'product_index' => 6,
                'status' => 'in productie',
                'comment' => 'Ik heb een huisdier, graag hypoallergene materialen gebruiken.',
            ],
            [
                'buyer_index' => 3,
                'product_index' => 8,
                'status' => 'verzonden',
                'comment' => null,
            ],
            [
                'buyer_index' => 4,
                'product_index' => 11,
                'status' => 'geweigerd',
                'comment' => 'Ik heb een andere kleur besteld, dit klopt niet.',
            ],
            [
                'buyer_index' => 5,
                'product_index' => 14,
                'status' => 'verzonden',
                'comment' => 'Super blij mee! Kan niet wachten.',
            ],
            [
                'buyer_index' => 0,
                'product_index' => 2,
                'status' => 'in productie',
                'comment' => 'Graag de initialen "P&L" graveren.',
            ],
            [
                'buyer_index' => 6,
                'product_index' => 4,
                'status' => 'verzonden',
                'comment' => 'Wordt het op tijd voor kerst?',
            ],
            [
                'buyer_index' => 7,
                'product_index' => 9,
                'status' => 'in productie',
                'comment' => null,
            ],
            [
                'buyer_index' => 1,
                'product_index' => 13,
                'status' => 'verzonden',
                'comment' => 'Prachtig!',
            ],
            [
                'buyer_index' => 2,
                'product_index' => 16,
                'status' => 'in productie',
                'comment' => 'Maat M graag',
            ],
            [
                'buyer_index' => 3,
                'product_index' => 1,
                'status' => 'verzonden',
                'comment' => 'Speciaal voor mijn moeder haar verjaardag.',
            ],
        ];

        foreach ($orders as $orderData) {
            $buyer = $buyers[$orderData['buyer_index'] % $buyers->count()];
            $product = $approvedProducts[$orderData['product_index'] % $approvedProducts->count()];

            Order::create([
                'buyer_id' => $buyer->user_id,
                'product_id' => $product->product_id,
                'status' => $orderData['status'],
                'comment' => $orderData['comment'],
                'created_at' => now()->subDays(rand(1, 30)),
            ]);
        }

        // Add some additional orders with random dates
        for ($i = 0; $i < 10; $i++) {
            $buyer = $buyers[rand(0, $buyers->count() - 1)];
            $product = $approvedProducts[rand(0, $approvedProducts->count() - 1)];

            Order::create([
                'buyer_id' => $buyer->user_id,
                'product_id' => $product->product_id,
                'status' => ['in productie', 'verzonden', 'geweigerd'][rand(0, 2)],
                'comment' => rand(0, 1) ? 'Extra wens: ' . fake()->sentence() : null,
                'created_at' => now()->subDays(rand(1, 60)),
            ]);
        }
    }
}
