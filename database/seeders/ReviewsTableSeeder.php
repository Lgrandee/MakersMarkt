<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Review;
use Illuminate\Database\Seeder;

class ReviewsTableSeeder extends Seeder
{
    public function run(): void
    {
        $shippedOrders = Order::where('status', 'verzonden')->get();

        $reviews = [
            [
                'rating' => 5,
                'comment' => 'Absoluut prachtig! Het tafeltje is nog mooier dan op de foto. Super snelle levering en goed verpakt. Echt een aanrader!',
            ],
            [
                'rating' => 4,
                'comment' => 'Mooie kwaliteit, alleen iets langer moeten wachten dan aangegeven. Maar het product is het zeker waard!',
            ],
            [
                'rating' => 5,
                'comment' => 'Wat een prachtige theeset! Echt uniek en met veel liefde gemaakt. De maker communiceerde heel goed over de voortgang.',
            ],
            [
                'rating' => 5,
                'comment' => 'Super zachte deken, precies zoals beschreven. De kleur is prachtig en past perfect in mijn interieur.',
            ],
            [
                'rating' => 3,
                'comment' => 'Mooie ketting, maar de sluiting is wat kwetsbaar. Wel goede service van de maker.',
            ],
            [
                'rating' => 5,
                'comment' => 'Wauw! Wat een prachtig kunstwerk. Echt een blikvanger in de tuin. Zeer tevreden!',
            ],
            [
                'rating' => 4,
                'comment' => 'Mooie vaas, alleen iets kleiner dan verwacht. Verder perfect.',
            ],
            [
                'rating' => 5,
                'comment' => 'Fantastische trui, heerlijk warm en zacht. Past perfect. Zeker voor herhaling vatbaar!',
            ],
            [
                'rating' => 5,
                'comment' => 'Super blij met mijn bestelling. De oorbellen zijn lichtgewicht en zien er erg elegant uit.',
            ],
            [
                'rating' => 4,
                'comment' => 'Mooie snijplank, goede kwaliteit. Levering was snel. Aanrader!',
            ],
            [
                'rating' => 5,
                'comment' => 'Prachtig handwerk! De glas-in-lood hanger geeft een mooi kleurenspel in de zon.',
            ],
            [
                'rating' => 5,
                'comment' => 'De eettafel is echt een beauty! Stevig, mooi afgewerkt en past perfect in onze woning. Bedankt Robert!',
            ],
        ];

        $reviewIndex = 0;
        foreach ($shippedOrders as $order) {
            // Only add reviews to some orders
            if (rand(0, 1) && $reviewIndex < count($reviews)) {
                $review = $reviews[$reviewIndex % count($reviews)];

                Review::create([
                    'order_id' => $order->order_id,
                    'product_id' => $order->product_id,
                    'user_id' => $order->buyer_id,
                    'rating' => $review['rating'],
                    'comment' => $review['comment'],
                    'created_at' => $order->created_at->addDays(rand(1, 14)),
                ]);

                $reviewIndex++;
            }
        }
    }
}
