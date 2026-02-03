<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Statistik') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Section -->
            <div class="mb-10 bg-gradient-to-r from-orange-600 to-orange-400 rounded-3xl p-8 md:p-12 shadow-2xl relative overflow-hidden text-white">
                <div class="relative z-10">
                    <h1 class="text-2xl md:text-4xl font-black mb-4 uppercase tracking-tight">Selamat Datang Melayani, {{ auth()->user()->name }}!</h1>
                    <p class="text-orange-50 text-base md:text-lg max-w-2xl font-medium opacity-90">
                        Pantau produktivitas dan seluruh data operasional Lembaga Murika hari ini melalui ringkasan statistik di bawah.
                    </p>
                </div>
                <!-- Abstract patterns -->
                <div class="absolute top-0 right-0 -m-12 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
                <div class="absolute bottom-0 left-0 -m-12 w-48 h-48 bg-black/10 rounded-full blur-2xl"></div>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                @foreach($stats as $stat)
                <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-slate-100 hover:shadow-xl hover:border-orange-100 transition-all duration-300 group">
                    <div class="flex items-center justify-between mb-6">
                        <div class="w-14 h-14 rounded-2xl bg-orange-50 flex items-center justify-center text-orange-600 group-hover:bg-orange-600 group-hover:text-white transition-all duration-300 shadow-sm">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $stat['icon'] }}"></path>
                            </svg>
                        </div>
                        <div class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 group-hover:text-orange-600 transition-colors">
                            Statistik
                        </div>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1.5">{{ $stat['label'] }}</p>
                        <h3 class="text-4xl font-black text-slate-900 tracking-tight">{{ number_format($stat['value']) }}</h3>
                    </div>
                    <div class="mt-6 pt-6 border-t border-slate-50 flex items-center justify-between text-[10px] font-black uppercase tracking-widest text-slate-400">
                        <span>Updated Now</span>
                        <div class="flex gap-1">
                            <div class="w-1.5 h-1.5 rounded-full bg-orange-500 animate-pulse"></div>
                            <div class="w-1.5 h-1.5 rounded-full bg-orange-300"></div>
                            <div class="w-1.5 h-1.5 rounded-full bg-orange-100"></div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Quick Actions or Recent Activities (Optional future expansion) -->
            <div class="mt-12 grid grid-cols-1 lg:grid-cols-2 gap-8">
                <div class="bg-white rounded-[2.5rem] p-8 md:p-10 shadow-sm border border-slate-100">
                    <h3 class="text-xl font-black text-slate-900 uppercase tracking-tight mb-8">Akses Cepat</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <a href="{{ route('content') }}" class="flex flex-col items-center justify-center p-6 bg-slate-50 rounded-2xl hover:bg-orange-50 hover:text-orange-600 transition-all text-slate-600 font-bold uppercase text-[10px] tracking-widest border border-transparent hover:border-orange-100">
                            <svg class="w-6 h-6 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Tulis Materi
                        </a>
                        <a href="{{ route('slider') }}" class="flex flex-col items-center justify-center p-6 bg-slate-50 rounded-2xl hover:bg-orange-50 hover:text-orange-600 transition-all text-slate-600 font-bold uppercase text-[10px] tracking-widest border border-transparent hover:border-orange-100">
                            <svg class="w-6 h-6 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Ganti Hero
                        </a>
                        <a href="{{ route('career') }}" class="flex flex-col items-center justify-center p-6 bg-slate-50 rounded-2xl hover:bg-orange-50 hover:text-orange-600 transition-all text-slate-600 font-bold uppercase text-[10px] tracking-widest border border-transparent hover:border-orange-100">
                            <svg class="w-6 h-6 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            Cek Pelamar
                        </a>
                        <a href="{{ route('config') }}" class="flex flex-col items-center justify-center p-6 bg-slate-50 rounded-2xl hover:bg-orange-50 hover:text-orange-600 transition-all text-slate-600 font-bold uppercase text-[10px] tracking-widest border border-transparent hover:border-orange-100">
                            <svg class="w-6 h-6 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            </svg>
                            Socmed Link
                        </a>
                    </div>
                </div>

                <div class="bg-slate-900 rounded-[2.5rem] p-10 shadow-2xl relative overflow-hidden flex flex-col justify-center">
                    <div class="relative z-10">
                        <span class="text-orange-500 font-black text-[10px] uppercase tracking-[0.2em] mb-4 block">Info Sistem</span>
                        <h3 class="text-2xl font-black text-white uppercase tracking-tight mb-4">Butuh Bantuan Teknis?</h3>
                        <p class="text-slate-400 font-medium text-sm mb-8 leading-relaxed">
                            Jika Anda mengalami kendala saat mengelola dashboard atau ada fitur yang tidak berjalan semestinya, silakan hubungi tim IT Support.
                        </p>
                        <a href="#" class="px-8 py-4 bg-orange-600 text-white font-black rounded-2xl hover:bg-orange-700 transition-all text-xs uppercase tracking-widest inline-block shadow-lg shadow-orange-900/40">Hubungi IT</a>
                    </div>
                    <!-- Abstract backgrounds -->
                    <div class="absolute bottom-0 right-0 p-4 opacity-5">
                        <x-application-logo class="w-64 h-64 text-white" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>