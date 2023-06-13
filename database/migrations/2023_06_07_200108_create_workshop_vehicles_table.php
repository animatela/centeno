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
            $table->foreignId('workshop_customer_id')->nullable()->constrained()->nullOnDelete();
            $table->string('name');
            $table->string('body_type')->nullable();
            $table->string('maker')->nullable();
            $table->string('model')->nullable();
            $table->integer('year')->nullable();
            $table->string('color')->nullable();
            $table->enum('fuel_type', ['diesel', 'gasoline', 'glp', 'gnv', 'dual', 'electric'])->nullable();
            $table->enum('transmission_type', ['mt', 'at'])->nullable();
            $table->string('plate')->nullable();
            $table->unsignedBigInteger('mileage')->default(0);
            $table->boolean('is_visible')->default(false);
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
