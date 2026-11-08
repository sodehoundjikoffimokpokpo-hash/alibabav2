<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\Supplier\ProductController as SupplierProductController;

/*
|--------------------------------------------------------------------------
| 1. Routes Publiques (Visiteurs & Tout le monde)
|--------------------------------------------------------------------------
*/

// Page d'accueil officielle du site (TogoBa) avec injection des produits
Route::get('/', [HomeController::class, 'index'])->name('home');

// Moteur de recherche et liste des produits (Résout l'erreur products.index)
Route::get('/products', [HomeController::class, 'search'])->name('products.index');

// Détails d'un produit spécifique
Route::get('/products/{slug}', [HomeController::class, 'show'])->name('products.show');


/*
|--------------------------------------------------------------------------
| 2. Gestion du Panier & de la Commande (B2B)
|--------------------------------------------------------------------------
*/
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

// Passage de la commande
Route::post('/checkout', [OrderController::class, 'checkout'])->name('cart.checkout');


/*
|--------------------------------------------------------------------------
| 3. Routes Communes (Utilisateurs connectés : Acheteurs / Vendeurs)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {

    // Tableau de bord standard (Acheteurs)
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Profil Utilisateur (Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


/*
|--------------------------------------------------------------------------
| 4. Routes Sécurisées Vendeurs (Connectés ET Rôle 'supplier')
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'supplier'])->group(function () {

    // Écran d'accueil du vendeur (Redirection s'il n'a pas encore de boutique)
    Route::get('/supplier/dashboard', function () {
        if (!auth()->user()->shop) {
            return redirect()->route('supplier.shop.create');
        }
        return view('supplier.dashboard');
    })->name('supplier.dashboard');

    // --- Gestion de la Boutique (Shop) ---
    Route::get('/supplier/shop/create', [ShopController::class, 'create'])->name('supplier.shop.create');
    Route::post('/supplier/shop/store', [ShopController::class, 'store'])->name('supplier.shop.store');

    // --- Gestion du Catalogue Produits ---
    Route::get('/supplier/products', [SupplierProductController::class, 'index'])->name('supplier.products.index');
    Route::get('/supplier/products/create', [SupplierProductController::class, 'create'])->name('supplier.products.create');
    Route::post('/supplier/products/store', [SupplierProductController::class, 'store'])->name('supplier.products.store');

    // --- Suivi des Commandes Recues par le Fournisseur ---
    Route::post('/supplier/orders/{id}/status', [SupplierProductController::class, 'updateStatus'])->name('supplier.orders.updateStatus');
});


/*
|--------------------------------------------------------------------------
| 5. Authentification (Chargement automatique de Breeze)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';


use App\Http\Controllers\FavoriteController;

// --- Gestion des Favoris ---
Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
Route::post('/favorites/toggle/{id}', [FavoriteController::class, 'toggle'])->name('favorites.toggle');
