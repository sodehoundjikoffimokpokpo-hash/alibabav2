<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // 1. Afficher le panier

    // 2. Ajouter un produit au panier


    // 3. Supprimer un produit du panier
    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Produit retiré du panier.');
    }

    // Fonction d'aide pour calculer le prix selon les paliers de gros
    private function getWholesalePrice($product, $quantity)
    {
        $prices = $product->wholesalePrices->sortBy('min_quantity');
        $appliedPrice = $prices->first() ? $prices->first()->price_per_unit : 0;

        foreach ($prices as $priceTier) {
            if ($quantity >= $priceTier->min_quantity) {
                $appliedPrice = $priceTier->price_per_unit;
            }
        }

        return $appliedPrice;
    }

public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        // Récupérer le panier actuel en session ou en créer un vide
        $cart = session()->get('cart', []);

        // Si le produit est déjà dans le panier, on incrémente la quantité
        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            // Sinon, on l'ajoute avec ses informations de la base de données
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price, // Prix stocké brut en base (ex: 12500)
                "image" => $product->image
            ];
        }

        // On sauvegarde le panier mis à jour dans la session
        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Le produit a été ajouté à votre panier TogoBa !');
    }

    /**
     * Afficher le contenu du panier
     */
    public function index()
    {
        $cart = session()->get('cart', []);

        // Calcul du total général
        $total = 0;
        foreach($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('cart.index', compact('cart', 'total'));
    }
}
