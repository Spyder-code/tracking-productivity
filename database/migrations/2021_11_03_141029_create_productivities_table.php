<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productivities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('app_id')->constrained('applications');
            $table->foreignId('category_id')->constrained('categories');
            $table->foreignId('role_id')->constrained('roles');
            $table->integer('output')->default(0);
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
        Schema::dropIfExists('productivities');
    }
}
