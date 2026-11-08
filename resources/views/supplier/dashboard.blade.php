<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Espace Fournisseur : ') }} {{ Auth::user()->shop->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-6 p-4 bg-green-100 text-green-800 rounded-lg shadow font-medium">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900 dark:text-gray-100">
                <h3 class="text-lg font-bold">Bienvenue dans votre gestionnaire de vente en gros !</h3>
                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                    Statut de vérification :
                    @if(Auth::user()->shop->is_verified)
                        <span class="text-green-500 font-bold">✓ Vérifié (Approuvé pour le B2B)</span>
                    @else
                        <span class="text-amber-500 font-bold">⏳ En attente de vérification administrative</span>
                    @endif
                </p>

                <hr class="my-6 border-gray-200 dark:border-gray-700">

                <h4 class="text-md font-semibold mb-3 text-gray-700 dark:text-gray-300">Gestion de votre catalogue Alibaba B2B :</h4>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('supplier.products.index') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 transition ease-in-out duration-155">
                        📦 Gérer mes produits
                    </a>

                    <a href="{{ route('supplier.products.create') }}" class="inline-flex items-center px-4 py-2 bg-emerald-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-emerald-700 focus:bg-emerald-700 active:bg-emerald-900 transition ease-in-out duration-155">
                        ＋ Ajouter un produit de gros
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
