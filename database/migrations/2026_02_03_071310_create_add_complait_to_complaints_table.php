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
        if (Schema::hasTable('complaint')) {
            Schema::table('complaint', function (Blueprint $table) {
                if (!Schema::hasColumn('complaint', 'victim_type')) {
                    $table->enum('victim_type', ['self', 'other'])->default('self')->after('id');
                }
                
                if (!Schema::hasColumn('complaint', 'jenis_kekerasan')) {
                    $table->enum('jenis_kekerasan', ['fisik', 'psikis', 'seksual', 'ekonomi', 'penelantaran'])
                        ->nullable()->after('victim_type');
                }
                
                if (!Schema::hasColumn('complaint', 'nama_korban')) {
                    $table->string('nama_korban', 100)->nullable()->after('jenis_kekerasan');
                }
                
                if (!Schema::hasColumn('complaint', 'usia_korban')) {
                    $table->integer('usia_korban')->nullable()->after('nama_korban');
                }
                
                if (!Schema::hasColumn('complaint', 'jenis_kelamin_korban')) {
                    $table->enum('jenis_kelamin_korban', ['perempuan', 'laki-laki'])->nullable()->after('usia_korban');
                }
                
                if (!Schema::hasColumn('complaint', 'alamat_korban_tinggal')) {
                    $table->text('alamat_korban_tinggal')->nullable()->after('jenis_kelamin_korban')
                          ->comment('Alamat tempat tinggal korban');
                }
                
                if (!Schema::hasColumn('complaint', 'alamat_korban')) {
                    $table->text('alamat_korban')->nullable()->after('alamat_korban_tinggal')
                          ->comment('Alamat lokasi kejadian');
                }
                
                if (!Schema::hasColumn('complaint', 'waktu_kejadian')) {
                    $table->dateTime('waktu_kejadian')->nullable()->after('alamat_korban');
                }
                
                if (!Schema::hasColumn('complaint', 'nomor_korban')) {
                    $table->string('nomor_korban', 13)->nullable()->after('waktu_kejadian');
                }
                
                if (!Schema::hasColumn('complaint', 'nik_korban')) {
                    $table->string('nik_korban', 20)->nullable()->after('nomor_korban');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('complaint')) {
            Schema::table('complaint', function (Blueprint $table) {
                $columns = [
                    'victim_type',
                    'jenis_kekerasan',
                    'nama_korban',
                    'usia_korban',
                    'jenis_kelamin_korban',
                    'alamat_korban_tinggal',
                    'alamat_korban',
                    'waktu_kejadian',
                    'nomor_korban',
                    'nik_korban'
                ];
                
                foreach ($columns as $column) {
                    if (Schema::hasColumn('complaint', $column)) {
                        $table->dropColumn($column);
                    }
                }
            });
        }
    }
};