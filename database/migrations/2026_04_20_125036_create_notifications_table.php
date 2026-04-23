<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('society_id');
            $table->unsignedBigInteger('complaint_id');
            $table->string('judul');
            $table->text('pesan');
            $table->string('status_laporan')->nullable();
            $table->boolean('is_read')->default(false);
            $table->timestamps();

            $table->foreign('society_id')->references('id')->on('society')->onDelete('cascade');
            $table->foreign('complaint_id')->references('id')->on('complaint')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};