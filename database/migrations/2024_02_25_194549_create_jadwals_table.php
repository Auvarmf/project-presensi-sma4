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
        Schema::create('jadwals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_mapel')->constrained('mata_pelajaran')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('id_kelas')->constrained('siswas')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('id_guru')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->enum('hari', ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat']);
            $table->time('waktu_mulai');
            $table->time('waktu_selesai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwals');
    }
};
