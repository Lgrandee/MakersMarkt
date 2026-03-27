<?php

namespace Database\Seeders;

use App\Models\Notification;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class NotificationsTableSeeder extends Seeder
{
    public function run(): void
    {
        // Notifications for makers about new orders
        $orders = Order::with('product')->get();

        foreach ($orders as $order) {
            // Notify maker
            Notification::create([
                'user_id' => $order->product->user_id,
                'message' => "Nieuwe bestelling ontvangen voor {$order->product->name} van {$order->buyer->name}",
                'is_read' => rand(0, 1) ? true : false,
                'created_at' => $order->created_at,
            ]);

            // Notify buyer when order is shipped (if shipped)
            if ($order->status === 'verzonden') {
                Notification::create([
                    'user_id' => $order->buyer_id,
                    'message' => "Je bestelling #{$order->order_id} is verzonden!",
                    'is_read' => rand(0, 1) ? true : false,
                    'created_at' => $order->updated_at,
                ]);
            }
        }

        // Notifications about reviews
        $reviews = \App\Models\Review::with('product')->get();

        foreach ($reviews as $review) {
            Notification::create([
                'user_id' => $review->product->user_id,
                'message' => "Nieuwe review voor {$review->product->name} - Score: {$review->rating}/5",
                'is_read' => rand(0, 1) ? true : false,
                'created_at' => $review->created_at,
            ]);
        }

        // Notifications about product approval/rejection
        $products = Product::whereIn('status', ['approved', 'rejected'])->get();

        foreach ($products as $product) {
            if ($product->status === 'approved') {
                $message = "Je product {$product->name} is goedgekeurd en nu zichtbaar voor kopers!";
            } else {
                $message = "Je product {$product->name} is afgekeurd. Neem contact op met de moderator voor meer informatie.";
            }

            Notification::create([
                'user_id' => $product->user_id,
                'message' => $message,
                'is_read' => rand(0, 1) ? true : false,
                'created_at' => $product->updated_at,
            ]);
        }

        // Add some general notifications for buyers
        $buyers = User::where('role', 'koper')->get();

        $generalMessages = [
            'Welkom bij MakerMarket! Ontdek unieke handgemaakte producten.',
            'Vergeet niet om een review achter te laten voor je laatste aankoop!',
            'Nieuwe producten toegevoegd! Bekijk de laatste creaties.',
            'Krijg 10% korting op je volgende bestelling met code: MAKER10',
        ];

        foreach ($buyers as $buyer) {
            if (rand(0, 1)) {
                Notification::create([
                    'user_id' => $buyer->user_id,
                    'message' => $generalMessages[array_rand($generalMessages)],
                    'is_read' => rand(0, 1) ? true : false,
                    'created_at' => now()->subDays(rand(1, 30)),
                ]);
            }
        }
    }
}
