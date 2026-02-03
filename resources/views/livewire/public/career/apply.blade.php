<div class="min-h-screen py-12">
    <div class="max-w-3xl mx-auto px-6">
        @if($isSubmitted)
        <!-- Success Message -->
        <div class="bg-white rounded-2xl shadow-xl p-12 text-center">
            <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Terima Kasih!</h2>
            <p class="text-gray-600 mb-8">Data lamaran Anda untuk posisi <span class="font-bold text-orange-600">{{ $career->name }}</span> telah berhasil dikirim.</p>
            <a href="/" class="inline-flex items-center px-6 py-3 bg-orange-600 text-white font-semibold rounded-full hover:bg-orange-700 transition">
                Kembali ke Beranda
            </a>
        </div>
        @else
        <!-- Application Form -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <!-- Header -->
            <div class="bg-gradient-to-r from-orange-600 to-orange-500 px-8 py-10 text-white">
                <h1 class="text-3xl font-bold mb-2">Form Lamaran Kerja</h1>
                <p class="text-orange-100 italic">Posisi: {{ $career->name }}</p>
                <p class="text-orange-200 text-sm mt-4">Silakan isi data diri Anda secara lengkap dan teliti.</p>
            </div>

            <!-- Form -->
            <form wire:submit.prevent="submit" class="p-8 space-y-6 text-gray-700">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Nama Kandidat <span class="text-red-500">*</span></label>
                        <input type="text" wire:model="nama_kandidat" class="w-full rounded-lg border-gray-300 focus:ring-orange-500 focus:border-orange-500 shadow-sm" placeholder="Masukkan nama lengkap">
                        @error('nama_kandidat') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Recruiter</label>
                        <input type="text" wire:model="recruiter" class="w-full rounded-lg border-gray-300 focus:ring-orange-500 focus:border-orange-500 shadow-sm" placeholder="Nama recruiter (jika ada)">
                        @error('recruiter') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Position <span class="text-red-500">*</span></label>
                        <input type="text" wire:model="position" class="w-full rounded-lg border-gray-300 focus:ring-orange-500 focus:border-orange-500 shadow-sm" placeholder="Contoh: Guru Matematika">
                        @error('position') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Education <span class="text-red-500">*</span></label>
                        <input type="text" wire:model="education" class="w-full rounded-lg border-gray-300 focus:ring-orange-500 focus:border-orange-500 shadow-sm" placeholder="Contoh: S1 Pendidikan Matematika">
                        @error('education') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Phone <span class="text-red-500">*</span></label>
                        <input type="text" wire:model="phone" class="w-full rounded-lg border-gray-300 focus:ring-orange-500 focus:border-orange-500 shadow-sm" placeholder="08xxxxxxxxxx">
                        @error('phone') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Email <span class="text-red-500">*</span></label>
                        <input type="email" wire:model="email" class="w-full rounded-lg border-gray-300 focus:ring-orange-500 focus:border-orange-500 shadow-sm" placeholder="email@contoh.com">
                        @error('email') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Application Date <span class="text-red-500">*</span></label>
                        <input type="date" wire:model="application_date" class="w-full rounded-lg border-gray-300 focus:ring-orange-500 focus:border-orange-500 shadow-sm">
                        @error('application_date') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Lanjut PPG? <span class="text-red-500">*</span></label>
                        <select wire:model="mau_ppg" class="w-full rounded-lg border-gray-300 focus:ring-orange-500 focus:border-orange-500 shadow-sm">
                            <option value="ya">Ya</option>
                            <option value="tidak">Tidak</option>
                        </select>
                        @error('mau_ppg') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Address <span class="text-red-500">*</span></label>
                    <textarea wire:model="address" rows="3" class="w-full rounded-lg border-gray-300 focus:ring-orange-500 focus:border-orange-500 shadow-sm" placeholder="Masukkan alamat lengkap"></textarea>
                    @error('address') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Planning Jangka Panjang</label>
                    <textarea wire:model="planning_jangka_panjang" rows="3" class="w-full rounded-lg border-gray-300 focus:ring-orange-500 focus:border-orange-500 shadow-sm" placeholder="Rencana Anda dalam 5-10 tahun ke depan..."></textarea>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Planning Jangka Dekat</label>
                    <textarea wire:model="planning_jangka_dekat" rows="3" class="w-full rounded-lg border-gray-300 focus:ring-orange-500 focus:border-orange-500 shadow-sm" placeholder="Rencana Anda dalam 1-2 tahun ke depan..."></textarea>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Alasan Tidak Diizinkan Orang Tua</label>
                    <textarea wire:model="alasan_tidak_diizinkan_ortu" rows="2" class="w-full rounded-lg border-gray-300 focus:ring-orange-500 focus:border-orange-500 shadow-sm" placeholder="Isi jika orang tua tidak memberikan izin..."></textarea>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Pengalaman Kerja</label>
                    <textarea wire:model="pengalaman_kerja" rows="3" class="w-full rounded-lg border-gray-300 focus:ring-orange-500 focus:border-orange-500 shadow-sm" placeholder="Sebutkan pengalaman kerja sebelumnya..."></textarea>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Alasan Tidak Mau Kontrak Kerja</label>
                    <textarea wire:model="alasan_tidak_mau_kontrak" rows="2" class="w-full rounded-lg border-gray-300 focus:ring-orange-500 focus:border-orange-500 shadow-sm" placeholder="Isi jika Anda keberatan dengan kontrak kerja..."></textarea>
                </div>

                <div class="pt-6">
                    <button type="submit" class="w-full py-4 bg-orange-600 text-white font-bold rounded-xl hover:bg-orange-700 transition shadow-lg shadow-orange-100 uppercase tracking-widest flex justify-center items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Kirim Lamaran Sekarang
                    </button>
                </div>
            </form>
        </div>
        @endif
    </div>
</div>