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
        Schema::create('bungas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_bunga')->nullable();                   
            $table->enum('jenis_bunga', ['segar', 'hias', 'kering', 'bouquet'])->nullable();                                     
            $table->bigInteger('stok')->nullable();                     
            $table->decimal('harga_satuan', 12, 2)->nullable();                                       
            $table->text('deskripsi')->nullable();                     
            $table->string('image')->nullable();                   
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bungas');
    }
};
