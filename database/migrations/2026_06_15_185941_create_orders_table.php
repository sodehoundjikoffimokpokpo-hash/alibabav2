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
    Schema::create('orders', function (Blueprint $table) {
        $table->id();
        // Optionnel : relié à l'utilisateur connecté s'il y a un acheteur authentifié
        $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
        $table->decimal('total_amount', 10, 2);
        $table->string('status')->default('en_attente'); // en_attente, valide, expedie, annule
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
