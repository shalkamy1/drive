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
        Schema::create('drives', function (Blueprint $table) {
            $table->id();
            $table->string('title',200);
            $table->string('description',400)->nullable();
            $table->string('file',1000)->nullable();
            $table->string('file_ext',10)->nullable();
            $table->text('statues')->default('private');
            $table->foreignId('Category_id')->references("id")->on("categoreis");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drives');
    }
};
