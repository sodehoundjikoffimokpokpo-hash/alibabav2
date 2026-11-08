<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    // Afficher la page des favoris
    public function index()
    {
        $favorites = session()->get('favorites', []);

        // Récupérer les détails des produits présents dans les favoris
        $products = Product::with('shop')->whereIn('id', array_keys($favorites))->get();

        return view('favorites.index', compact('products'));
    }

    // Ajouter ou Retirer un produit des favoris
    public function toggle($id)
    {
        $product = Product::findOrFail($id);
        $favorites = session()->get('favorites', []);

        if (isset($favorites[$id])) {
            unset($favorites[$id]);
            $message = "Produit retiré de vos favoris !";
        } else {
            $favorites[$id] = [
                "name" => $product->name,
                "price" => $product->price,
                "image" => $product->image
            ];
            $message = "Produit ajouté à vos favoris ❤️";
        }

        session()->put('favorites', $favorites);

        return redirect()->back()->with('success', $message);
    }
}
