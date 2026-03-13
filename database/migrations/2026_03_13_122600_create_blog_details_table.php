<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('blog_details', function (Blueprint $class) {
            $class->id();
            $class->foreignId('blog_id')
                  ->constrained('blogs') 
                  ->onDelete('cascade'); 
            
            $class->string('title')->nullable();
            $class->longText('description')->nullable();
            $class->string('image')->nullable();
            $class->string('preview_image')->nullable();
            $class->string('alignment')->default('left'); 
            
            $class->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_details');
    }
};