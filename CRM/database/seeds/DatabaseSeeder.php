<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(ContactoTableSeeder::class);
        $this->call(CampanaTableSeeder::class);
        $this->call(OportunidadTableSeeder::class);
        $this->call(TareaTableSeeder::class);
        $this->call(EventoTableSeeder::class);
        factory(App\User::class, 3)->create();
    }
}
