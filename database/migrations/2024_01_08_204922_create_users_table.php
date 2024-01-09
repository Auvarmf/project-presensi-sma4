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
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['mapel', 'jadwal', 'remember_token', 'email_verified_at']);

            $table->renameColumn('npm', 'nomor_induk');
            $table->enum('role', ['admin', 'guru', 'siswa']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');

            $table->renameColumn('nomor_induk', 'npm');

            $table->string('mapel')->nullable();
            $table->string('jadwal')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
        });
    }
};
