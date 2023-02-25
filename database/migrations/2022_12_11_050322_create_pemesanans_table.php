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
        Schema::create('pemesanans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hotel_id')->nullable(); // buat field yg namanya "hotel_id" dirujukkan ke tabel hotels
            $table->foreign('hotel_id')->references('id')->on('hotels'); // jadikan sebagai foreign key, ambil rujukanny dr tabel kotas (PK => id)
            $table->string('nama_pemesan');
            $table->string('email_pemesan');
            $table->string('telp_pemesan');
            $table->string('tipe_kamar');
            $table->string('metode_pembayaran');
            $table->integer('total_harga');
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
        Schema::dropIfExists('pemesanans');
    }
};
