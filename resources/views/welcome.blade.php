<x-app-layout>
    <!-- 🟢 BARRE SUPÉRIEURE (Top Navigation) -->
    <div class="bg-[#005c33] text-white text-xs py-2 px-4 sm:px-6 lg:px-8 flex justify-between items-center border-b border-white/10">
        <div class="flex items-center gap-4">
            <span class="flex items-center gap-1">📞 +228 90 00 00 00</span>
            <span class="flex items-center gap-1">📍 Lomé, Togo</span>
        </div>
        <div class="flex items-center gap-4">
            <a href="{{ route('register') }}" class="hover:underline">Devenir Vendeur</a>
            <a href="#engagements" class="hover:underline">Aide</a>
            <span class="bg-white/20 px-2 py-0.5 rounded text-[10px] uppercase font-bold tracking-wider">Livraison</span>
        </div>
    </div>

    <!-- ⚪ BARRE DE RECHERCHE PRINCIPALE (Navbar) -->
    <nav class="bg-white border-b border-gray-100 shadow-sm sticky top-0 z-50 py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-wrap items-center justify-between gap-4">
            <!-- Logo TogoBa -->
            <a href="{{ url('/') }}" class="flex items-center gap-2 group">
                <div class="w-10 h-10 bg-[#005c33] rounded-xl flex items-center justify-center text-white font-black text-xl shadow-sm transition-transform group-hover:scale-105">
                    T
                </div>
                <div>
                    <span class="text-xl font-black text-[#005c33] tracking-tight">Togo<span class="text-[#e1a900]">Ba</span></span>
                    <p class="text-[10px] text-gray-400 font-medium -mt-1">Le marché du Togo</p>
                </div>
            </a>

            <!-- Moteur de Recherche Complet -->
            <form action="{{ route('products.index') }}" method="GET" class="flex-1 max-w-2xl flex items-center border-2 border-[#005c33] rounded-xl overflow-hidden shadow-sm">
                <select name="category" class="bg-gray-50 text-xs font-bold text-gray-700 px-4 py-2.5 border-r border-gray-200 outline-none cursor-pointer hidden sm:block">
                    <option value="">Toutes catégories</option>
                    <option value="agriculture" {{ request('category') == 'agriculture' ? 'selected' : '' }}>Agriculture</option>
                    <option value="tissus" {{ request('category') == 'tissus' ? 'selected' : '' }}>Tissus & Mode</option>
                    <option value="electronique" {{ request('category') == 'electronique' ? 'selected' : '' }}>Électronique</option>
                </select>
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Rechercher des produits, fournisseurs..."
                    class="w-full px-4 text-sm outline-none border-none focus:ring-0 placeholder-gray-400"
                >
                <button type="submit" class="bg-[#005c33] hover:bg-[#004425] text-white px-6 py-2.5 transition-colors">
                    🔍
                </button>
            </form>

            <!-- Actions Utilisateur -->
            <div class="flex items-center gap-6">
                <!-- Notifications -->
                <button class="relative text-gray-600 hover:text-gray-900">
                    🔔 <span class="absolute -top-1.5 -right-1.5 bg-red-500 text-white text-[10px] font-bold w-4 h-4 flex items-center justify-center rounded-full">2</span>
                </button>
                <!-- Favoris -->
                <a href="{{ route('favorites.index') }}" class="text-gray-600 hover:text-gray-900">❤️</a>
                <!-- Panier -->
                <a href="{{ route('cart.index') }}" class="relative text-gray-600 hover:text-gray-900">
                    🛒 <span class="absolute -top-1.5 -right-1.5 bg-red-500 text-white text-[10px] font-bold w-4 h-4 flex items-center justify-center rounded-full">
                        {{ count(session('cart', [])) }}
                    </span>
                </a>
                <!-- Connexion / Compte -->
                @auth
                    <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-[#005c33] hover:bg-[#004425] text-white font-bold text-xs uppercase tracking-wider rounded-lg transition-colors">
                        Mon Compte
                    </a>
                @else
                    <a href="{{ route('login') }}" class="px-4 py-2 bg-[#005c33] hover:bg-[#004425] text-white font-bold text-xs uppercase tracking-wider rounded-lg transition-colors">
                        Connexion
                    </a>
                @endauth
            </div>
        </div>

        <!-- Sous-menu des Catégories -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4 flex items-center justify-between text-xs font-bold text-gray-707 overflow-x-auto whitespace-nowrap gap-6 scrollbar-none">
            <div class="flex items-center gap-6">
                <a href="{{ route('products.index', ['category' => 'agriculture']) }}" class="hover:text-[#005c33] transition-colors {{ request('category') == 'agriculture' ? 'text-[#005c33]' : '' }}">Agriculture & Vivres</a>
                <a href="{{ route('products.index', ['category' => 'tissus']) }}" class="hover:text-[#005c33] transition-colors {{ request('category') == 'tissus' ? 'text-[#005c33]' : '' }}">Tissus & Mode</a>
                <a href="{{ route('products.index', ['category' => 'electronique']) }}" class="hover:text-[#005c33] transition-colors {{ request('category') == 'electronique' ? 'text-[#005c33]' : '' }}">Électronique</a>
                <a href="{{ route('products.index', ['category' => 'artisanat']) }}" class="hover:text-[#005c33] transition-colors {{ request('category') == 'artisanat' ? 'text-[#005c33]' : '' }}">Artisanat</a>
                <a href="{{ route('products.index', ['category' => 'beaute']) }}" class="hover:text-[#005c33] transition-colors {{ request('category') == 'beaute' ? 'text-[#005c33]' : '' }}">Beauté & Santé</a>
                <a href="{{ route('products.index', ['category' => 'construction']) }}" class="hover:text-[#005c33] transition-colors {{ request('category') == 'construction' ? 'text-[#005c33]' : '' }}">Construction</a>
                <a href="{{ route('products.index', ['category' => 'alimentation']) }}" class="hover:text-[#005c33] transition-colors {{ request('category') == 'alimentation' ? 'text-[#005c33]' : '' }}">Alimentation</a>
                <a href="{{ route('products.index', ['category' => 'services']) }}" class="hover:text-[#005c33] transition-colors {{ request('category') == 'services' ? 'text-[#005c33]' : '' }}">Services</a>
            </div>
   <a href="{{ route('products.index') }}" class="text-[#e1a900] hover:underline">Toutes les catégories &rarr;</a>
        </div>
    </nav>

    <!-- 🟢 SECTION HERO (Bannière Principale Dégradée) -->
    <div class="py-8 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-gradient-to-r from-[#004425] to-[#006e3d] rounded-3xl p-8 md:p-12 text-white flex flex-col md:flex-row items-center justify-between gap-8 shadow-xl relative overflow-hidden">
                <div class="space-y-6 max-w-xl z-10">
                    <span class="bg-[#e1a900] text-gray-900 font-extrabold text-[10px] tracking-widest uppercase px-3 py-1 rounded-full">
                        Nouvelle Saison
                    </span>
                    <h1 class="text-4xl md:text-5xl font-black tracking-tight leading-tight">
                        Tissus & Pagnes Togolais
                    </h1>
                    <p class="text-sm text-gray-200/90 leading-relaxed font-medium">
                        Les plus beaux pagnes directement des tisserands locaux et revendeurs du grand marché de Lomé.
                    </p>
                    <div class="flex items-center gap-4 pt-2">
                        <a href="{{ route('products.index', ['category' => 'tissus']) }}" class="px-6 py-3 bg-[#e1a900] hover:bg-[#c99700] text-gray-900 font-bold rounded-xl text-xs uppercase tracking-widest shadow-md transition-all flex items-center gap-2">
                            Découvrir &rarr;
                        </a>
                        <a href="{{ route('products.index') }}" class="px-6 py-3 border border-white/30 hover:bg-white/10 text-white font-bold rounded-xl text-xs uppercase tracking-widest transition-all">
                            Voir tout
                        </a>
                    </div>
                    <p class="text-xs text-[#e1a900] font-bold flex items-center gap-1.5 pt-4">
                        🔥 Jusqu'à -40% sur le Wax Hollandais
                    </p>
                </div>

                <!-- Image illustrative à droite -->
                <div class="w-full md:w-1/2 max-w-md relative z-10">
                    <div class="aspect-[4/3] bg-white/10 backdrop-blur border border-white/10 rounded-2xl overflow-hidden shadow-2xl transform rotate-1 hover:rotate-0 transition-transform duration-500">
                        <div class="w-full h-full flex items-center justify-center text-4xl">
                            📸
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 🛠️ SECTION ENGAGEMENTS & LIENS DE CONFIANCE -->
    <div id="engagements" class="bg-white py-6 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="flex items-center gap-4 p-4 rounded-xl hover:bg-gray-50 transition-colors">
                <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-full flex items-center justify-center text-xl shadow-sm">🛡️</div>
                <div>
                    <h4 class="font-bold text-gray-900 text-sm">Paiement Sécurisé</h4>
                    <p class="text-xs text-gray-500">Mobile Money (T-Money, Flooz) & Carte</p>
                </div>
            </div>
            <div class="flex items-center gap-4 p-4 rounded-xl hover:bg-gray-50 transition-colors">
                <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center text-xl shadow-sm">🚚</div>
                <div>
                    <h4 class="font-bold text-gray-900 text-sm">Livraison Rapide</h4>
                    <p class="text-xs text-gray-500">Partout à Lomé et à l'intérieur du Togo</p>
                </div>
            </div>
            <div class="flex items-center gap-4 p-4 rounded-xl hover:bg-gray-50 transition-colors">
                <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-full flex items-center justify-center text-xl shadow-sm">⭐</div>
                <div>
                    <h4 class="font-bold text-gray-900 text-sm">Vendeurs Vérifiés</h4>
                    <p class="text-xs text-gray-500">+5 000 boutiques locales authentifiées</p>
                </div>
            </div>
        </div>
    </div>

    <!-- 🗂️ SECTION TOUTES LES CATÉGORIES -->
    <div class="py-12 bg-gray-50/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-end mb-8">
                <div>
                    <h2 class="text-xl font-black text-gray-900">Toutes les Catégories</h2>
                    <p class="text-xs text-gray-500 mt-0.5">Explorez notre marché traditionnel et moderne togolais</p>
                </div>
                <a href="{{ route('products.index') }}" class="text-xs font-bold text-[#005c33] hover:underline">Voir tout &rarr;</a>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-4">
                @php
                    $categories = [
                        ['name' => 'Agriculture', 'slug' => 'agriculture', 'desc' => 'Vivres & Céréales', 'icon' => '🌿', 'bg' => 'bg-emerald-50 text-emerald-600'],
                        ['name' => 'Mode & Tissus', 'slug' => 'tissus', 'desc' => 'Pagne, Wax, Kente', 'icon' => '👕', 'bg' => 'bg-amber-50 text-amber-600'],
                        ['name' => 'Électronique', 'slug' => 'electronique', 'desc' => 'Phones & Gadgets', 'icon' => '📱', 'bg' => 'bg-blue-50 text-blue-600'],
                        ['name' => 'Artisanat', 'slug' => 'artisanat', 'desc' => 'Sculptures, Poterie', 'icon' => '🔨', 'bg' => 'bg-red-50 text-red-600'],
                        ['name' => 'Beauté & Santé', 'slug' => 'beaute', 'desc' => 'Soins Naturels', 'icon' => '💖', 'bg' => 'bg-pink-50 text-pink-600'],
                        ['name' => 'Maison & Déco', 'slug' => 'maison', 'desc' => 'Meubles, Nattes', 'icon' => '🏠', 'bg' => 'bg-indigo-50 text-indigo-600'],
                    ];
                @endphp

                @foreach($categories as $cat)
                    <a href="{{ route('products.index', ['category' => $cat['slug']]) }}" class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-all text-center group cursor-pointer block">
                        <div class="w-12 h-12 mx-auto mb-3 rounded-full flex items-center justify-center text-xl transition-transform group-hover:scale-110 {{ $cat['bg'] }}">
                            {{ $cat['icon'] }}
                        </div>
                        <h4 class="font-extrabold text-gray-900 text-sm tracking-tight">{{ $cat['name'] }}</h4>
                        <p class="text-[10px] text-gray-400 font-medium mt-0.5">{{ $cat['desc'] }}</p>
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <!-- ⚡ SECTION VENTES FLASH -->
    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-[#b91c1c] text-white px-6 py-4 rounded-t-2xl flex flex-wrap justify-between items-center gap-4 shadow-sm">
                <div class="flex items-center gap-3">
                    <span class="text-2xl animate-pulse">⚡</span>
                    <div>
                        <h3 class="text-lg font-black tracking-tight">Ventes Flash</h3>
                        <p class="text-xs text-white/80 font-medium">Offres limitées, dépêchez-vous !</p>
                    </div>
                </div>
                <div class="flex items-center gap-2 text-xs font-bold bg-black/20 px-3 py-1.5 rounded-lg">
                    <span>🕒 Fin dans</span>
                    <span class="bg-black text-white px-2 py-0.5 rounded font-mono text-sm">04</span> :
                    <span class="bg-black text-white px-2 py-0.5 rounded font-mono text-sm">21</span> :
                    <span class="bg-black text-white px-2 py-0.5 rounded font-mono text-sm">40</span>
                </div>
            </div>

            <div class="bg-white p-6 rounded-b-2xl border-x border-b border-gray-100 shadow-sm grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                <!-- Produit Flash 1 -->
                <div class="group relative bg-white rounded-xl border border-gray-100 p-3 hover:shadow-md transition-all flex flex-col justify-between">
                    <div>
                        <span class="absolute top-4 left-4 bg-red-600 text-white text-[10px] font-black px-2 py-0.5 rounded-md z-10">-60%</span>
                        <div class="aspect-[4/3] bg-gray-100 rounded-lg overflow-hidden mb-3 flex items-center justify-center text-3xl group-hover:scale-102 transition-transform">
                            📸
                        </div>
                        <h4 class="font-bold text-gray-800 text-sm line-clamp-1">Tissu Wax Hollandais</h4>
                        <div class="mt-1 flex items-baseline gap-2">
                            <span class="text-sm font-black text-red-600">8 900 FCFA</span>
                            <span class="text-xs text-gray-400 line-through">22 000 FCFA</span>
                        </div>
                    </div>
                    <div class="mt-4 space-y-1">
                        <div class="flex justify-between text-[10px] text-gray-500 font-bold">
                            <span>Vendu: 73/100</span>
                            <span>73%</span>
                        </div>
                        <div class="w-full h-1.5 bg-gray-100 rounded-full overflow-hidden">
                            <div class="h-full bg-red-600 rounded-full" style="width: 73%"></div>
                        </div>
                    </div>
                </div>

                <!-- Produit Flash 2 -->
                <div class="group relative bg-white rounded-xl border border-gray-100 p-3 hover:shadow-md transition-all flex flex-col justify-between">
                    <div>
                        <span class="absolute top-4 left-4 bg-red-600 text-white text-[10px] font-black px-2 py-0.5 rounded-md z-10">-35%</span>
                        <div class="aspect-[4/3] bg-gray-100 rounded-lg overflow-hidden mb-3 flex items-center justify-center text-3xl">
                            📱
                        </div>
                        <h4 class="font-bold text-gray-800 text-sm line-clamp-1">Smartphone ITEL A70</h4>
                        <div class="mt-1 flex items-baseline gap-2">
                            <span class="text-sm font-black text-red-600">42 000 FCFA</span>
                            <span class="text-xs text-gray-400 line-through">65 000 FCFA</span>
                        </div>
                    </div>
                    <div class="mt-4 space-y-1">
                        <div class="flex justify-between text-[10px] text-gray-500 font-bold">
                            <span>Vendu: 45/80</span>
                            <span>56%</span>
                        </div>
                        <div class="w-full h-1.5 bg-gray-100 rounded-full overflow-hidden">
                            <div class="h-full bg-amber-500 rounded-full" style="width: 56%"></div>
                        </div>
                    </div>
                </div>

                <!-- Produit Flash 3 -->
                <div class="group relative bg-white rounded-xl border border-gray-100 p-3 hover:shadow-md transition-all flex flex-col justify-between">
                    <div>
                        <span class="absolute top-4 left-4 bg-red-600 text-white text-[10px] font-black px-2 py-0.5 rounded-md z-10">-42%</span>
                        <div class="aspect-[4/3] bg-gray-100 rounded-lg overflow-hidden mb-3 flex items-center justify-center text-3xl">
                            🥥
                        </div>
                        <h4 class="font-bold text-gray-800 text-sm line-clamp-1">Huile de Coco Pure 1L</h4>
                        <div class="mt-1 flex items-baseline gap-2">
                            <span class="text-sm font-black text-red-600">3 500 FCFA</span>
                            <span class="text-xs text-gray-400 line-through">6 000 FCFA</span>
                        </div>
                    </div>
                    <div class="mt-4 space-y-1">
                        <div class="flex justify-between text-[10px] text-gray-500 font-bold">
                            <span>Vendu: 91/120</span>
                            <span>76%</span>
                        </div>
                        <div class="w-full h-1.5 bg-gray-100 rounded-full overflow-hidden">
                            <div class="h-full bg-red-600 rounded-full" style="width: 76%"></div>
                        </div>
                    </div>
                </div>

                <!-- Produit Flash 4 -->
                <div class="group relative bg-white rounded-xl border border-gray-100 p-3 hover:shadow-md transition-all flex flex-col justify-between">
                    <div>
                        <span class="absolute top-4 left-4 bg-red-600 text-white text-[10px] font-black px-2 py-0.5 rounded-md z-10">-45%</span>
                        <div class="aspect-[4/3] bg-gray-100 rounded-lg overflow-hidden mb-3 flex items-center justify-center text-3xl">
                            👜
                        </div>
                        <h4 class="font-bold text-gray-800 text-sm line-clamp-1">Sac Tissé Raphia Premium</h4>
                        <div class="mt-1 flex items-baseline gap-2">
                            <span class="text-sm font-black text-red-600">5 200 FCFA</span>
                            <span class="text-xs text-gray-400 line-through">9 500 FCFA</span>
                        </div>
                    </div>
                    <div class="mt-4 space-y-1">
                        <div class="flex justify-between text-[10px] text-gray-500 font-bold">
                            <span>Vendu: 38/60</span>
                            <span>63%</span>
                        </div>
                        <div class="w-full h-1.5 bg-gray-100 rounded-full overflow-hidden">
                            <div class="h-full bg-amber-500 rounded-full" style="width: 63%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 🛍️ SECTION PRODUITS POPULAIRES 🔥 -->
    <div class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Message de succès -->
            @if(session('success'))
                <div class="mb-6">
                    <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl font-bold text-xs flex items-center gap-2 shadow-sm">
                        ✅ {{ session('success') }}
                    </div>
                </div>
            @endif

            <!-- Titre et Filtres Catégories -->
            <div class="flex flex-wrap justify-between items-end gap-4 mb-8">
                <div>
                    <h2 class="text-xl font-black text-gray-900 flex items-center gap-1.5">Produits Populaires 🔥</h2>
                    <p class="text-xs text-gray-500 mt-0.5">Les meilleures ventes du moment sur la plateforme</p>
                </div>
                <div class="flex items-center gap-2 text-xs font-bold overflow-x-auto whitespace-nowrap pb-1">
                    <a href="{{ route('products.index') }}" class="px-4 py-2 {{ !request('category') ? 'bg-[#005c33] text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }} rounded-full shadow-sm">Tout</a>
                    <a href="{{ route('products.index', ['category' => 'tissus']) }}" class="px-4 py-2 {{ request('category') == 'tissus' ? 'bg-[#005c33] text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }} rounded-full transition-colors">Tissus</a>
                    <a href="{{ route('products.index', ['category' => 'agriculture']) }}" class="px-4 py-2 {{ request('category') == 'agriculture' ? 'bg-[#005c33] text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }} rounded-full transition-colors">Agriculture</a>
                    <a href="{{ route('products.index', ['category' => 'electronique']) }}" class="px-4 py-2 {{ request('category') == 'electronique' ? 'bg-[#005c33] text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }} rounded-full transition-colors">Électronique</a>
                    <a href="{{ route('products.index', ['category' => 'artisanat']) }}" class="px-4 py-2 {{ request('category') == 'artisanat' ? 'bg-[#005c33] text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }} rounded-full transition-colors">Artisanat</a>
                </div>
            </div>

            <!-- Grille Principale Dynamique -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                @forelse($products as $product)
                    <div class="bg-white rounded-2xl border border-gray-100 p-4 shadow-sm hover:shadow-md transition-all flex flex-col justify-between group relative">
                        <!-- Badge Bestseller -->
                        <div class="absolute top-6 left-6 flex flex-col gap-1 z-10">
                            <span class="bg-amber-500 text-gray-900 text-[9px] font-extrabold px-2 py-0.5 rounded">Bestseller</span>
                        </div>

                        <!-- Favoris -->
                        <form action="#" method="POST" class="absolute top-6 right-6 z-10" onclick="event.preventDefault(); alert('Fonctionnalité favoris bientôt disponible !')"></form>
                            @csrf
                            <button type="submit" class="w-8 h-8 bg-white/80 backdrop-blur rounded-full flex items-center justify-center text-xs shadow-sm hover:text-red-500 transition-colors">❤️</button>
                        </form>

                        <div>
                            <!-- Image du Produit -->
                            <a href="{{ route('products.show', $product->id) }}" class="aspect-square bg-gray-50 rounded-xl overflow-hidden mb-4 flex items-center justify-center text-4xl group-hover:scale-101 transition-transform relative block">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                @else
                                    📦
                                @endif
                            </a>

                            <!-- Badge de vérification -->
                            <span class="inline-flex items-center gap-1 text-[10px] font-bold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded mb-2">
                                ✓ Vérifié
                            </span>

                            <!-- Nom du Produit -->
                            <h3 class="font-extrabold text-gray-900 text-sm leading-tight tracking-tight line-clamp-2 min-h-[40px]">
                                <a href="{{ route('products.show', $product->id) }}" class="hover:text-[#005c33]">
                                    {{ $product->name }}
                                </a>
                            </h3>

                            <!-- Étoiles de notation -->
                            <div class="flex items-center gap-1 mt-1 text-xs">
                                <span class="text-amber-400">★★★★★</span>
                                <span class="text-gray-400 font-bold text-[10px]">(24)</span>
                            </div>

                            <!-- Prix -->
                            <div class="mt-3">
                                <p class="text-base font-black text-gray-900">
                                    {{ number_format($product->price, 0, ',', ' ') }} FCFA
                                    <span class="text-[10px] text-gray-400 font-bold">/ pièce</span>
                                </p>
                            </div>

                            <!-- Origine / Boutique -->
                            <p class="text-[10px] text-gray-400 font-bold flex items-center gap-1 mt-3">
                                📍 {{ $product->shop->name ?? 'Marché local' }} - Lomé
                            </p>
                        </div>

                        <!-- Bouton Ajouter au panier -->
                        <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mt-4">
                            @csrf
                            <button type="submit" class="w-full py-2.5 bg-[#e1a900] hover:bg-[#c99700] text-gray-900 font-bold text-xs rounded-xl shadow-sm transition-all flex items-center justify-center gap-2 tracking-wide uppercase">
                                🛒 Ajouter au panier
                            </button>
                        </form>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <p class="text-gray-500 font-medium">Aucun produit disponible pour le moment.</p>
                    </div>
                @endforelse
            </div>

            <!-- Bouton Charger plus sécurisé avec la pagination standard Laravel -->
            @if(method_exists($products, 'hasMorePages') && $products->hasMorePages())
                <div class="mt-12 text-center">
                    <a href="{{ $products->nextPageUrl() }}" class="inline-block px-6 py-2.5 border-2 border-[#005c33] text-[#005c33] hover:bg-[#005c33] hover:text-white font-bold text-xs uppercase tracking-widest rounded-xl transition-all shadow-sm">
                        Charger plus de produits
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
