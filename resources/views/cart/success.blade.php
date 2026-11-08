<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Commande Réussie - Alibaba B2B</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 antialiased flex flex-col min-h-screen justify-center items-center p-4">

    <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-200 text-center max-w-md w-full">
        <div class="inline-flex items-center justify-center w-16 h-16 bg-green-100 text-green-600 rounded-full mb-4 text-3xl">
            ✓
        </div>
        <h1 class="text-2xl font-black text-gray-900">Commande envoyée !</h1>
        <p class="text-gray-500 text-sm mt-2">Votre demande de gros d'un montant estimé à <span class="font-bold text-orange-600">{{ number_format($totalGeneral, 2) }} €</span> a bien été transmise aux fournisseurs concernés.</p>

        <div class="mt-6 pt-6 border-t border-gray-100">
            <a href="{{ route('home') }}" class="block w-full py-2.5 bg-gray-900 hover:bg-gray-800 text-white font-bold text-sm rounded-lg transition-colors">
                Retourner à l'accueil
            </a>
        </div>
    </div>

</body>
</html>
