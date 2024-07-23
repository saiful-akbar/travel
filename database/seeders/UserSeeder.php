<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Data
     *
     * @return array
     */
    private function data(): array
    {
        return [
            [
                'email' => 'admin@gmail.com',
                'password' => bcrypt('admin123'),
                'role' => 'admin',
                'nama_lengkap' => 'Administrator',
                'jenis_kelamin' => 'L',
            ],
            [
                'email' => 'member@gmail.com',
                'password' => bcrypt('member123'),
                'role' => 'member',
                'nama_lengkap' => 'Member',
                'jenis_kelamin' => 'P',
            ],
        ];
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->data() as $user) {
            User::create($user);
        }

        // for ($i = 1; $i <= 100; $i++) {
        //     User::create([
        //         'email' => "user-$i@gmail.com",
        //         'password' => bcrypt('password123'),
        //         'role' => 'member',
        //         'nama_lengkap' => "User $i",
        //         'jenis_kelamin' => 'P',
        //     ]);
        // }
    }
}
