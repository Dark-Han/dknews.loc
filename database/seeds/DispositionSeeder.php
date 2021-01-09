<?php

use App\Models\Disposition;
use Illuminate\Database\Seeder;

class DispositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Disposition::insert([
            ['name'=>'В странице своей категории'],
            ['name'=>'На главной странице (главные новости сегодня)'],
            ['name'=>'На главной странице (в разделе своей категории)']
        ]);
    }
}
