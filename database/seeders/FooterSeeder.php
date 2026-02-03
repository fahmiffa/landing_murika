<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FooterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Footer::create([
            'title' => 'TAUTAN CEPAT',
            'content' => '<ul><li><a href="#">Tentang Kami</a></li><li><a href="#">Layanan</a></li><li><a href="#">Kontak</a></li><li><a href="#">Karir</a></li></ul>',
        ]);

        \App\Models\Footer::create([
            'title' => 'BANTUAN',
            'content' => '<ul><li><a href="#">Kebijakan Privasi</a></li><li><a href="#">Syarat & Ketentuan</a></li><li><a href="#">FAQ</a></li></ul>',
        ]);

        \App\Models\Informasi::create([
            'content' => '<p>Platform informasi Human Resources terpercaya. Menyediakan berita terbaru, tips karir, dan regulasi ketenagakerjaan.</p>',
        ]);
    }
}
