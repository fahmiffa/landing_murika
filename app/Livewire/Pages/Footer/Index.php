<?php

namespace App\Livewire\Pages\Footer;

use Livewire\Component;
use App\Models\Footer;
use App\Models\Informasi;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class Index extends Component
{
    use WithPagination;

    // Common
    public $activeTab = 'informasi';
    public $isOpen = false;
    public $isEdit = false;
    public $search = '';

    // Footer Links Fields
    public $title, $content, $footer_id;

    // Informasi Fields
    public $informasi_id;
    // content is shared, which is fine for simple forms or can be renamed

    public function render()
    {
        $footers = Footer::where('title', 'like', '%' . $this->search . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $informasis = Informasi::orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.pages.footer.index', [
            'footers' => $footers,
            'informasis' => $informasis,
        ]);
    }

    public function switchTab($tab)
    {
        $this->activeTab = $tab;
        $this->resetPage();
        $this->resetInputFields();
        $this->search = '';
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
        $this->title = '';
        $this->content = '';
        $this->footer_id = null;
        $this->informasi_id = null;
        $this->isEdit = false;
        $this->resetErrorBag();
        $this->dispatch('reset-trix');
    }

    public function store()
    {
        if ($this->activeTab === 'link') {
            $this->validate([
                'title' => 'required',
                'content' => 'required',
            ]);

            Footer::create([
                'title' => $this->title,
                'content' => $this->content,
            ]);

            session()->flash('message', 'Footer link berhasil dibuat.');
        } else {
            $this->validate([
                'content' => 'required',
            ]);

            Informasi::create([
                'content' => $this->content,
            ]);

            session()->flash('message', 'Informasi berhasil dibuat.');
        }

        $this->closeModal();
    }

    public function edit($id)
    {
        if ($this->activeTab === 'link') {
            $footer = Footer::findOrFail($id);
            $this->footer_id = $id;
            $this->title = $footer->title;
            $this->content = $footer->content;
        } else {
            $informasi = Informasi::findOrFail($id);
            $this->informasi_id = $id;
            $this->content = $informasi->content;
        }

        $this->isEdit = true;
        $this->openModal();
    }

    public function update()
    {
        if ($this->activeTab === 'link') {
            $this->validate([
                'title' => 'required',
                'content' => 'required',
            ]);

            $footer = Footer::findOrFail($this->footer_id);
            $footer->update([
                'title' => $this->title,
                'content' => $this->content,
            ]);

            session()->flash('message', 'Footer link berhasil diperbarui.');
        } else {
            $this->validate([
                'content' => 'required',
            ]);

            $informasi = Informasi::findOrFail($this->informasi_id);
            $informasi->update([
                'content' => $this->content,
            ]);

            session()->flash('message', 'Informasi berhasil diperbarui.');
        }

        $this->closeModal();
    }

    public function delete($id)
    {
        if ($this->activeTab === 'link') {
            Footer::findOrFail($id)->delete();
            session()->flash('message', 'Footer link berhasil dihapus.');
        } else {
            Informasi::findOrFail($id)->delete();
            session()->flash('message', 'Informasi berhasil dihapus.');
        }
    }
}
