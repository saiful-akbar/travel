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
                'icon' => 'bi-facebook',
            ],
            [
                'nama' => 'Twitter',
                'url' => 'https://twitter.com',
                'icon' => 'bi-twitter',
            ],
            [
                'nama' => 'Instagram',
                'url' => 'https://instagram.com',
                'icon' => 'bi-instagram',
            ],
            [
                'nama' => 'Youtube',
                'url' => 'https://youtube.com',
                'icon' => 'bi-youtube',
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
