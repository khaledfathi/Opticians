<?php

use Brick\Math\BigInteger;
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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->date('date')->nullable(false); 
            $table->time('time')->nullable(false); 
            $table->date('delivery_date')->nullable(true); 
            $table->text('image')->nullable(true);
            $table->enum('type',['صيانة' , 'تصنيع'])->nullable(true);
            $table->bigInteger('works_count')->nullable(false); 
            $table->BigInteger('required_revision_count')->nullable(false);
            $table->text('details')->nullable(true); 
            $table->timestamps();
            //FK
            $table->foreignId('customer_id')->nullable(false)->references('id')->on('customers'); 
            $table->foreignId('user_id')->nullable(true)->references('id')->on('users')->onDelete('set null'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
