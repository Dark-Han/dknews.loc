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
        factory(App\Models\JournalType::class,2)->create();
        //seeders
        $this->call([
            BannerDispositionsSeeder::class,
            BannerLimitsSeeder::class,
            BannerSerialNumbersSeeder::class,
            DispositionSeeder::class,
            LimitSeeder::class,
            LanguagesSeeder::class
        ]);
    }
}
