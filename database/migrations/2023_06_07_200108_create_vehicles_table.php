<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vehicles', static function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->nullable()->constrained()->nullOnDelete();
            $table->string('name');
            $table->string('body_type')->nullable();
            $table->string('maker')->nullable();
            $table->string('model')->nullable();
            $table->string('color')->nullable();
            $table->integer('year')->nullable();
            $table->enum('fuel_type', ['diesel', 'gasoline', 'lpg', 'ngv', 'dual', 'electric'])->nullable();
            $table->enum('transmission_type', ['at', 'mt'])->nullable();
            $table->string('plate')->unique()->nullable();
            $table->unsignedBigInteger('mileage')->default(0);
            $table->integer('sort')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
