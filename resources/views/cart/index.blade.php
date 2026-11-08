<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mon Panier - TogoBa</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-900 antialiased">

    <!-- 🟢 BARRE SUPÉRIEURE & NAVIGATION -->
    <nav class="bg-white border-b border-gray-100 shadow-sm sticky top-0 z-50 py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between">
            <!-- Logo TogoBa -->
            <a href="{{ url('/') }}" class="flex items-center gap-2 group">
                <div class="w-10 h-10 bg-[#005c33] rounded-xl flex items-center justify-center text-white font-black text-xl shadow-sm">
                    T
                </div>
                <div>
                    <span class="text-xl font-black text-[#005c33] tracking-tight">Togo<span class="text-[#e1a900]">Ba</span></span>
                    <p class="text-[10px] text-gray-400 font-medium -mt-1">Le marché du Togo</p>
                </div>
            </a>

            <!-- Bouton Retour boutique -->
            <a href="{{ url('/') }}" class="px-4 py-2 border border-gray-200 hover:bg-gray-50 text-gray-700 font-bold text-xs uppercase tracking-wider rounded-lg transition-colors">
                ← Boutique
            </a>
        </div>
    </nav>

    <!-- 🛒 ESPACE PANIER -->
    <main class="max-w-5xl mx-auto px-4 py-12">
        <div class="mb-8">
            <h1 class="text-3xl font-black text-gray-900 tracking-tight">Votre Panier</h1>
            <p class="text-xs text-gray-500 mt-1">Gérez les articles sélectionnés auprès de nos vendeurs locaux</p>
        </div>

        <!-- Messages Flash de Notifications -->
        @if(session('success'))
            <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl font-bold text-xs flex items-center gap-2 shadow-sm">
                ✅ {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-800 rounded-xl font-bold text-xs flex items-center gap-2 shadow-sm">
                ⚠️ {{ session('error') }}
            </div>
        @endif

        <!-- État Panier Vide -->
        @if(empty($cart))
            <div class="bg-white rounded-2xl shadow-sm p-12 text-center border border-gray-100">
                <div class="w-16 h-16 bg-gray-50 text-gray-400 rounded-full flex items-center justify-center text-2xl mx-auto mb-4">
                    🛒
                </div>
                <p class="text-gray-500 text-base font-medium mb-6">Votre panier est actuellement vide.</p>
                <a href="{{ url('/') }}" class="inline-block px-6 py-3 bg-[#005c33] hover:bg-[#004425] text-white font-bold text-xs uppercase tracking-widest rounded-xl shadow transition-colors">
                    Explorer le catalogue
                </a>
            </div>
        @else
            <!-- Grille Principale du Panier -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <!-- Liste des articles -->
                <div class="lg:col-span-2 space-y-4">
                    @foreach($cart as $id => $item)
                        <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 hover:border-gray-200 transition-colors">
                            <div class="space-y-1.5">
                                <!-- Sécurité anti-crash : shop_name ou fallback -->
                                <span class="inline-flex items-center gap-1 text-[10px] font-black text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded uppercase tracking-wider">
                                    📍 {{ $item['shop_name'] ?? 'Boutique locale' }}
                                </span>

                                <h2 class="text-base font-extrabold text-gray-900 tracking-tight">{{ $item['name'] }}</h2>

                                @if(isset($item['moq']) && $item['moq'] > 1)
                                    <p class="text-[11px] text-amber-600 font-bold">MOQ requis : {{ $item['moq'] }} pièces</p>
                                @endif

                                <p class="text-xs font-semibold text-gray-500">
                                    Quantité : <span class="text-[#005c33] font-black bg-gray-100 px-2 py-0.5 rounded">{{ $item['quantity'] }}</span> unités
                                </p>
                            </div>

                            <!-- Prix & Actions -->
                            <div class="flex sm:flex-col items-end justify-between w-full sm:w-auto border-t sm:border-t-0 pt-4 sm:pt-0 gap-4">
                                <div class="text-left sm:text-right">
                                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider">Prix unitaire :</p>
                                    <p class="text-base font-black text-gray-900">{{ number_format($item['price'], 0, ',', ' ') }} FCFA</p>
                                    <p class="text-xs font-bold text-[#e1a900] mt-0.5">
                                        Sous-total : {{ number_format($item['price'] * $item['quantity'], 0, ',', ' ') }} FCFA
                                    </p>
                                </div>

                                <form action="{{ route('cart.remove', $id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-[11px] font-black text-red-500 hover:text-red-700 transition-colors uppercase tracking-widest flex items-center gap-1">
                                        ❌ Supprimer
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Résumé de la Commande -->
                <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100 h-fit space-y-6">
                    <h3 class="text-xs font-black text-gray-900 uppercase tracking-widest border-b border-gray-50 pb-2">Résumé de la commande</h3>

                    <div class="flex justify-between items-center text-xs font-bold text-gray-500">
                        <span>Nombre d'articles :</span>
                        <span class="text-gray-900 font-black bg-gray-100 px-2 py-1 rounded">{{ count($cart) }}</span>
                    </div>

                    <div class="border-t border-gray-100 pt-4 flex justify-between items-end">
                        <div>
                            <p class="text-gray-900 font-black text-sm uppercase tracking-wider">Total Général :</p>
                            <p class="text-[10px] text-gray-400 font-bold">Règlement via Flooz, T-Money ou Cash</p>
                        </div>
                        <!-- Remplacement de la variable de devise de € à FCFA -->
                        <span class="text-2xl font-black text-[#005c33] tracking-tight">
                            {{ number_format($totalGeneral ?? 0, 0, ',', ' ') }} <span class="text-xs font-extrabold text-[#e1a900]">FCFA</span>
                        </span>
                    </div>

                    <div class="pt-2">
                        <form action="{{ route('cart.checkout') }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full py-3.5 bg-[#e1a900] hover:bg-[#c99700] text-gray-900 font-black rounded-xl shadow-md uppercase text-xs tracking-widest transition-all text-center">
                                🛒 Passer la commande
                            </button>
                        </form>

                        <a href="{{ url('/') }}" class="block text-center text-[10px] font-black text-gray-400 hover:text-gray-600 uppercase tracking-widest mt-4 transition-colors">
                            ← Continuer mes achats
                        </a>
                    </div>
                </div>

            </div>
        @endif
    </main>

</body>
</html>
