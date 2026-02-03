<?php

namespace App\Livewire\Public\Blog;

use Livewire\Component;
use App\Models\Content;
use App\Models\Category;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('layouts.public')]
class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $selectedCategory = null;

    protected $queryString = [
        'search' => ['except' => ''],
        'selectedCategory' => ['except' => null],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function selectCategory($id)
    {
        $this->selectedCategory = $id;
        $this->resetPage();
    }

    public function render()
    {
        $query = Content::with('category')
            ->where('judul', 'like', '%' . $this->search . '%');

        if ($this->selectedCategory) {
            $query->where('kategori_id', $this->selectedCategory);
        }

        $contents = $query->orderBy('created_at', 'desc')->paginate(9);
        $categories = Category::withCount('contents')->get();
        $sliders = \App\Models\Slider::where('is_active', true)->orderBy('order', 'asc')->get();

        $featured = $this->selectedCategory ? null : Content::latest()->first();

        return view('livewire.public.blog.index', [
            'contents' => $contents,
            'categories' => $categories,
            'featured' => $featured,
            'sliders' => $sliders,
        ]);
    }
}
