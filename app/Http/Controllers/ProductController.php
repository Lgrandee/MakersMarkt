<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    // Public listing (only approved)
    public function index(Request $request)
    {
        $query = Product::where('status', 'approved');

        // Search
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        // Filters
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }
        if ($request->filled('material')) {
            $query->where('material', $request->material);
        }
        if ($request->filled('production_time')) {
            $query->where('production_time', '<=', $request->production_time);
        }

        $products = $query->paginate(12);

        return view('products.index', compact('products'));
    }

    public function show(Product $product)
    {
        // Only show if approved or if maker/owner (for preview)
        if ($product->status !== 'approved' && (!Auth::check() || Auth::user()->user_id !== $product->user_id)) {
            abort(404);
        }
        return view('products.show', compact('product'));
    }

    // Maker: portfolio
    public function makerIndex(Request $request)
    {
        $query = Auth::user()->products();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $products = $query->paginate(12);
        return view('maker.products.index', compact('products'));
    }

    public function create()
    {
        return view('maker.products.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required',
            'type' => 'required|string',
            'material' => 'required|string',
            'production_time' => 'required|integer|min:1',
        ]);

        $product = Auth::user()->products()->create([
            ...$validated,
            'status' => 'pending',
        ]);

        return redirect()->route('maker.products.index')->with('success', 'Product aangemaakt, wacht op goedkeuring.');
    }

    public function edit(Product $product)
    {
        $this->authorize('update', $product);
        return view('maker.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $this->authorize('update', $product);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required',
            'type' => 'required|string',
            'material' => 'required|string',
            'production_time' => 'required|integer|min:1',
        ]);

        $product->update($validated);
        return redirect()->route('maker.products.index')->with('success', 'Product bijgewerkt.');
    }

    public function destroy(Product $product)
    {
        $this->authorize('delete', $product);
        $product->delete();
        return redirect()->route('maker.products.index')->with('success', 'Product verwijderd.');
    }
}
