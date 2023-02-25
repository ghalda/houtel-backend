<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotels', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kota_id')->nullable(); // buat field yg namanya "kota_id" dirujukkan ke tabel kotas
            $table->foreign('kota_id')->references('id')->on('kotas'); // jadikan sebagai foreign key, ambil rujukanny dr tabel kotas (PK => id)
            $table->string('nama_hotel');
            $table->string('gambar')->nullable();
            $table->integer('harga');
            $table->text('alamat')->nullable();
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
        Schema::dropIfExists('hotels');
    }
};
