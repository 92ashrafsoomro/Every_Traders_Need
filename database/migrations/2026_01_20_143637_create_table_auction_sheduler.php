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
        Schema::create('auction_scheduler', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->integer('auction_type')->nullable();
            $table->integer('platform')->nullable();
            $table->string('auction_name')->nullable();
            $table->timestamp('date')->nullable();
            $table->timestamp('pak_time')->nullable();
            $table->string('lots')->nullable();
            $table->string('scr_lots')->nullable();
            $table->string('status')->nullable();
            $table->string('assign_to')->nullable();
            $table->string('final_sheet')->nullable();
            $table->text('notes')->nullable();
            $table->integer('created_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('auction_scheduler');
    }
};
