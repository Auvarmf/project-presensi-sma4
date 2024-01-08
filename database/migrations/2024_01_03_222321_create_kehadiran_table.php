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
        Schema::create('kehadiran', function (Blueprint $table) {
            $table->id();
            $table->string('nisn');
            $table->enum('keterangan_hadir', ['Tidak Hadir', 'Hadir'])->nullable();
            $table->timestamp('waktu_kehadiran')->nullable();
            $table->timestamps();

            // Set foreign key constraint
            $table->foreign('nisn')->references('nisn')->on('siswa');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kehadiran');
    }
};
