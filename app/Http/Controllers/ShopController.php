<?php


namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    // 1. Afficher le formulaire de création
    public function create()
    {
        // Sécurité : Si le vendeur a déjà une boutique, on le renvoie au dashboard
        if (Auth::user()->shop) {
            return redirect()->route('supplier.dashboard');
        }

        return view('supplier.shop.create');
    }

    // 2. Enregistrer la boutique en base de données
    public function store(Request $request)
    {
        // Validation des données B2B
        $request->validate([
            'name' => 'required|string|max:255|unique:shops,name',
            'company_register_number' => 'required|string|max:100',
            'country' => 'required|string|max:100',
            'description' => 'nullable|string',
        ]);

        // Création de la boutique liée à l'utilisateur connecté
        Shop::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'slug' => Str::slug($request->name), // Génération automatique du slug
            'company_register_number' => $request->company_register_number,
            'country' => $request->country,
            'description' => $request->description,
            'is_verified' => false, // Sera validé par l'admin plus tard
        ]);

        return redirect()->route('supplier.dashboard')->with('success', 'Votre entreprise a été enregistrée avec succès !');
    }
}
