<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Review;
use App\Models\Statistic;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatisticsTableSeeder extends Seeder
{
    public function run(): void
    {
        // Products per category
        $productsPerCategory = Product::select('type', DB::raw('count(*) as count'))
            ->groupBy('type')
            ->get()
            ->toArray();

        Statistic::create([
            'type' => 'products_per_category',
            'value' => $productsPerCategory,
            'created_at' => now(),
        ]);

        // Average rating per maker
        $avgRatingPerMaker = Review::select('products.user_id as maker_id', DB::raw('avg(rating) as avg_rating, count(*) as review_count'))
            ->join('products', 'reviews.product_id', '=', 'products.product_id')
            ->groupBy('products.user_id')
            ->get()
            ->map(function ($item) {
                $maker = \App\Models\User::find($item->maker_id);
                return [
                    'maker_name' => $maker ? $maker->name : 'Onbekend',
                    'maker_id' => $item->maker_id,
                    'avg_rating' => round($item->avg_rating, 2),
                    'review_count' => $item->review_count,
                ];
            })
            ->toArray();

        Statistic::create([
            'type' => 'avg_rating_per_maker',
            'value' => $avgRatingPerMaker,
            'created_at' => now(),
        ]);

        // Popular product types (most ordered)
        $popularTypes = Product::select('type', DB::raw('count(orders.order_id) as orders_count'))
            ->leftJoin('orders', 'products.product_id', '=', 'orders.product_id')
            ->groupBy('type')
            ->orderBy('orders_count', 'desc')
            ->limit(5)
            ->get()
            ->toArray();

        Statistic::create([
            'type' => 'popular_product_types',
            'value' => $popularTypes,
            'created_at' => now(),
        ]);

        // Total statistics
        $totalStats = [
            'total_users' => \App\Models\User::count(),
            'total_makers' => \App\Models\User::where('role', 'maker')->count(),
            'total_buyers' => \App\Models\User::where('role', 'koper')->count(),
            'total_products' => Product::count(),
            'approved_products' => Product::where('status', 'approved')->count(),
            'pending_products' => Product::where('status', 'pending')->count(),
            'total_orders' => \App\Models\Order::count(),
            'total_reviews' => Review::count(),
            'average_rating' => Review::avg('rating'),
        ];

        Statistic::create([
            'type' => 'total_statistics',
            'value' => $totalStats,
            'created_at' => now(),
        ]);

        // Monthly orders trend
        $monthlyOrders = \App\Models\Order::select(
            DB::raw('strftime("%Y-%m", created_at) as month'),
            DB::raw('count(*) as orders_count')
        )
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->toArray();

        Statistic::create([
            'type' => 'monthly_orders_trend',
            'value' => $monthlyOrders,
            'created_at' => now(),
        ]);

        // Product status distribution
        $statusDistribution = Product::select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->get()
            ->toArray();

        Statistic::create([
            'type' => 'product_status_distribution',
            'value' => $statusDistribution,
            'created_at' => now(),
        ]);
    }
}
