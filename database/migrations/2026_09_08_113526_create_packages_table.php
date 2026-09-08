<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->string('featured_image', 500)->nullable();
            $table->integer('duration_days')->nullable();
            $table->string('max_altitude', 100)->nullable();
            $table->enum('difficulty_level', ['easy', 'moderate', 'difficult', 'extreme'])->nullable();
            $table->string('best_season')->nullable();
            $table->string('group_size', 100)->nullable();
            $table->string('starting_point')->nullable();
            $table->string('ending_point')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->string('price_note')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_fixed_departure')->default(false);
            $table->date('departure_date')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
