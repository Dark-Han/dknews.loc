<?php

use Illuminate\Database\Seeder;
use App\Models\BannerLimit;

class BannerLimitsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BannerLimit::insert([
                ['name' => 'По времени'],
                ['name' => 'По кол-во просмотров'],
                ['name' => 'И по времени и по кол-во просмотров']
            ]
        );
    }
}
