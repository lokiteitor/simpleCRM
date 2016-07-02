<?php

use Illuminate\Database\Seeder;

class TareaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(App\Tarea::class, 50)->create();
    }
}
