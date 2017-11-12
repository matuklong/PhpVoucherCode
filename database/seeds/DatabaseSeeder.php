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
        // $this->call('UsersTableSeeder');
        
        for ($i = 1; $i <= 50; $i++) {
            DB::table('recipient')->insert([
                'name' => str_random(10),
                'email' => str_random(10).'@gmail.com',
            ]);
        }
    }
}
