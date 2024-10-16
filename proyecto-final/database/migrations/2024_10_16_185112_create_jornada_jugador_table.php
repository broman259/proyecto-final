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
        Schema::create('jornada_jugador', function (Blueprint $table) {
            $table->id();

            $table->foreignId('jornada_id')
                ->nullable()
                ->constrained('jornadas')
                ->cascadeOnUpdate()
                ->nullOnDelete();

            $table->foreignId('jugador_id')
                ->nullable()
                ->constrained('jugadores')
                ->cascadeOnUpdate()
                ->nullOnDelete();
            
            $table->double('puntos');
            $table->string('tipo_tiro');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jornada_jugador');
    }
};
