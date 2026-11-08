<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Enregistrer votre Entreprise / Boutique') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">

                <p class="mb-6 text-gray-600 dark:text-gray-400">
                    Pour commencer à vendre sur notre plateforme de type Alibaba, vous devez configurer votre profil de fournisseur professionnel.
                </p>

                <form method="POST" action="{{ route('supplier.shop.store') }}">
                    @csrf

                    <div>
                        <x-input-label for="name" :value="__('Nom de la Boutique / Entreprise')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="company_register_number" :value="__('Numéro de Registre du Commerce (Siret / Tax ID)')" />
                        <x-text-input id="company_register_number" class="block mt-1 w-full" type="text" name="company_register_number" :value="old('company_register_number')" required />
                        <x-input-error :messages="$errors->get('company_register_number')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="country" :value="__('Pays d\'origine')" />
                        <select id="country" name="country" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 rounded-md shadow-sm" required>
                            <option value="">Sélectionnez un pays</option>
                            <option value="France">France</option>
                            <option value="Chine">Chine</option>
                            <option value="Togo">Togo</option>
                            <option value="Maroc">Maroc</option>
                            </select>
                        <x-input-error :messages="$errors->get('country')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="description" :value="__('Présentation de votre entreprise')" />
                        <textarea id="description" name="description" rows="4" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 rounded-md shadow-sm">{{ old('description') }}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-6">
                        <x-primary-button>
                            {{ __('Créer ma boutique B2B') }}
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
