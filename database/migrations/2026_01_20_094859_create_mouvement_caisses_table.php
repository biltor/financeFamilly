<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *  'caisse_id',
     * 'caisse_destination_id',
     *  'client_id',
     *  'type',
     *   'montant',
     *   'devise',
     *  'taux_change',
     *  'reference',
     *  'description',
     */
    public function up(): void
    {
        Schema::create('mouvement_caisses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('caisse_id')->constrained()->cascadeOnDelete();
            $table->enum('type', ['debit', 'credit']);
            $table->decimal('montant', 15, 2)->default(0);
            $table->enum('devise', ['DZD', 'EUR']);
            $table->string('description')->nullable();
            $table->date('date_mouv')->default(Date::now());
            $table->foreignId(column: 'exchange_id')->constrained()->nullable()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mouvement_caisses');
    }
};
