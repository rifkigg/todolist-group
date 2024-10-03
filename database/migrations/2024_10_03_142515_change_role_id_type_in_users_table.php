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
            $table->dropColumn('role'); // Hapus kolom 'role' terlebih dahulu
            $table->foreignId('role_id')->nullable()->constrained('roles')->onDelete('set null'); // Tambahkan kolom 'role_id'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role'); // Kembalikan kolom 'role'
            $table->dropForeign(['role_id']); // Hapus foreign key jika ada
            $table->dropColumn('role_id'); // Hapus kolom 'role_id'
        });
    }
};
