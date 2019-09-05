<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePegawai extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('users', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->string('nama');
      $table->string('username');
      $table->string('password');
      $table->string('remember_token')->nullable();
      $table->timestamps();
    });

    Schema::create('pegawai', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->uuid('uuid');
      $table->string('nama');
      $table->bigInteger('nip_lama')->nullable();
      $table->bigInteger('nip_baru')->nullable();
      $table->tinyInteger('jenis_kelamin')->default('1');
      $table->string('instansi')->nullable();
      $table->string('jabatan')->nullable();
      $table->string('golongan')->nullable();
      $table->text('alamat')->nullable();
      $table->string('telp')->nullable();
      $table->string('foto')->nullable();
      $table->string('status',10)->default('aktif')->nullable();
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
    Schema::dropIfExists('pegawai');
  }
}
