<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UsersTableSeeder::class,
            ProductsTableSeeder::class,
            OrdersTableSeeder::class,
            ReviewsTableSeeder::class,
            NotificationsTableSeeder::class,
            ReportsTableSeeder::class,
            StatisticsTableSeeder::class,
        ]);
    }
}
