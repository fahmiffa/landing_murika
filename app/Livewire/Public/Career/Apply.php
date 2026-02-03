<?php

namespace App\Livewire\Public\Career;

use App\Models\Career;
use App\Models\Candidate;
use Livewire\Component;
use Livewire\Attributes\Layout;

class Apply extends Component
{
    public $career;
    public $isSubmitted = false;

    // Form fields
    public $nama_kandidat, $recruiter, $position, $education, $phone, $email, $address;
    public $application_date, $planning_jangka_panjang, $planning_jangka_dekat;
    public $mau_ppg = 'tidak', $alasan_tidak_diizinkan_ortu, $pengalaman_kerja, $alasan_tidak_mau_kontrak;

    protected $rules = [
        'nama_kandidat' => 'required|string|max:255',
        'recruiter' => 'nullable|string|max:255',
        'position' => 'required|string|max:255',
        'education' => 'required|string|max:255',
        'phone' => 'required|string|max:20',
        'email' => 'required|email|max:255',
        'address' => 'required|string',
        'application_date' => 'required|date',
        'planning_jangka_panjang' => 'nullable|string',
        'planning_jangka_dekat' => 'nullable|string',
        'mau_ppg' => 'required|in:ya,tidak',
        'alasan_tidak_diizinkan_ortu' => 'nullable|string',
        'pengalaman_kerja' => 'nullable|string',
        'alasan_tidak_mau_kontrak' => 'nullable|string',
    ];

    public function mount($slug)
    {
        $this->career = Career::where('slug', $slug)->active()->first();

        if (!$this->career) {
            abort(404, 'Link lowongan kerja tidak ditemukan, tidak aktif, atau sudah berakhir.');
        }

        $this->application_date = date('Y-m-d');
        $this->position = $this->career->name; // Default position set to career name
    }

    public function submit()
    {
        $this->validate();

        Candidate::create([
            'career_id' => $this->career->id,
            'nama_kandidat' => $this->nama_kandidat,
            'recruiter' => $this->recruiter,
            'position' => $this->position,
            'education' => $this->education,
            'phone' => $this->phone,
            'email' => $this->email,
            'address' => $this->address,
            'application_date' => $this->application_date,
            'planning_jangka_panjang' => $this->planning_jangka_panjang,
            'planning_jangka_dekat' => $this->planning_jangka_dekat,
            'mau_ppg' => $this->mau_ppg,
            'alasan_tidak_diizinkan_ortu' => $this->alasan_tidak_diizinkan_ortu,
            'pengalaman_kerja' => $this->pengalaman_kerja,
            'alasan_tidak_mau_kontrak' => $this->alasan_tidak_mau_kontrak,
        ]);

        $this->isSubmitted = true;
    }

    #[Layout('layouts.public')]
    public function render()
    {
        return view('livewire.public.career.apply');
    }
}
