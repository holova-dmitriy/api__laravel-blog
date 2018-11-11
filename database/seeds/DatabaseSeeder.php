<?php

use App\Models\Post;
use App\Models\User;
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
        if (User::count() === 0) {
            $this->call(UsersTableSeeder::class);
        }
        if (Post::count() === 0) {
            $this->call(PostsTableSeeder::class);
        }
    }
}
