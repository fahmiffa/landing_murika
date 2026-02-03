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
        Schema::create('candidates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('career_id')->constrained()->onDelete('cascade');
            $table->string('nama_kandidat');
            $table->string('recruiter')->nullable();
            $table->string('position');
            $table->string('education');
            $table->string('phone');
            $table->string('email');
            $table->text('address');
            $table->date('application_date');
            $table->text('planning_jangka_panjang')->nullable();
            $table->text('planning_jangka_dekat')->nullable();
            $table->enum('mau_ppg', ['ya', 'tidak'])->default('tidak');
            $table->text('alasan_tidak_diizinkan_ortu')->nullable();
            $table->text('pengalaman_kerja')->nullable();
            $table->text('alasan_tidak_mau_kontrak')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidates');
    }
};
