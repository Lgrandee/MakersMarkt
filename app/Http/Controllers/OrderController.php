<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // Buyer creates order
    public function store(Request $request, Product $product)
    {
        // Only approved products can be ordered
        if ($product->status !== 'approved') {
            abort(403);
        }

        $order = Order::create([
            'buyer_id' => Auth::id(),
            'product_id' => $product->product_id,
            'comment' => $request->comment,
            'status' => 'in productie',
        ]);

        // Notify maker
        $product->maker->notifications()->create([
            'message' => "Nieuwe bestelling voor {$product->name} van {$order->buyer->name}",
        ]);

        return redirect()->route('orders.index')->with('success', 'Bestelling geplaatst!');
    }

    // Buyer orders index
    public function index()
    {
        $orders = Auth::user()->ordersAsBuyer()->with('product')->paginate(10);
        return view('orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $this->authorize('view', $order);
        return view('orders.show', compact('order'));
    }

    // Maker updates order status
    public function updateStatus(Request $request, Order $order)
    {
        $this->authorize('updateStatus', $order);

        $validated = $request->validate([
            'status' => 'required|in:in productie,verzonden,geweigerd',
            'comment' => 'nullable|string',
        ]);

        $order->update($validated);

        // Notify buyer
        $order->buyer->notifications()->create([
            'message' => "Status van bestelling {$order->order_id} is gewijzigd naar {$order->status}.",
        ]);

        return back()->with('success', 'Status bijgewerkt.');
    }

    // Maker orders index (orders for their products)
    public function makerOrders()
    {
        $orders = Order::whereHas('product', function ($q) {
            $q->where('user_id', Auth::id());
        })->with('product', 'buyer')->paginate(10);

        return view('maker.orders.index', compact('orders'));
    }
}
