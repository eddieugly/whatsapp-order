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
        Schema::create('generals', function (Blueprint $table) {
            $table->id();
            $table->ulid('ulid')->unique();
            $table->string('company_name');
            $table->string('company_tagline');
            $table->string('company_abbrevation');
            $table->longText('company_description');
            $table->string('company_phone');
            $table->string('company_email')->unique();
            $table->string('company_address');
            $table->longText('company_seo_description');
            $table->json('company_seo_keywords');
            $table->string('company_logo_white');
            $table->string('company_logo_dark');
            $table->string('company_favicon');
            $table->string('company_footer_text');
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instagram')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('generals');
    }
};
