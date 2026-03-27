<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function create(Order $order)
    {
        // Only buyer, order must be shipped, no review yet
        if ($order->buyer_id !== Auth::id() || $order->status !== 'verzonden' || $order->review) {
            abort(403);
        }

        return view('reviews.create', compact('order'));
    }

    public function store(Request $request, Order $order)
    {
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string',
        ]);

        $review = Review::create([
            'order_id' => $order->order_id,
            'product_id' => $order->product_id,
            'user_id' => Auth::id(),
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
        ]);

        // Notify maker
        $order->product->maker->notifications()->create([
            'message' => "Nieuwe review voor {$order->product->name} (score: {$review->rating})",
        ]);

        return redirect()->route('orders.show', $order)->with('success', 'Review geplaatst!');
    }
}
