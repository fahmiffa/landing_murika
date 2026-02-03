<?php

namespace App\Livewire\Pages\Slider;

use App\Models\Slider;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class Index extends Component
{
    use WithPagination, WithFileUploads;

    public $slider_id, $title, $description, $image, $order, $is_active = true;
    public $existingImage;
    public $isOpen = false;
    public $isEdit = false;
    public $search = '';

    protected $rules = [
        'title' => 'nullable|string|max:255',
        'description' => 'nullable|string',
        'image' => 'nullable|image|max:2048', // 2MB Max
        'order' => 'integer',
        'is_active' => 'boolean'
    ];

    public function render()
    {
        $sliders = Slider::where('title', 'like', '%' . $this->search . '%')
            ->orderBy('order', 'asc')
            ->paginate(10);

        return view('livewire.pages.slider.index', [
            'sliders' => $sliders
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
        $this->slider_id = null;
        $this->title = '';
        $this->description = '';
        $this->image = null;
        $this->existingImage = null;
        $this->order = 0;
        $this->is_active = true;
        $this->isEdit = false;
        $this->resetErrorBag();
    }

    public function store()
    {
        $this->validate();

        $imagePath = $this->image ? $this->image->store('sliders', 'public') : null;

        Slider::create([
            'title' => $this->title,
            'description' => $this->description,
            'image' => $imagePath,
            'order' => $this->order,
            'is_active' => $this->is_active
        ]);

        session()->flash('message', 'Slider berhasil ditambahkan.');
        $this->closeModal();
    }

    public function edit($id)
    {
        $slider = Slider::findOrFail($id);
        $this->slider_id = $id;
        $this->title = $slider->title;
        $this->description = $slider->description;
        $this->existingImage = $slider->image;
        $this->order = $slider->order;
        $this->is_active = $slider->is_active;

        $this->isEdit = true;
        $this->openModal();
    }

    public function update()
    {
        $this->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'order' => 'integer',
            'is_active' => 'boolean'
        ]);

        $slider = Slider::findOrFail($this->slider_id);

        $data = [
            'title' => $this->title,
            'description' => $this->description,
            'order' => $this->order,
            'is_active' => $this->is_active
        ];

        if ($this->image) {
            // Delete old image
            if ($slider->image) {
                Storage::disk('public')->delete($slider->image);
            }
            $data['image'] = $this->image->store('sliders', 'public');
        }

        $slider->update($data);

        session()->flash('message', 'Slider berhasil diperbarui.');
        $this->closeModal();
    }

    public function toggleStatus($id)
    {
        $slider = Slider::findOrFail($id);
        $slider->update(['is_active' => !$slider->is_active]);
    }

    public function delete($id)
    {
        $slider = Slider::findOrFail($id);
        if ($slider->image) {
            Storage::disk('public')->delete($slider->image);
        }
        $slider->delete();
        session()->flash('message', 'Slider berhasil dihapus.');
    }
}
