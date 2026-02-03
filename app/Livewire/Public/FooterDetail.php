<?php

namespace App\Livewire\Public;

use Livewire\Component;
use App\Models\Footer;
use Livewire\Attributes\Layout;

#[Layout('layouts.public')]
class FooterDetail extends Component
{
    public $footer;

    public function mount($slug)
    {
        $this->footer = Footer::where('slug', $slug)->firstOrFail();
    }

    public function render()
    {
        return view('livewire.public.footer-detail', [
            'footer' => $this->footer
        ]);
    }
}
