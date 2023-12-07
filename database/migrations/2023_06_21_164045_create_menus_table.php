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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->ulid('ulid')->unique();
            $table->bigInteger('category_id');
            $table->string('name');
            $table->string('slug');
            $table->longText('description')->nullable();
            $table->bigInteger('price')->unsigned();
            $table->boolean('status')->default(false);
            $table->boolean('featured')->default(false);
            $table->boolean('slider')->default(false);
            $table->boolean('has_extras')->default(false);
            $table->string('thumbnail')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
