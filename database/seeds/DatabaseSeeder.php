<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdminsTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(BonusesTableSeeder::class);
        $this->call(EventsTableSeeder::class);
//        $this->call(MessagesTableSeeder::class);

        $this->call(ProductsTableSeeder::class);

        $this->call(OrdersTableSeeder::class);
        $this->call(SalesTableSeeder::class);



    }
}
