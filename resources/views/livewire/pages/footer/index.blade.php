<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Footer') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

                <!-- Tabs -->
                <div class="flex border-b border-gray-200 mb-6">
                    <button wire:click="switchTab('informasi')" class="px-6 py-3 text-sm font-medium transition-all duration-200 {{ $activeTab === 'informasi' ? 'text-orange-600 border-b-2 border-orange-600' : 'text-gray-500 hover:text-orange-600' }}">
                        Informasi
                    </button>
                    <button wire:click="switchTab('link')" class="px-6 py-3 text-sm font-medium transition-all duration-200 {{ $activeTab === 'link' ? 'text-orange-600 border-b-2 border-orange-600' : 'text-gray-500 hover:text-orange-600' }}">
                        Footer Link
                    </button>
                </div>

                <!-- Utilities: Search & Add Button -->
                <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
                    <div class="w-full md:w-1/3">
                        @if($activeTab === 'link')
                        <input wire:model.live="search" type="text" placeholder="Cari footer..." class="w-full border-gray-300 rounded-md shadow-sm focus:border-orange-500 focus:ring-orange-500 transition duration-150 ease-in-out">
                        @endif
                    </div>
                    <button wire:click="create" class="bg-orange-600 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded transition duration-150 ease-in-out flex items-center">
                        <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah {{ $activeTab === 'link' ? 'Footer Link' : 'Informasi' }}
                    </button>
                </div>

                <!-- Flash Message -->
                @if (session()->has('message'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                    <p>{{ session('message') }}</p>
                </div>
                @endif

                <!-- Table -->
                <div class="overflow-x-auto">
                    @if($activeTab === 'link')
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Konten (Link)</th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($footers as $index => $item)
                            <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $footers->firstItem() + $index }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $item->title }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-500 prose prose-sm max-w-none">
                                        {!! $item->content !!}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <button wire:click="edit({{ $item->id }})" class="text-orange-600 hover:text-orange-900 mr-3">Edit</button>
                                    <button
                                        x-on:click="
                                            Swal.fire({
                                                title: 'Hapus Footer Link?',
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
                                        class="text-red-600 hover:text-red-900">
                                        Hapus
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                    Tidak ada data footer.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $footers->links() }}
                    </div>
                    @else
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Konten Informasi</th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($informasis as $index => $item)
                            <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $informasis->firstItem() + $index }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-500 prose prose-sm max-w-none">
                                        {!! Str::limit(strip_tags($item->content), 150) !!}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <button wire:click="edit({{ $item->id }})" class="text-orange-600 hover:text-orange-900 mr-3">Edit</button>
                                    <button
                                        x-on:click="
                                            Swal.fire({
                                                title: 'Hapus Informasi?',
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
                                        class="text-red-600 hover:text-red-900">
                                        Hapus
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="px-6 py-4 text-center text-gray-500">
                                    Tidak ada data informasi.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $informasis->links() }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    @if($isOpen)
    <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" wire:click="closeModal"></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4" id="modal-title">
                        {{ $isEdit ? 'Edit ' . ($activeTab === 'link' ? 'Footer Link' : 'Informasi') : 'Buat ' . ($activeTab === 'link' ? 'Footer Link' : 'Informasi') . ' Baru' }}
                    </h3>

                    <div class="grid grid-cols-1 gap-4">
                        @if($activeTab === 'link')
                        <!-- Title -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Judul Kolom Footer</label>
                            <input type="text" wire:model="title" placeholder="Contoh: TAUTAN CEPAT" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 sm:text-sm">
                            @error('title') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        @endif

                        <!-- Content (Alpine WYSIWYG) -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                {{ $activeTab === 'link' ? 'Daftar Link (Gunakan List)' : 'Konten Informasi' }}
                            </label>
                            <div x-data="{
                                content: @entangle('content'),
                                execCmd(cmd, value = null) {
                                    document.execCommand(cmd, false, value);
                                    this.updateContent();
                                },
                                updateContent() {
                                    this.content = this.$refs.editor.innerHTML;
                                }
                            }" class="border border-gray-300 rounded-md shadow-sm overflow-hidden focus-within:ring-2 focus-within:ring-orange-500 focus-within:border-orange-500">
                                <!-- Toolbar -->
                                <div class="flex flex-wrap items-center gap-1 p-2 bg-gray-50 border-b border-gray-200">
                                    <button type="button" @click="execCmd('bold')" class="p-2 rounded hover:bg-gray-200 transition" title="Bold">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 4h8a4 4 0 014 4 4 4 0 01-4 4H6z M6 12h9a4 4 0 014 4 4 4 0 01-4 4H6z" />
                                        </svg>
                                    </button>
                                    <button type="button" @click="execCmd('italic')" class="p-2 rounded hover:bg-gray-200 transition" title="Italic">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 4h4m-2 0v16m-4 0h8" />
                                        </svg>
                                    </button>
                                    <div class="w-px h-6 bg-gray-300 mx-1"></div>
                                    <button type="button" @click="execCmd('insertUnorderedList')" class="p-2 rounded hover:bg-gray-200 transition" title="Bullet List">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01" />
                                        </svg>
                                    </button>
                                    <div class="w-px h-6 bg-gray-300 mx-1"></div>
                                    <button type="button" @click="let url = prompt('Enter URL:'); if(url) execCmd('createLink', url)" class="p-2 rounded hover:bg-gray-200 transition" title="Insert Link">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                                        </svg>
                                    </button>
                                </div>
                                <!-- Editor -->
                                <div
                                    x-ref="editor"
                                    contenteditable="true"
                                    @input="updateContent()"
                                    @blur="updateContent()"
                                    x-html="content"
                                    class="min-h-[250px] p-4 prose prose-sm max-w-none focus:outline-none bg-white"
                                    style="overflow-y: auto;"></div>
                            </div>
                            @error('content') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button wire:click="{{ $isEdit ? 'update' : 'store' }}" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-orange-600 text-base font-medium text-white hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Simpan
                    </button>
                    <button wire:click="closeModal" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>