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
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_admin')->constrained('admins')->onDelete('set null');
            $table->string('nama');
            $table->string('merk')->nullable();
            $table->string('spesifikasi')->nullable();
            $table->foreignId('id_kategori')->constrained('kategoris')->onDelete('set null');
            $table->date('tanggal_masuk');
            $table->string('sumber_masuk')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};
