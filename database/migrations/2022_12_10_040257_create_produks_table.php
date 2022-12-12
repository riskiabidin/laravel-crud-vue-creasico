<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produks', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('kode_produk')->unsigned();
            $table->unsignedBigInteger('id_category');
            $table->foreign('id_category')->references('id')->on('categories');
            // $table->integer('id_category')->unsigned();
            // $table->foreign('id_category')->references('id')->on('categories');
            $table->string('name_produk', 100);
            $table->string('merk', 50);
            $table->bigInteger('harga_beli')->unsigned();
            $table->bigInteger('harga_jual')->unsigned();
            $table->integer('stock')->unsigned();
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
        Schema::dropIfExists('produks');
    }
}
