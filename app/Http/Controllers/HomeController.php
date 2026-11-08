<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Affiche la page d'accueil avec tous les produits
    public function index()
    {
        $products = Product::with(['wholesalePrices', 'shop'])->latest()->get();
        return view('welcome', compact('products'));
    }

    // Affiche la fiche détaillée d'un produit
    public function show($slug)
{
    // Récupère le produit avec sa boutique et ses prix de gros
    $product = Product::with(['wholesalePrices', 'shop'])->where('slug', $slug)->firstOrFail();

    // CORRECTION : On pointe vers le dossier supplier.products
    return view('supplier.products.show', compact('product'));
}
}
