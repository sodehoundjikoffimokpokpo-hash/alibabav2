<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function checkout(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('home')->with('error', 'Votre panier est vide.');
        }

        // Calcul du total général
        $totalGeneral = 0;
        foreach ($cart as $item) {
            $totalGeneral += $item['price'] * $item['quantity'];
        }

        // Sécurisation de la transaction avec un DB::transaction
        DB::transaction(function () use ($cart, $totalGeneral) {
            $order = Order::create([
                'user_id' => auth()->id(), // null si non connecté
                'total_amount' => $totalGeneral,
                'status' => 'en_attente'
            ]);

            foreach ($cart as $id => $item) {
                DB::table('order_items')->insert([
                    'order_id' => $order->id,
                    'product_id' => $id,
                    'product_name' => $item['name'],
                    'quantity' => $item['quantity'],
                    'price_per_unit' => $item['price'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        });

        // On vide le panier après validation
        session()->forget('cart');

        return view('cart.success', compact('totalGeneral'));
    }
}
