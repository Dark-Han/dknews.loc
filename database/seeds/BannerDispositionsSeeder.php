<?php

use Illuminate\Database\Seeder;
use App\Models\BannerDisposition;

class BannerDispositionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BannerDisposition::insert([
            ['name'=>'На главной'],
            ['name'=>'На главной и на всех внутренних'],
            ['name'=>'В определенной категории'],
            ['name'=>'О нас'],
            ['name'=>'Реклама'],
            ['name'=>'Правовая информация']
        ]);
    }
}
