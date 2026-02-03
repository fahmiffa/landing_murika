<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Karir & Kandidat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <!-- Career Openings Table -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
                    <h3 class="text-lg font-bold text-gray-700">Daftar Lowongan (Career)</h3>
                    <div class="flex gap-4">
                        <input wire:model.live="search" type="text" placeholder="Cari career..." class="border-gray-300 rounded-md shadow-sm focus:border-orange-500 focus:ring-orange-500 text-sm">
                        <button wire:click="create" class="bg-orange-600 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded transition flex items-center text-sm">
                            <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Tambah Career
                        </button>
                    </div>
                </div>

                @if (session()->has('message'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                    <p>{{ session('message') }}</p>
                </div>
                @endif

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Career</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Periode</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kandidat</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Link</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($careers as $career)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $career->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-500">
                                    {{ $career->start_date->format('d/m/Y') }} - {{ $career->end_date->format('d/m/Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <button wire:click="toggleStatus({{ $career->id }})" class="focus:outline-none">
                                        <span class="px-2 inline-flex text-[10px] leading-5 font-semibold rounded-full {{ $career->status ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $career->status ? 'On' : 'Off' }}
                                        </span>
                                    </button>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <span class="font-bold text-orange-600">{{ $career->candidates_count }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <button
                                        @click="navigator.clipboard.writeText('{{ url('/career/apply/' . $career->slug) }}'); alert('Link disalin!')"
                                        class="text-xs text-blue-600 hover:underline">Salin Link</button>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm">
                                    <button wire:click="edit({{ $career->id }})" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</button>
                                    <button wire:click="delete({{ $career->id }})" class="text-red-600 hover:text-red-900">Hapus</button>
                                </td>
                            </tr>
                            <!-- Sub-table for candidates of this career -->
                            @if($career->candidates->count() > 0)
                            <tr class="bg-orange-50/30">
                                <td colspan="6" class="px-8 py-4">
                                    <div class="text-xs font-bold text-gray-500 uppercase mb-2">Daftar Pelamar:</div>
                                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                        @foreach($career->candidates as $candidate)
                                        <div class="bg-white p-3 rounded-lg border border-orange-100 shadow-sm flex justify-between items-center">
                                            <div>
                                                <div class="font-bold text-sm text-gray-800">{{ $candidate->nama_kandidat }}</div>
                                                <div class="text-[10px] text-gray-500">{{ $candidate->position }} | {{ $candidate->application_date->format('d M Y') }}</div>
                                            </div>
                                            <button wire:click="openCandidateDetail({{ $candidate->id }})" class="text-orange-600 hover:text-orange-800">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </button>
                                        </div>
                                        @endforeach
                                    </div>
                                </td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">{{ $careers->links() }}</div>
            </div>
        </div>
    </div>

    <!-- Career Modal -->
    @if($isOpen)
    <div class="fixed inset-0 z-50 overflow-y-auto">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75" wire:click="closeModal"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">{{ $isEdit ? 'Edit Career' : 'Tambah Career' }}</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nama Career</label>
                            <input type="text" wire:model="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 sm:text-sm">
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Tanggal Mulai</label>
                                <input type="date" wire:model="start_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 sm:text-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Tanggal Selesai</label>
                                <input type="date" wire:model="end_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 sm:text-sm">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Status</label>
                            <select wire:model="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 sm:text-sm">
                                <option value="1">On</option>
                                <option value="0">Off</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse gap-2">
                    <button wire:click="{{ $isEdit ? 'update' : 'store' }}" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-orange-600 text-base font-medium text-white hover:bg-orange-700 sm:w-auto sm:text-sm">Simpan</button>
                    <button wire:click="closeModal" class="w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:w-auto sm:text-sm">Batal</button>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Candidate Detail Modal -->
    @if($isCandidateModalOpen && $selectedCandidate)
    <div class="fixed inset-0 z-50 overflow-y-auto">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75" wire:click="closeCandidateModal"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full">
                <div class="bg-orange-600 px-6 py-4 text-white flex justify-between items-center">
                    <h3 class="text-lg font-bold">Detail Kandidat: {{ $selectedCandidate->nama_kandidat }}</h3>
                    <button wire:click="closeCandidateModal" class="text-white hover:text-orange-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l18 18" />
                        </svg>
                    </button>
                </div>
                <div class="bg-white px-6 py-6 max-h-[70vh] overflow-y-auto">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm">
                        <div>
                            <label class="text-gray-400 font-bold uppercase text-[10px]">Nama Lengkap</label>
                            <p class="text-gray-900 font-medium">{{ $selectedCandidate->nama_kandidat }}</p>
                        </div>
                        <div>
                            <label class="text-gray-400 font-bold uppercase text-[10px]">Recruiter</label>
                            <p class="text-gray-900 font-medium">{{ $selectedCandidate->recruiter ?? '-' }}</p>
                        </div>
                        <div>
                            <label class="text-gray-400 font-bold uppercase text-[10px]">Posisi</label>
                            <p class="text-gray-900 font-medium">{{ $selectedCandidate->position }}</p>
                        </div>
                        <div>
                            <label class="text-gray-400 font-bold uppercase text-[10px]">Pendidikan</label>
                            <p class="text-gray-900 font-medium">{{ $selectedCandidate->education }}</p>
                        </div>
                        <div>
                            <label class="text-gray-400 font-bold uppercase text-[10px]">Telepon</label>
                            <p class="text-gray-900 font-medium">{{ $selectedCandidate->phone }}</p>
                        </div>
                        <div>
                            <label class="text-gray-400 font-bold uppercase text-[10px]">Email</label>
                            <p class="text-gray-900 font-medium">{{ $selectedCandidate->email }}</p>
                        </div>
                        <div class="md:col-span-2">
                            <label class="text-gray-400 font-bold uppercase text-[10px]">Alamat</label>
                            <p class="text-gray-900 font-medium">{{ $selectedCandidate->address }}</p>
                        </div>
                        <div>
                            <label class="text-gray-400 font-bold uppercase text-[10px]">Tanggal Aplikasi</label>
                            <p class="text-gray-900 font-medium">{{ $selectedCandidate->application_date->format('d M Y') }}</p>
                        </div>
                        <div>
                            <label class="text-gray-400 font-bold uppercase text-[10px]">Lanjut PPG?</label>
                            <p class="text-gray-900 font-medium uppercase">{{ $selectedCandidate->mau_ppg }}</p>
                        </div>
                        <div class="md:col-span-2">
                            <label class="text-gray-400 font-bold uppercase text-[10px]">Planning Jangka Panjang</label>
                            <p class="text-gray-900 font-medium">{{ $selectedCandidate->planning_jangka_panjang ?? '-' }}</p>
                        </div>
                        <div class="md:col-span-2">
                            <label class="text-gray-400 font-bold uppercase text-[10px]">Planning Jangka Dekat</label>
                            <p class="text-gray-900 font-medium">{{ $selectedCandidate->planning_jangka_dekat ?? '-' }}</p>
                        </div>
                        <div class="md:col-span-2">
                            <label class="text-gray-400 font-bold uppercase text-[10px]">Alasan Tidak Diizinkan Ortu</label>
                            <p class="text-gray-900 font-medium">{{ $selectedCandidate->alasan_tidak_diizinkan_ortu ?? '-' }}</p>
                        </div>
                        <div class="md:col-span-2">
                            <label class="text-gray-400 font-bold uppercase text-[10px]">Pengalaman Kerja</label>
                            <p class="text-gray-900 font-medium">{{ $selectedCandidate->pengalaman_kerja ?? '-' }}</p>
                        </div>
                        <div class="md:col-span-2">
                            <label class="text-gray-400 font-bold uppercase text-[10px]">Alasan Tidak Mau Kontrak</label>
                            <p class="text-gray-900 font-medium">{{ $selectedCandidate->alasan_tidak_mau_kontrak ?? '-' }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-6 py-4 flex justify-end">
                    <button wire:click="closeCandidateModal" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 text-sm font-bold">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>