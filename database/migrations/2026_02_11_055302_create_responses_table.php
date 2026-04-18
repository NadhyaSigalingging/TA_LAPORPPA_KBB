<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('responses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('complaint_id');
            $table->unsignedBigInteger('admin_id');
            $table->text('response')->nullable();
            $table->string('bukti')->nullable();

            $table->timestamps();
            $table->foreign('complaint_id')
                  ->references('id')
                  ->on('complaint')
                  ->onDelete('cascade');
            $table->foreign('admin_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('responses');
    }
};
