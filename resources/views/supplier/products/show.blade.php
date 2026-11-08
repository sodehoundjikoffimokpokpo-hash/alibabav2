<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $product->name }} - Alibaba B2B</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-900 antialiased">

    <nav class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="text-2xl font-black text-orange-500 tracking-wider">ALIBABA<span class="text-gray-800 font-normal">v2</span></a>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-6xl mx-auto px-4 py-12">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden grid grid-cols-1 md:grid-cols-2 gap-8 p-8">

            <div class="bg-gray-100 rounded-lg flex items-center justify-center h-96 text-gray-400 text-lg border border-gray-200">
                📦 Emplacement Image Produit
            </div>

            <div class="flex flex-col justify-between">
                <div>
                    <span class="text-xs font-bold text-orange-600 uppercase tracking-widest">Boutique : {{ $product->shop->name }}</span>
                    <h1 class="text-3xl font-bold text-gray-900 mt-2">{{ $product->name }}</h1>
                    <p class="text-sm text-gray-500 mt-1">Quantité minimale de commande (MOQ) : <span class="font-bold text-gray-800">{{ $product->moq }} pièces</span></p>

                    <hr class="my-6 border-gray-200">

                    <h3 class="text-sm font-bold text-gray-700 uppercase tracking-wider mb-3">Grille des tarifs de gros</h3>
                    <div class="grid grid-cols-3 gap-2 text-center bg-gray-50 p-4 rounded-lg border border-gray-100">
                        @foreach($product->wholesalePrices as $tier)
                            <div class="p-2 bg-white rounded shadow-sm border border-gray-200">
                                <p class="text-xs text-gray-500 font-semibold">
                                    ≥ {{ $tier->min_quantity }} pcs
                                </p>
                                <p class="text-lg font-black text-orange-600 mt-1">
                                    {{ $tier->price_per_unit }} €
                                </p>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-6">
                        <h3 class="text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">Description du produit</h3>
                        <p class="text-gray-600 text-sm leading-relaxed">{{ $product->description ?? 'Aucune description fournie par le vendeur.' }}</p>
                    </div>
                </div>

                <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mt-8 bg-orange-50 border border-orange-200 rounded-xl p-6">
                    @csrf
                    <h3 class="text-md font-bold text-gray-900 mb-4">Simuler ma commande de gros</h3>

                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-1/2">
                            <label class="block text-xs font-bold text-gray-700 mb-1">Quantité souhaitée :</label>
                            <input type="number" id="order-qty" name="quantity" value="{{ $product->moq }}" min="{{ $product->moq }}" max="{{ $product->stock }}" class="w-full border-gray-300 rounded-md shadow-sm focus:border-orange-500 focus:ring-orange-500 text-lg font-bold">
                        </div>
                        <div class="w-1/2">
                            <p class="text-xs font-bold text-gray-700 mb-1">Prix unitaire appliqué :</p>
                            <p class="text-2xl font-black text-gray-900"><span id="applied-price">0.00</span> €</p>
                        </div>
                    </div>

                    <div class="pt-4 border-t border-orange-200 flex justify-between items-center">
                        <div>
                            <p class="text-xs text-gray-500 font-medium">Estimation Total (Hors taxes) :</p>
                            <p class="text-3xl font-black text-orange-600"><span id="total-price">0.00</span> €</p>
                        </div>
                        <button type="submit" class="px-6 py-3 bg-orange-500 hover:bg-orange-600 text-white font-bold rounded-lg shadow transition-colors uppercase text-xs tracking-wider">
                            Ajouter au Panier B2B
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </main>

    <script>
        // On convertit les paliers PHP en tableau JavaScript exploitable
        const priceTiers = @json($product->wholesalePrices);
        const qtyInput = document.getElementById('order-qty');
        const appliedPriceSpan = document.getElementById('applied-price');
        const totalPriceSpan = document.getElementById('total-price');

        function calculatePrice() {
            let qty = parseInt(qtyInput.value) || 0;
            let unitPrice = 0;

            // Par défaut, on prend le premier palier (le plus cher)
            if(priceTiers.length > 0) {
                unitPrice = priceTiers[0].price_per_unit;
            }

            // On cherche si la quantité entrée atteint un palier supérieur plus avantageux
            priceTiers.forEach(tier => {
                if (qty >= tier.min_quantity) {
                    unitPrice = tier.price_per_unit;
                }
            });

            // Mise à jour de l'affichage HTML
            appliedPriceSpan.textContent = parseFloat(unitPrice).toFixed(2);
            totalPriceSpan.textContent = (qty * unitPrice).toFixed(2);
        }

        // Écouteurs d'événements pour recalculer en temps réel
        qtyInput.addEventListener('input', calculatePrice);
        qtyInput.addEventListener('change', calculatePrice);

        // Initialisation au chargement de la page
        calculatePrice();
    </script>
</body>
</html>
