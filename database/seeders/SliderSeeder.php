<?php

namespace Database\Seeders;

use App\Models\Slider;
use Illuminate\Database\Seeder;

class SliderSeeder extends Seeder
{
    public function run(): void
    {
        Slider::create([
            'title' => 'Solusi HR Terpercaya untuk Bisnis Anda',
            'description' => 'Kami membantu mengelola sumber daya manusia dengan lebih efektif dan efisien melalui platform digital yang inovatif.',
            'order' => 1,
            'is_active' => true,
        ]);

        Slider::create([
            'title' => 'Wawasan Karir & Rekrutmen Modern',
            'description' => 'Dapatkan tips dari para ahli untuk meningkatkan potensi karir Anda dan strategi rekrutmen terbaik tahun ini.',
            'order' => 2,
            'is_active' => true,
        ]);
    }
}
