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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name',200)->nullable(false);
            $table->string('phone',200)->nullable(false)->unique(); 
            $table->string('address' , 255)->nullable(true); 
            $table->text('details')->nullable(true); 
            $table->timestamps();
            //FK
            $table->foreignId('user_id')->nullable(true)->references('id')->on('users')->onDelete('set null'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
