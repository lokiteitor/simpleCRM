<?php

use Illuminate\Database\Seeder;

class OportunidadTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(App\Oportunidad::class, 50)->create();
    }
}
