<?php

namespace App\Livewire\Pages\Content;

use Livewire\Component;
use App\Models\Content;
use App\Models\Category;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Storage;

#[Layout('layouts.app')]
class Index extends Component
{
    use WithPagination, WithFileUploads;

    public $judul, $content, $image, $kategori_id, $content_id, $old_image;
    public $isOpen = false;
    public $search = '';
    public $isEdit = false;

    public function render()
    {
        $contents = Content::with('category')
            ->where('judul', 'like', '%' . $this->search . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $categories = Category::all();

        return view('livewire.pages.content.index', [
            'contents' => $contents,
            'categories' => $categories,
        ]);
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->resetInputFields();
    }

    private function resetInputFields()
    {
        $this->judul = '';
        $this->content = '';
        $this->image = null;
        $this->old_image = null;
        $this->kategori_id = '';
        $this->content_id = null;
        $this->isEdit = false;
        $this->resetErrorBag();
        $this->dispatch('reset-trix');
    }

    public function store()
    {
        $this->validate([
            'judul' => 'required',
            'content' => 'required',
            'kategori_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:2048',
        ]);

        $imagePath = null;
        if ($this->image) {
            $imagePath = $this->image->store('contents', 'public');
        }

        Content::create([
            'judul' => $this->judul,
            'content' => $this->content,
            'kategori_id' => $this->kategori_id,
            'image' => $imagePath,
        ]);

        session()->flash('message', 'Konten berhasil dibuat.');
        $this->closeModal();
    }

    public function edit($id)
    {
        $content = Content::findOrFail($id);
        $this->content_id = $id;
        $this->judul = $content->judul;
        $this->content = $content->content;
        $this->kategori_id = $content->kategori_id;
        $this->old_image = $content->image;
        $this->isEdit = true;

        $this->openModal();
    }

    public function update()
    {
        $this->validate([
            'judul' => 'required',
            'content' => 'required',
            'kategori_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:2048',
        ]);

        $content = Content::findOrFail($this->content_id);

        $data = [
            'judul' => $this->judul,
            'content' => $this->content,
            'kategori_id' => $this->kategori_id,
        ];

        if ($this->image) {
            if ($content->image) {
                Storage::disk('public')->delete($content->image);
            }
            $data['image'] = $this->image->store('contents', 'public');
        }

        $content->update($data);

        session()->flash('message', 'Konten berhasil diperbarui.');
        $this->closeModal();
    }

    public function delete($id)
    {
        $content = Content::findOrFail($id);
        if ($content->image) {
            Storage::disk('public')->delete($content->image);
        }
        $content->delete();
        session()->flash('message', 'Konten berhasil dihapus.');
    }
}
