<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use App\Models\Report;
use Illuminate\Http\Request;

class ModeratorController extends Controller
{
    // Products pending approval
    public function products()
    {
        $products = Product::where('status', 'pending')->paginate(15);
        return view('moderator.products', compact('products'));
    }

    public function approveProduct(Product $product)
    {
        $product->update(['status' => 'approved']);
        // Notify maker
        $product->maker->notifications()->create([
            'message' => "Je product {$product->name} is goedgekeurd!",
        ]);
        return back()->with('success', 'Product goedgekeurd.');
    }

    public function rejectProduct(Product $product)
    {
        $product->update(['status' => 'rejected']);
        $product->maker->notifications()->create([
            'message' => "Je product {$product->name} is afgekeurd. Neem contact op voor meer info.",
        ]);
        return back()->with('success', 'Product afgekeurd.');
    }

    public function deleteProduct(Product $product)
    {
        $product->delete();
        return back()->with('success', 'Product verwijderd.');
    }

    // Manage users
    public function users()
    {
        $users = User::where('role', '!=', 'moderator')->paginate(15);
        return view('moderator.users', compact('users'));
    }

    public function deleteUser(User $user)
    {
        $user->delete();
        return back()->with('success', 'Gebruiker verwijderd.');
    }

    // Reported content
    public function reports()
    {
        $reports = Report::with('product', 'user')->orderBy('created_at', 'desc')->paginate(15);
        return view('moderator.reports', compact('reports'));
    }

    // Search across content
    public function search(Request $request)
    {
        $type = $request->type; // products, reviews
        $query = $request->search;

        if ($type === 'products') {
            $results = Product::where('name', 'like', "%$query%")
                ->orWhere('description', 'like', "%$query%")
                ->paginate(20);
            return view('moderator.search', compact('results', 'type', 'query'));
        }

        if ($type === 'reviews') {
            $results = \App\Models\Review::where('comment', 'like', "%$query%")
                ->with('product', 'user')
                ->paginate(20);
            return view('moderator.search', compact('results', 'type', 'query'));
        }

        return back();
    }
}
