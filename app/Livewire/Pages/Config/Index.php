<?php

namespace App\Livewire\Pages\Config;

use Livewire\Component;
use App\Models\Config;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class Index extends Component
{
    public $configs = [];

    public function mount()
    {
        $keys = ['facebook', 'instagram', 'tiktok', 'youtube'];

        foreach ($keys as $key) {
            $config = Config::firstOrCreate(['key' => $key], ['value' => '#']);
            $this->configs[$key] = $config->value;
        }
    }

    public function save()
    {
        foreach ($this->configs as $key => $value) {
            Config::where('key', $key)->update(['value' => $value]);
        }

        session()->flash('message', 'Konfigurasi navigasi berhasil diperbarui.');
    }

    public function render()
    {
        return view('livewire.pages.config.index');
    }
}
