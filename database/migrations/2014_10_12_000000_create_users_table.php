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
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // primary key yg bernama / fieldnya diberi nama "id", tipenya big integer dan autoincrements
            $table->string('name'); // tipenya adalah varchar default length 255, nama fieldnya adalah "name"
            $table->string('email')->unique(); // tipenya adalah varchar default length 255, nama fieldnya adalah "email" dan UNIQUE
            $table->timestamp('email_verified_at')->nullable(); // tipenya adalah timestamp, nama fieldnya adalah "email_verified_at" dan BOLEH NULL
            $table->string('password'); // tipenya adalah varchar default length 255, nama fieldnya adalah "password"
            $table->enum('role', ['Adm','Ksr'] ); // tipenya adalah enum, value pilihannya adalah Adm dan Ksr
            $table->rememberToken(); // tipenya adalah varchar default length 100, nama fieldnya adalah "remember_token"
            $table->timestamps(); // membuat field created_at dan updated_at yg tipenya timestamp
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
