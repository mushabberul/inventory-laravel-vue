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
        Schema::create('system_settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_name');
            $table->string('site_logo')->nullable();
            $table->string('site_favicon')->nullable();
            $table->string('phone');
            $table->string('email');
            $table->string('address');
            $table->string('facebook_url');
            $table->string('meta_keywords');
            $table->text('meta_description');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('system_settings');
    }
};
