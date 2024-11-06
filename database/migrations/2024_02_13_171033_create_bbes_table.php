<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBbesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bbes', function (Blueprint $table) {
            $table->id();
            $table->string('designation');
            $table->string('code');
            $table->float('unite', 10, 3);
            $table->float('achat', 10, 3);
            $table->float('vente', 10, 3);
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bbes');
    }
}
