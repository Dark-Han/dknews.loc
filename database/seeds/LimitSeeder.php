<?php

use App\Models\Limit;
use Illuminate\Database\Seeder;

class LimitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Limit::insert([
            ['name'=>'По времени'],
            ['name'=>'По кол-во просмотров'],
            ['name'=>'По времени и по кол-во просмотров']
        ]);
    }
}
