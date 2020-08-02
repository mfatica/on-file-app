<?php

use Illuminate\Database\Seeder;

class UsersWithUploads extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $users = factory(App\User::class, 10)->create();

        foreach($users as $user) {
            factory(App\Upload::class, 10)->create([
                'user_id' => $user->id
            ]);
        }
    }
}
