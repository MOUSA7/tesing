<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        factory('App\User',7)->create();
        factory('App\Post',7)->create();
        factory('App\Comment',7)->create();
        $this->call(TagSeederTable::class);
        $this->call(PostTagsSeederTable::class);
    }
}
