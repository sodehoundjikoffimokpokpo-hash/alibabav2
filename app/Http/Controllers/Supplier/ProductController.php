<?php

namespace App\Http\Controllers\Supplier;

// ⚡ LES IMPORTATIONS MANQUANTES QUI CORRIGENT LE ROUGE :
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\WholesalePrice;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

use Illuminate\Database\Eloquent\Model;
class ProductController extends Controller
{
    /**
     * 1. Liste des produits du vendeur
     */
    public function index()
    {
        $shop = Auth::user()->shop;

        if (!$shop) {
            return redirect()->route('supplier.shop.create');
        }

        $products = $shop->products()->with('wholesalePrices')->get();

        return view('supplier.products.index', compact('products'));
    }

    /**
     * 2. Afficher le formulaire de création de produit
     */
    public function create()
    {
        if (!Auth::user()->shop) {
            return redirect()->route('supplier.shop.create');
        }

        return view('supplier.products.create');
    }

    /**
     * 3. Enregistrer le produit et ses paliers de prix de gros
     */
    public function store(Request $request)
    {
        $shop = Auth::user()->shop;

        // Validation des entrées du formulaire
        $request->validate([
            'name' => 'required|string|max:255',
            'moq' => 'required|integer|min:1',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'quantities' => 'required|array|min:1',
            'quantities.*' => 'required|integer|min:1',
            'prices' => 'required|array|min:1',
            'prices.*' => 'required|numeric|min:0',
        ]);

        // Création du produit principal
        $product = Product::create([
            'shop_id' => $shop->id,
            'name' => $request->name,
            'slug' => Str::slug($request->name) . '-' . rand(1000, 9999),
            'description' => $request->description,
            'moq' => $request->moq,
            'stock' => $request->stock,
        ]);

        $quantities = $request->quantities;
        $prices = $request->prices;

        // Boucle pour stocker chaque palier de prix dégressif
        for ($i = 0; $i < count($quantities); $i++) {
            WholesalePrice::create([
                'product_id' => $product->id,
                'min_quantity' => $quantities[$i],
                'max_quantity' => isset($quantities[$i+1]) ? ($quantities[$i+1] - 1) : null,
                'price_per_unit' => $prices[$i],
            ]);
        }

        // Redirection vers le tableau de bord avec un message de succès
        return redirect()->route('supplier.dashboard')
            ->with('success', 'Votre produit de vente en gros a été publié avec succès !');
    }



public function dashboard()
{
    // On récupère toutes les commandes passées sur la plateforme (du plus récent au plus ancien)
    // Idéalement filtré par les produits du fournisseur si tu as plusieurs vendeurs
    $orders = Order::with(['user', 'items'])->latest()->get();

    return view('supplier.dashboard', compact('orders'));
}

public function updateStatus(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:en_attente,valide,expedie,annule'
    ]);

    $order = Order::findOrFail($id);
    $order->update(['status' => $request->status]);

    return redirect()->back()->with('success', 'Le statut de la commande a été mis à jour !');
}
}
