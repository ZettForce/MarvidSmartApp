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
        Schema::create('configuracions', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_institucion');
            $table->text('direccion');
            $table->string('telefono');
            $table->string('correoElectronico');
            $table->string('web')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->text('logo');
            $table->string('divisa');
            $table->text('cctClave');
            $table->text(' incorporacionClave');
            $table->string('nombreDirector');
            $table->string('nombreSubdirector')->nullable();
            $table->string('nombreControlEscolar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('configuracions');
    }
};
