<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        if (!Schema::hasTable('complaint')) {
            Schema::create('complaint', function (Blueprint $table) {
                $table->id();
                $table->date('date_complaint');
                $table->string('nik');
                $table->longText('contents_of_the_report')->comment('Isi laporan');
                $table->string('photo')->nullable();
                $table->enum('status', ['0','process','finished','rejected'])->default('0');
                
                // Foreign key ke society
                $table->foreignId('society_id')
                      ->nullable()
                      ->constrained('society')
                      ->onDelete('cascade');
                
                $table->timestamps();

                // Index untuk performa query
                $table->index('nik');
                $table->index('society_id');
                $table->index('status');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaint');
    }
};