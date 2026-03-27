<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function store(Request $request, Product $product)
    {
        $request->validate([
            'reason' => 'required|string|min:5',
        ]);

        Auth::user()->reports()->create([
            'product_id' => $product->product_id,
            'reason' => $request->reason,
        ]);

        return back()->with('success', 'Product gemeld. Moderator zal het bekijken.');
    }
}
