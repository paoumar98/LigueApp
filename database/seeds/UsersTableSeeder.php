<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'             => 1,
                'name'           => 'Admin',
                'email'          => 'admin@admin.com',
                'password'       => '$2y$10$8PuLIJXkz3oDz3cehTE0IuKSTlm5hJ0tvqI9IWvTL3wrh.qfC0MZ.',
                'remember_token' => null,
            ],
        ];

        User::insert($users);
    }
}
