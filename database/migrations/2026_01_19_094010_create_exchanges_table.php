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
        Schema::create('exchanges', function (Blueprint $table) {
            $table->id();
            $table->enum('type_operation', ['exchange', 'transfert']);
            $table->foreignId('caisse_src_id')->constrained('caisses')->cascadeOnDelete();
            $table->decimal('montant', 15, 2);
            $table->enum('currency_src', ['DZD', 'EUR'])->default('DZD');
            $table->decimal('taux', 15, 2); //taux de change
            $table->enum('currency_dest', ['DZD', 'EUR'])->default('DZD');
            $table->date('date_change');
            $table->foreignId('caisse_dest_id')->constrained('caisses')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exchanges');
    }
};
