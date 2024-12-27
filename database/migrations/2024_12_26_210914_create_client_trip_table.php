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
        Schema::create('client_trip', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Client::class);
            $table->foreignIdFor(\App\Models\Trip::class)->constrained()->onDelete('cascade');
            $table->integer('mese');
            $table->integer('anno');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_trip');
    }
};