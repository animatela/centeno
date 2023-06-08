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
        Schema::create('workshop_vehicles', static function (Blueprint $table) {
            $table->id();
            $table->foreignId('workshop_maker_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('workshop_customer_id')->nullable()->constrained()->nullOnDelete();
            $table->string('name');
            $table->string('type')->nullable();
            $table->string('model')->nullable();
            $table->integer('year')->nullable();
            $table->string('color')->nullable();
            $table->string('fuel_type')->nullable();
            $table->float('engine_size')->nullable();
            $table->string('transmission_type')->nullable();
            $table->string('vin')->unique()->nullable();
            $table->string('plate')->nullable();
            $table->unsignedBigInteger('mileage')->default(0);
            $table->boolean('is_visible')->default(false);
            $table->string('seo_title', 60)->nullable();
            $table->string('seo_description', 160)->nullable();
            $table->integer('sort')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workshop_vehicles');
    }
};
