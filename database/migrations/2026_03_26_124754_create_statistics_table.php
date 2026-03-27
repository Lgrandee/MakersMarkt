// database/migrations/2025_01_01_000007_create_statistics_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('statistics', function (Blueprint $table) {
            $table->id('stat_id');
            $table->string('type'); // e.g., 'products_per_category', 'avg_rating_per_maker', 'popular_product_types'
            $table->json('value'); // store aggregated data as JSON
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('statistics');
    }
};
