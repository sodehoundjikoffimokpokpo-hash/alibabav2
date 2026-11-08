<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight">
            Espace Fournisseur : {{ $shop->name ?? 'Ma Boutique' }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl font-medium flex items-center gap-2 shadow-sm text-sm">
                    ✅ {{ session('success') }}
                </div>
            @endif

            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
                <h2 class="text-xl font-black text-gray-900 mb-2">
                    Bienvenue dans votre gestionnaire de vente en gros !
                </h2>
                <p class="text-sm text-gray-500 mb-6 flex items-center gap-1.5">
                    Statut de vérification :
                    <span class="font-semibold text-amber-600 inline-flex items-center gap-1">
                        ⏳ En attente de vérification administrative
                    </span>
                </p>

                <div class="flex flex-wrap gap-4">
                    <a href="#" class="inline-flex items-center gap-2 px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-lg text-xs uppercase tracking-wider shadow transition-all">
                        📦 Gérer mes produits
                    </a>
                    <a href="#" class="inline-flex items-center gap-2 px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-lg text-xs uppercase tracking-wider shadow transition-all">
                        + Ajouter un produit de gros
                    </a>
                </div>
            </div>

            <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-gray-100 bg-white">
                    <h3 class="text-lg font-extrabold text-gray-900">📦 Commandes de gros reçues</h3>
                    <p class="text-xs text-gray-500 mt-0.5">Suivez et traitez les demandes d'achats de vos clients grossistes.</p>
                </div>

                @if($orders->isEmpty())
                    <div class="p-12 text-center text-gray-400 font-medium">
                        🍃 Aucune commande n'a encore été reçue pour le moment.
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-50 text-xs font-bold text-gray-500 uppercase tracking-wider border-b border-gray-100">
                                    <th class="p-4">ID Commande</th>
                                    <th class="p-4">Client / Acheteur</th>
                                    <th class="p-4">Articles commandés</th>
                                    <th class="p-4">Montant Total</th>
                                    <th class="p-4">Statut</th>
                                    <th class="p-4 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 text-sm">
                                @foreach($orders as $order)
                                    <tr class="hover:bg-gray-50/40 transition-colors">
                                        <td class="p-4 font-bold text-gray-700">#{{ $order->id }}</td>

                                        <td class="p-4">
                                            <span class="font-semibold text-gray-900">{{ $order->user->name ?? 'Acheteur Anonyme' }}</span>
                                            <p class="text-xs text-gray-400">{{ $order->user->email ?? '' }}</p>
                                        </td>

                                        <td class="p-4">
                                            <div class="space-y-1">
                                                @foreach($order->items as $item)
                                                    <p class="text-xs text-gray-600">
                                                        <span class="font-bold text-gray-800 bg-gray-100 px-1.5 py-0.5 rounded">{{ $item->quantity }}x</span>
                                                        {{ $item->product_name }}
                                                        <span class="text-gray-400">({{ number_format($item->price_per_unit, 2) }} €/u)</span>
                                                    </p>
                                                @endforeach
                                            </div>
                                        </td>

                                        <td class="p-4 font-black text-orange-600 text-base">
                                            {{ number_format($order->total_amount, 2) }} €
                                        </td>

                                        <td class="p-4">
                                            @if($order->status == 'en_attente')
                                                <span class="px-2.5 py-1 text-xs font-bold bg-amber-50 text-amber-700 rounded-full border border-amber-200">En attente</span>
                                            @elseif($order->status == 'valide')
                                                <span class="px-2.5 py-1 text-xs font-bold bg-blue-50 text-blue-700 rounded-full border border-blue-200">Validée</span>
                                            @elseif($order->status == 'expedie')
                                                <span class="px-2.5 py-1 text-xs font-bold bg-green-50 text-green-700 rounded-full border border-green-200">Expédiée</span>
                                            @else
                                                <span class="px-2.5 py-1 text-xs font-bold bg-red-50 text-red-700 rounded-full border border-red-200">Annulée</span>
                                            @endif
                                        </td>

                                        <td class="p-4 text-right">
                                            <form action="{{ route('supplier.orders.updateStatus', $order->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                <select name="status" onchange="this.form.submit()" class="text-xs font-bold bg-white border border-gray-200 rounded-lg p-1.5 text-gray-700 focus:border-orange-500 focus:ring-1 focus:ring-orange-200 focus:outline-none cursor-pointer shadow-sm">
                                                    <option value="en_attente" {{ $order->status == 'en_attente' ? 'selected' : '' }}>⏳ En attente</option>
                                                    <option value="valide" {{ $order->status == 'valide' ? 'selected' : '' }}>✅ Valider</option>
                                                    <option value="expedie" {{ $order->status == 'expedie' ? 'selected' : '' }}>🚚 Expédiée</option>
                                                    <option value="annule" {{ $order->status == 'annule' ? 'selected' : '' }}>❌ Annuler</option>
                                                </select>
                                            </form>
                                        </td>
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
