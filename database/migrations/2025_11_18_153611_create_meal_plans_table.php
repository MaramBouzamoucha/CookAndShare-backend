<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::table('meal_plans', function (Blueprint $table) {
        $table->foreignId('recipe_id')->nullable()->constrained()->onDelete('cascade');
        $table->string('meal_type')->nullable(); // ou required selon besoin

        $table->string('day')->nullable();
    });
}

public function down(): void
{
    Schema::table('meal_plans', function (Blueprint $table) {
        $table->dropForeign(['recipe_id']);
        $table->dropColumn(['recipe_id', 'meal_type', 'day']);
    });
}

};
