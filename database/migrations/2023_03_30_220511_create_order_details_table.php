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
            $table->float('r_sphere')->nullable(true); 
            $table->float('r_cylinder')->nullable(true);
            $table->float('r_axis')->nullable(true);
            $table->float('r_add')->nullable(true);
            $table->float('l_sphere')->nullable(true);
            $table->float('l_cylinder')->nullable(true);
            $table->float('l_axis')->nullable(true);
            $table->float('l_add')->nullable(true);
            $table->bigInteger('count')->nullable(false)->default(1); 
            $table->text('image')->nullable(true); 
            $table->boolean('revision')->nullable(false)->default(false);
            $table->text('details')->nullable(true); 
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
