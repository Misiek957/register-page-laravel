<?php

namespace Database\Seeders;

use app\Models\Post;
use App\Models\Post as ModelsPost;
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
        // \App\Models\User::factory(10)->create();
        ModelsPost::factory(10)->create();
    }
}
