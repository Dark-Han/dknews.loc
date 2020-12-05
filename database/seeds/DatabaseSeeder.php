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
        factory(App\Models\Disposition::class, 5)->create();
        factory(App\Models\Limit::class, 5)->create();
    }
}
