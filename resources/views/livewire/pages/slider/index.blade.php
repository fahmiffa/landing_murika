<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Hero Slider') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

                <!-- Header Utilities -->
                <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
                    <div class="w-full md:w-1/3">
                        <input wire:model.live="search" type="text" placeholder="Cari slider..." class="w-full border-gray-300 rounded-md shadow-sm focus:border-orange-500 focus:ring-orange-500 transition duration-150 ease-in-out">
                    </div>
                    <button wire:click="create" class="bg-orange-600 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded-xl transition duration-150 ease-in-out flex items-center shadow-lg shadow-orange-100">
                        <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah Slider
                    </button>
                </div>

                <!-- Flash Message -->
                @if (session()->has('message'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-r-lg" role="alert">
                    <p>{{ session('message') }}</p>
                </div>
                @endif

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50 uppercase tracking-wider text-[10px] font-bold text-gray-500">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left">No</th>
                                <th scope="col" class="px-6 py-3 text-left">Gambar</th>
                                <th scope="col" class="px-6 py-3 text-left">Judul / Deskripsi</th>
                                <th scope="col" class="px-6 py-3 text-center">Urutan</th>
                                <th scope="col" class="px-6 py-3 text-center">Status</th>
                                <th scope="col" class="px-6 py-3 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($sliders as $index => $item)
                            <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $sliders->firstItem() + $index }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    @if($item->image)
                                    <div class="relative group">
                                        <img src="{{ asset('storage/' . $item->image) }}" alt="Slide Image" class="h-16 w-28 object-cover rounded-lg shadow-sm group-hover:scale-105 transition-transform duration-300">
                                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center rounded-lg">
                                            <a href="{{ asset('storage/' . $item->image) }}" target="_blank" class="text-white p-1 rounded-full bg-white/20 hover:bg-white/40 overflow-hidden">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                    @else
                                    <div class="h-16 w-28 bg-gray-100 rounded-lg flex items-center justify-center text-gray-400">
                                        No Image
                                    </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-bold text-gray-900">{{ $item->title ?: '-' }}</div>
                                    <div class="text-xs text-gray-500 mt-1 line-clamp-2">{{ $item->description ?: '-' }}</div>
                                </td>
                                <td class="px-6 py-4 text-center whitespace-nowrap text-sm text-gray-500 font-medium">
                                    {{ $item->order }}
                                </td>
                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                    <button wire:click="toggleStatus({{ $item->id }})" class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none {{ $item->is_active ? 'bg-orange-500' : 'bg-gray-200' }}">
                                        <span class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out {{ $item->is_active ? 'translate-x-5' : 'translate-x-0' }}"></span>
                                    </button>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <button wire:click="edit({{ $item->id }})" class="text-orange-600 hover:text-orange-900 mr-4 font-bold transition-colors">Edit</button>
                                    <button
                                        x-on:click="
                                            Swal.fire({
                                                title: 'Hapus Slider?',
                                                text: 'Data yang dihapus tidak dapat dikembalikan!',
                                                icon: 'warning',
                                                showCancelButton: true,
                                                confirmButtonColor: '#ea580c',
                                                cancelButtonColor: '#ef4444',
                                                confirmButtonText: 'Ya, Hapus!',
                                                cancelButtonText: 'Batal'
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    $wire.delete({{ $item->id }})
                                                }
                                            })
                                        "
                                        class="text-red-600 hover:text-red-900 font-bold transition-colors">
                                        Hapus
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                    <div class="flex flex-col items-center">
                                        <svg class="w-12 h-12 text-gray-200 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        Tidak ada data slider.
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $sliders->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    @if($isOpen)
    <div class="fixed inset-0 z-[60] overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-slate-900/60 transition-opacity backdrop-blur-sm" aria-hidden="true" wire:click="closeModal"></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div class="inline-block align-bottom bg-white rounded-3xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-8 sm:pb-4">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl leading-6 font-bold text-gray-900" id="modal-title">
                            {{ $isEdit ? 'Edit Hero Slide' : 'Tambah Hero Slide Baru' }}
                        </h3>
                        <button wire:click="closeModal" class="text-gray-400 hover:text-gray-500 transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <div class="grid grid-cols-1 gap-6">
                        <!-- Preview Image if exists -->
                        @if ($image)
                        <div class="w-full h-48 rounded-2xl overflow-hidden shadow-inner bg-gray-50 relative group">
                            <img src="{{ $image->temporaryUrl() }}" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-black/20 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                <span class="text-white text-xs font-bold uppercase tracking-wider backdrop-blur-md px-3 py-1 rounded-full">Preview Baru</span>
                            </div>
                        </div>
                        @elseif ($existingImage)
                        <div class="w-full h-48 rounded-2xl overflow-hidden shadow-inner bg-gray-50 relative group">
                            <img src="{{ asset('storage/' . $existingImage) }}" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-black/20 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                <span class="text-white text-xs font-bold uppercase tracking-wider backdrop-blur-md px-3 py-1 rounded-full">Gambar Saat Ini</span>
                            </div>
                        </div>
                        @else
                        <div class="w-full h-48 rounded-2xl border-2 border-dashed border-gray-200 flex flex-col items-center justify-center text-gray-400 bg-gray-50/50">
                            <svg class="w-10 h-10 mb-2 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <p class="text-[10px] font-bold uppercase tracking-wider">Pilih gambar hero</p>
                        </div>
                        @endif

                        <!-- Input Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="md:col-span-2"
                                 x-data="{ isUploading: false, progress: 0 }"
                                 x-on:livewire-upload-start="isUploading = true"
                                 x-on:livewire-upload-finish="isUploading = false; progress = 0"
                                 x-on:livewire-upload-error="isUploading = false"
                                 x-on:livewire-upload-progress="progress = $event.detail.progress">
                                <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-1.5">Gambar Hero</label>
                                <input type="file" wire:model="image" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100 transition-all border border-gray-200 rounded-xl p-1.5">
                                
                                <!-- Progress Bar -->
                                <div x-show="isUploading" class="w-full bg-gray-200 rounded-full h-2 mt-2 overflow-hidden" style="display: none;">
                                    <div class="bg-orange-600 h-2 rounded-full transition-all duration-300 ease-out" x-bind:style="'width: ' + progress + '%'"></div>
                                </div>
                                <div x-show="isUploading" class="text-xs text-orange-600 mt-1 font-medium animate-pulse" style="display: none;">Mengunggah gambar... <span x-text="progress"></span>%</div>
                                
                                @error('image') <span class="text-red-500 text-[10px] font-bold mt-1 uppercase tracking-wider">{{ $message }}</span> @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-1.5">Judul</label>
                                <input type="text" wire:model="title" class="block w-full rounded-xl border-gray-200 shadow-sm focus:border-orange-500 focus:ring-orange-500 sm:text-sm p-3 bg-gray-50/50" placeholder="Masukkan judul slide">
                                @error('title') <span class="text-red-500 text-[10px] font-bold mt-1 uppercase tracking-wider">{{ $message }}</span> @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-1.5">Deskripsi</label>
                                <textarea wire:model="description" rows="3" class="block w-full rounded-xl border-gray-200 shadow-sm focus:border-orange-500 focus:ring-orange-500 sm:text-sm p-3 bg-gray-50/50" placeholder="Masukkan deskripsi slide"></textarea>
                                @error('description') <span class="text-red-500 text-[10px] font-bold mt-1 uppercase tracking-wider">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-1.5">Urutan</label>
                                <input type="number" wire:model="order" class="block w-full rounded-xl border-gray-200 shadow-sm focus:border-orange-500 focus:ring-orange-500 sm:text-sm p-3 bg-gray-50/50">
                                @error('order') <span class="text-red-500 text-[10px] font-bold mt-1 uppercase tracking-wider">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-1.5">Status Aktif</label>
                                <div class="flex items-center mt-3">
                                    <button wire:click="$toggle('is_active')" type="button" class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none {{ $is_active ? 'bg-orange-500' : 'bg-gray-200' }}">
                                        <span class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out {{ $is_active ? 'translate-x-5' : 'translate-x-0' }}"></span>
                                    </button>
                                    <span class="ml-3 text-sm text-gray-500 font-medium">{{ $is_active ? 'Aktif' : 'Tidak Aktif' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50/50 px-4 py-4 sm:px-8 sm:flex sm:flex-row-reverse gap-3 rounded-b-3xl mt-4">
                    <button wire:click="{{ $isEdit ? 'update' : 'store' }}" type="button" class="w-full inline-flex justify-center rounded-xl border border-transparent shadow-lg shadow-orange-100 px-6 py-2.5 bg-orange-600 text-sm font-bold text-white hover:bg-orange-700 focus:outline-none transition-all sm:w-auto">
                        Simpan Slider
                    </button>
                    <button wire:click="closeModal" type="button" class="mt-3 w-full inline-flex justify-center rounded-xl border border-gray-200 px-6 py-2.5 bg-white text-sm font-bold text-gray-600 hover:bg-gray-50 transition-all sm:mt-0 sm:w-auto">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>