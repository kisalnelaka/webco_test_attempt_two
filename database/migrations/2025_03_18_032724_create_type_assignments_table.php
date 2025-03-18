<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('type_assignments', function (Blueprint $table) {
            $table->id();
            $table->string('type_assignments_type', 255)->notNullable();
            $table->integer('type_assignments_id')->notNullable();
            $table->string('my_bonus_field', 255)->notNullable();
            $table->foreignId('type_id')->constrained('product_types')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->foreignId('product_category_id')->constrained('product_categories')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('type_assignments');
    }
};