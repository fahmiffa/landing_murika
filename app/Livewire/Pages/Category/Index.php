<?php

namespace App\Livewire\Pages\Category;

use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class Index extends Component
{
    use WithPagination;

    public $name, $category_id;
    public $isOpen = false;
    public $search = '';
    public $isEdit = false;

    public function render()
    {
        $categories = Category::where('name', 'like', '%' . $this->search . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.pages.category.index', [
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
        $this->name = '';
        $this->category_id = null;
        $this->isEdit = false;
        $this->resetErrorBag();
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|unique:categories,name',
        ]);

        Category::create([
            'name' => $this->name,
        ]);

        session()->flash('message', 'Kategori berhasil dibuat.');
        $this->closeModal();
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $this->category_id = $id;
        $this->name = $category->name;
        $this->isEdit = true;

        $this->openModal();
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|unique:categories,name,' . $this->category_id,
        ]);

        $category = Category::findOrFail($this->category_id);
        $category->update([
            'name' => $this->name,
        ]);

        session()->flash('message', 'Kategori berhasil diperbarui.');
        $this->closeModal();
    }

    public function delete($id)
    {
        Category::find($id)->delete();
        session()->flash('message', 'Kategori berhasil dihapus.');
    }
}
