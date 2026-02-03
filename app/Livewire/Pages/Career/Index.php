<?php

namespace App\Livewire\Pages\Career;

use App\Models\Career;
use App\Models\Candidate;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $isOpen = false;
    public $isCandidateModalOpen = false;
    public $isEdit = false;
    public $careerId;

    // Career fields
    public $name, $start_date, $end_date, $status = 1;

    // View Candidate Detail
    public $selectedCandidate;

    protected $rules = [
        'name' => 'required|string|max:255',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
        'status' => 'required|boolean',
    ];

    public function render()
    {
        $careers = Career::withCount('candidates')
            ->where('name', 'like', '%' . $this->search . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.pages.career.index', compact('careers'));
    }

    public function create()
    {
        $this->resetInputFields();
        $this->isEdit = false;
        $this->isOpen = true;
    }

    public function edit($id)
    {
        $career = Career::findOrFail($id);
        $this->careerId = $id;
        $this->name = $career->name;
        $this->start_date = $career->start_date->format('Y-m-d');
        $this->end_date = $career->end_date->format('Y-m-d');
        $this->status = $career->status;

        $this->isEdit = true;
        $this->isOpen = true;
    }

    public function store()
    {
        $this->validate();

        Career::create([
            'name' => $this->name,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'status' => $this->status,
        ]);

        session()->flash('message', 'Career berhasil ditambahkan!');
        $this->closeModal();
    }

    public function update()
    {
        $this->validate();

        $career = Career::findOrFail($this->careerId);
        $career->update([
            'name' => $this->name,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'status' => $this->status,
        ]);

        session()->flash('message', 'Career berhasil diperbarui!');
        $this->closeModal();
    }

    public function delete($id)
    {
        Career::findOrFail($id)->delete();
        session()->flash('message', 'Career berhasil dihapus!');
    }

    public function toggleStatus($id)
    {
        $career = Career::findOrFail($id);
        $career->update(['status' => !$career->status]);
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->resetInputFields();
    }

    public function openCandidateDetail($id)
    {
        $this->selectedCandidate = Candidate::findOrFail($id);
        $this->isCandidateModalOpen = true;
    }

    public function closeCandidateModal()
    {
        $this->isCandidateModalOpen = false;
        $this->selectedCandidate = null;
    }

    private function resetInputFields()
    {
        $this->careerId = null;
        $this->name = '';
        $this->start_date = '';
        $this->end_date = '';
        $this->status = 1;
    }
}
