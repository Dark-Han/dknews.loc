<?php

use Illuminate\Database\Seeder;
use App\Models\BannerSerialNumber;

class BannerSerialNumbersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1;$i<=8;$i++){
            BannerSerialNumber::create(['name'=>$i]);
        }
    }
}
