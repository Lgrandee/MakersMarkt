<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Support\Facades\DB;

class StatisticsController extends Controller
{
    public function dashboard()
    {
        // Products per category (type)
        $productsPerCategory = Product::select('type', DB::raw('count(*) as count'))
            ->groupBy('type')
            ->get();

        // Average rating per maker
        $avgRatingPerMaker = Review::select('products.user_id as maker_id', DB::raw('avg(rating) as avg_rating'))
            ->join('products', 'reviews.product_id', '=', 'products.product_id')
            ->groupBy('products.user_id')
            ->with('maker:id,name')
            ->get();

        // Popular product types (most ordered)
        $popularTypes = Product::select('type', DB::raw('count(orders.order_id) as orders_count'))
            ->leftJoin('orders', 'products.product_id', '=', 'orders.product_id')
            ->groupBy('type')
            ->orderBy('orders_count', 'desc')
            ->limit(5)
            ->get();

        return view('statistics.dashboard', compact('productsPerCategory', 'avgRatingPerMaker', 'popularTypes'));
    }
}
