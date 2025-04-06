<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('temporary_peminjams', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nis', 12)->nullable();
            $table->string('nip', 18)->nullable();
            $table->string('email');
            $table->string('no_telp', 15)->unique()->nullable();
            $table->string('password');
            $table->tinyInteger('status')->default(1)->comment('1 = aktif, 0 = nonaktif');
            $table->tinyInteger('role')->default(1)->comment('1 = siswa, 2 = guru');
            $table->string('kode_import');
            $table->timestamps();

            // Composite unique index for nis, nip, and email
            $table->unique(['nis', 'nip', 'email']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('temporary_peminjams');
    }
};
