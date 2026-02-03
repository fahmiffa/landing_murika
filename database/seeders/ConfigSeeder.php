<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Config;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Config::updateOrCreate(['key' => 'jadwal_masuk'], ['value' => '08:00']);
        Config::updateOrCreate(['key' => 'jadwal_keluar'], ['value' => '17:00']);
    }
}
