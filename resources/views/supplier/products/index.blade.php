<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Mon Catalogue de Produits') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">

                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">Tous vos articles en vente</h3>
                    <a href="{{ route('supplier.products.create') }}" class="inline-flex items-center px-4 py-2 bg-emerald-600 text-white rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-emerald-700">
                        ＋ Ajouter un produit
                    </a>
                </div>

                @if($products->isEmpty())
                    <p class="text-gray-500 text-center py-4">Vous n'avez pas encore publié de produit.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-700 text-xs font-bold uppercase text-gray-500 dark:text-gray-400">
                                    <th class="p-3">Nom</th>
                                    <th class="p-3">MOQ (Min)</th>
                                    <th class="p-3">Stock</th>
                                    <th class="p-3">Paliers de prix</th>
                                    <th class="p-3">Date</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm divide-y divide-gray-200 dark:divide-gray-700 text-gray-700 dark:text-gray-300">
                                @foreach($products as $product)
                                    <tr>
                                        <td class="p-3 font-semibold text-gray-900 dark:text-white">{{ $product->name }}</td>
                                        <td class="p-3">{{ $product->moq }} pièces</td>
                                        <td class="p-3">{{ $product->stock }}</td>
                                        <td class="p-3">
                                            <div class="flex flex-wrap gap-1">
                                                @foreach($product->wholesalePrices as $price)
                                                    <span class="inline-block bg-orange-100 text-orange-800 text-xs px-2 py-0.5 rounded font-medium">
                                                        ≥{{ $price->min_quantity }} u : {{ $price->price_per_unit }}€
                                                    </span>
                                                @endforeach
                                            </div>
                                        </td>
                                        <td class="p-3 text-xs text-gray-500">{{ $product->created_at->format('d/m/Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
