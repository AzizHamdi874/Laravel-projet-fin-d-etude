<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreditDemandesTable extends Migration
{
    public function up()
    {
        Schema::create('credit_demandes', function (Blueprint $table) {
            $table->id();
          /*  $table->unsignedBigInteger('user_id');*/
            $table->unsignedBigInteger('compte_id');
            $table->decimal('solde', 8, 3);
            $table->integer('duree_remboursement');
            $table->decimal('revenu_mensuel', 8, 3);
            $table->string('status')->default('en attente');
            $table->timestamps();

           /* $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');*/
            $table->foreign('compte_id')->references('id')->on('comptes')->onDelete('cascade');

        });
    }

    public function down()
    {
        Schema::dropIfExists('credit_demandes');
    }
}
