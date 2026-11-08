<x-app-layout>
    <div class="py-12 bg-gray-50/50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- En-tête -->
            <div class="mb-8">
                <h2 class="text-2xl font-black text-gray-900 flex items-center gap-2">
                    Mes Favoris ❤️
                </h2>
                <p class="text-xs text-gray-500 mt-0.5">Retrouvez ici tous les articles togolais que vous avez mis de côté</p>
            </div>

            <!-- Messages Flash -->
            @if(session('success'))
                <div class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl font-bold text-xs shadow-sm">
                    ✅ {{ session('success') }}
                </div>
            @endif

            <!-- Grille des Favoris -->
            @if($products->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                    @foreach($products as $product)
                        <div class="bg-white rounded-2xl border border-gray-100 p-4 shadow-sm hover:shadow-md transition-all flex flex-col justify-between group relative">

                            <!-- Bouton pour Retirer des favoris -->
                            <form action="{{ route('favorites.toggle', $product->id) }}" method="POST" class="absolute top-6 right-6 z-10">
                                @csrf
                                <button type="submit" class="w-8 h-8 bg-red-50 text-red-500 rounded-full flex items-center justify-center text-xs shadow-sm hover:bg-red-100 transition-colors" title="Retirer des favoris">
                                    ❌
                                </button>
                            </form>

                            <div>
                                <!-- Image -->
                                <a href="{{ route('products.show', $product->id) }}" class="aspect-square bg-gray-50 rounded-xl overflow-hidden mb-4 flex items-center justify-center text-4xl group-hover:scale-101 transition-transform relative block">
                                    @if($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                    @else
                                        📦
                                    @endif
                                </a>

                                <!-- Nom -->
                                <h3 class="font-extrabold text-gray-900 text-sm leading-tight tracking-tight line-clamp-2 min-h-[40px]">
                                    <a href="{{ route('products.show', $product->id) }}" class="hover:text-[#005c33]">
                                        {{ $product->name }}
                                    </a>
                                </h3>

                                <!-- Prix -->
                                <div class="mt-3">
                                    <p class="text-base font-black text-gray-900">
                                        {{ number_format($product->price, 0, ',', ' ') }} FCFA
                                    </p>
                                </div>

                                <!-- Origine / Boutique -->
                                <p class="text-[10px] text-gray-400 font-bold flex items-center gap-1 mt-3">
                                    📍 {{ $product->shop->name ?? 'Marché local' }} - Lomé
                                </p>
                            </div>

                            <!-- Ajouter au panier direct depuis les favoris -->
                            <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mt-4">
                                @csrf
                                <button type="submit" class="w-full py-2.5 bg-[#e1a900] hover:bg-[#c99700] text-gray-900 font-bold text-xs rounded-xl shadow-sm transition-all flex items-center justify-center gap-2 tracking-wide uppercase">
                                    🛒 Mettre au Panier
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Si aucun favori -->
                <div class="bg-white rounded-2xl border border-gray-100 p-12 text-center shadow-sm max-w-md mx-auto mt-12">
                    <div class="text-4xl mb-4">❤️</div>
                    <h3 class="text-base font-black text-gray-900">Votre liste est vide</h3>
                    <p class="text-xs text-gray-500 mt-1 mb-6">Vous n'avez pas encore enregistré d'articles coup de cœur.</p>
                    <a href="{{ url('/') }}" class="inline-block px-6 py-2.5 bg-[#005c33] hover:bg-[#004425] text-white font-bold text-xs uppercase tracking-wider rounded-xl transition-colors">
                        Découvrir les produits
                    </a>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
