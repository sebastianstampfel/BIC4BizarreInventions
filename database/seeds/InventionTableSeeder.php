<?php

use Illuminate\Database\Seeder;

class InventionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Invention::class, 50)->create();
    }
}
