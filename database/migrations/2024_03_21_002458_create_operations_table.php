<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOperationsTable extends Migration
{
    public function up()
    {
        Schema::create('operations', function (Blueprint $table) {
            $table->id();
           /* $table->foreignId('user_id')->constrained()->onDelete('cascade');*/
            $table->foreignId('compte_id')->constrained()->onDelete('cascade');
            $table->string('type');
            $table->decimal('solde', 8, 3);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('operations');
    }
}
