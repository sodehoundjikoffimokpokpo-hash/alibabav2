<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('shops', function (Blueprint $table) {
        $table->id();
        // Clé étrangère liée à la table users (le propriétaire de la boutique)
        // Si l'utilisateur est supprimé, sa boutique l'est aussi (cascade)
        $table->foreignId('user_id')->constrained()->onDelete('cascade');

        $table->string('name')->unique();
        $table->string('slug')->unique(); // Pour des URLs propres (ex: mon-site.com/shop/nom-de-la-boutique)
        $table->text('description')->nullable();
        $table->string('company_register_number')->nullable(); // Numéro SIRET / Registre du commerce (Crucial pour le B2B)
        $table->string('country')->nullable(); // Alibaba classe beaucoup par pays d'origine
        $table->string('logo')->nullable();
        $table->boolean('is_verified')->default(false); // Permet à l'admin de valider l'entreprise
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shops');
    }
};
