<?php

namespace App\Livewire\Public\Blog;

use Livewire\Component;
use App\Models\Content;
use Livewire\Attributes\Layout;

#[Layout('layouts.public')]
class Detail extends Component
{
    public $content;

    public function mount($id)
    {
        $this->content = Content::with('category')->findOrFail($id);
    }

    public function render()
    {
        $related = Content::where('kategori_id', $this->content->kategori_id)
            ->where('id', '!=', $this->content->id)
            ->latest()
            ->take(3)
            ->get();

        return view('livewire.public.blog.detail', [
            'related' => $related
        ]);
    }
}
