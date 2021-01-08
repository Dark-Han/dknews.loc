<?php

use App\Models\JournalType;
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
        factory(App\Models\JournalType::class,2)->create();

        //seeders
        $this->call([
            BannerDispositionsSeeder::class,
            BannerLimitsSeeder::class,
            BannerSerialNumbersSeeder::class
        ]);
    }
}
