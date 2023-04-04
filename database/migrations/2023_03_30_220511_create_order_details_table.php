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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->string('r_sphere', 50)->nullable(true); 
            $table->string('r_cylinder', 50)->nullable(true);
            $table->string('r_axis', 50)->nullable(true);
            $table->string('l_sphere', 50)->nullable(true);
            $table->string('l_cylinder', 50)->nullable(true);
            $table->string('l_axis', 50)->nullable(true);
            $table->bigInteger('count')->nullable(false)->default(1); 
            $table->boolean('revision')->nullable(false)->default(false);
            $table->text('details')->nullable(false); 
            $table->timestamps();
            //FK
            $table->foreignId('order_id')->nullable(false)->references('id')->on('orders'); 
            $table->foreignId('frame_id')->nullable(false)->references('id')->on('frames'); 
            $table->foreignId('lens_id')->nullable(false)->references('id')->on('lenses'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
