<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

//    création de la table profil
    public function up()
    {
        Schema::create('profil', function (Blueprint $table) {
            $table->id();  // Clé primaire
            $table->unsignedBigInteger('user_id');
            $table->string('prenom');
            $table->string('nom');
            $table->string('image')->nullable();
            $table->enum('statut', ['inactif', 'en attente', 'actif'])->default('en attente');  // Statut
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('profil');
    }
};
