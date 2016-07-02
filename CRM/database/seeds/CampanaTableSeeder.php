<?php

use Illuminate\Database\Seeder;

class CampanaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(App\Campana::class, 50)->create();
    }
}
