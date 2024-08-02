<?php

namespace Database\Seeders;

use App\Models\MediaSosial;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MediaSosialSeeder extends Seeder
{
    private function data(): array
    {
        return [
            [
                'nama' => 'Facebook',
                'url' => 'https://facebook.com',
            ],
            [
                'nama' => 'Twitter',
                'url' => 'https://x.com',
            ],
            [
                'nama' => 'Instagram',
                'url' => 'https://instagram.com',
            ],
            [
                'nama' => 'Youtube',
                'url' => 'https://youtube.com',
            ],
        ];
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->data() as $key => $value) {
            MediaSosial::create($value);
        }
    }
}
