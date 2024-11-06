<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
          /*  $table->unsignedBigInteger('de_user_id');
            $table->unsignedBigInteger('a_user_id');*/
            $table->unsignedBigInteger('de_compte_id');
            $table->unsignedBigInteger('a_compte_id');
            $table->decimal('solde', 8, 3);
            $table->timestamps();
           /* $table->foreign('de_user_id')->references('id')->on('users');
            $table->foreign('a_user_id')->references('id')->on('users');*/
            $table->foreign('de_compte_id')->references('id')->on('comptes');
            $table->foreign('a_compte_id')->references('id')->on('comptes');
        });
    }
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
    
}
