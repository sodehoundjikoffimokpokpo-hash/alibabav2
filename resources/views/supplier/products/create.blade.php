<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Ajouter un nouveau produit (Vente en gros)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form method="POST" action="{{ route('supplier.supplier.products.store') }}">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="md:col-span-2">
                            <x-input-label for="name" :value="__('Nom du produit')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" required />
                        </div>
                        <div>
                            <x-input-label for="moq" :value="__('Quantité Minimum (MOQ)')" />
                            <x-text-input id="moq" class="block mt-1 w-full" type="number" name="moq" value="1" min="1" required />
                        </div>
                    </div>

                    <div class="mt-4">
                        <x-input-label for="stock" :value="__('Stock total disponible')" />
                        <x-text-input id="stock" class="block mt-1 w-full" type="number" name="stock" value="1000" required />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="description" :value="__('Description détaillée')" />
                        <textarea id="description" name="description" rows="4" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 rounded-md shadow-sm"></textarea>
                    </div>

                    <hr class="my-6 border-gray-200 dark:border-gray-700">

                    <div>
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-2">Paliers de prix dégressifs (B2B)</h3>
                        <p class="text-sm text-gray-500 mb-4">Définissez vos prix selon les quantités. Exemple : À partir de 50 unités -> 10€ / unité.</p>

                        <div id="price-tiers-container" class="space-y-3">
                            <div class="flex gap-4 items-center price-tier-row">
                                <div class="w-1/2">
                                    <label class="block text-xs text-gray-500">À partir de (Quantité min)</label>
                                    <input type="number" name="quantities[]" placeholder="Ex: 50" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm" required>
                                </div>
                                <div class="w-1/2">
                                    <label class="block text-xs text-gray-500">Prix unitaire (€)</label>
                                    <input type="number" step="0.01" name="prices[]" placeholder="Ex: 12.50" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm" required>
                                </div>
                                <div class="pt-5">
                                    <button type="button" class="text-red-500 hover:text-red-700 remove-tier-btn">✕</button>
                                </div>
                            </div>
                        </div>

                        <button type="button" id="add-tier-btn" class="mt-4 inline-flex items-center text-sm font-semibold text-indigo-600 hover:text-indigo-500">
                            + Ajouter un palier de prix
                        </button>
                    </div>

                    <div class="flex items-center justify-end mt-6">
                        <x-primary-button>
                            {{ __('Mettre le produit en gros en vente') }}
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script>
        document.getElementById('add-tier-btn').addEventListener('click', function() {
            const container = document.getElementById('price-tiers-container');
            const newRow = document.querySelector('.price-tier-row').cloneNode(true);
            newRow.querySelectorAll('input').forEach(input => input.value = '');
            newRow.querySelector('.remove-tier-btn').addEventListener('click', function() {
                if(document.querySelectorAll('.price-tier-row').length > 1) { newRow.remove(); }
            });
            container.appendChild(newRow);
        });

        document.querySelectorAll('.remove-tier-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                if(document.querySelectorAll('.price-tier-row').length > 1) {
                    e.target.closest('.price-tier-row').remove();
                }
            });
        });
    </script>
</x-app-layout>
