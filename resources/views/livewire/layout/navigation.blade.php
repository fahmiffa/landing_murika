<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<aside class="w-full h-full bg-white border-r border-orange-50 flex flex-col">
    <!-- Logo -->
    <div class="h-20 flex items-center px-8 border-b border-orange-50 bg-orange-50/30">
        <div class="flex items-center gap-3 font-bold text-xl text-gray-800">
            <x-application-logo class="w-auto h-10" />
        </div>
    </div>

    <!-- Navigation Links -->
    <nav class="flex-1 overflow-y-auto py-6 px-4 space-y-1.5">
        <div class="mb-4">
            <a href="{{ route('dashboard') }}" wire:navigate class="flex items-center gap-3.5 px-4 py-3 rounded-2xl transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-orange-500 text-white shadow-lg shadow-orange-200 font-bold' : 'text-gray-500 hover:bg-orange-50 hover:text-orange-600' }}">
                <svg class="w-5 h-5 {{ request()->routeIs('dashboard') ? 'text-white' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                <span class="text-sm">Dashboard</span>
            </a>
        </div>

        @if(auth()->user()->role === 0 || auth()->user()->role === 1)
        <div class="pt-2 pb-1 px-4">
            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em]">Menu</p>
        </div>

        <a href="{{ route('akun') }}" wire:navigate class="flex items-center gap-3.5 px-4 py-3 rounded-2xl transition-all duration-200 {{ request()->routeIs('akun') ? 'bg-orange-500 text-white shadow-lg shadow-orange-200 font-bold' : 'text-gray-500 hover:bg-orange-50 hover:text-orange-600' }}">
            <svg class="w-5 h-5 {{ request()->routeIs('akun') ? 'text-white' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
            </svg>
            <span class="text-sm">Accounts</span>
        </a>

        <a href="{{ route('category') }}" wire:navigate class="flex items-center gap-3.5 px-4 py-3 rounded-2xl transition-all duration-200 {{ request()->routeIs('category') ? 'bg-orange-500 text-white shadow-lg shadow-orange-200 font-bold' : 'text-gray-500 hover:bg-orange-50 hover:text-orange-600' }}">
            <svg class="w-5 h-5 {{ request()->routeIs('category') ? 'text-white' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
            </svg>
            <span class="text-sm">Kategori</span>
        </a>

        <a href="{{ route('content') }}" wire:navigate class="flex items-center gap-3.5 px-4 py-3 rounded-2xl transition-all duration-200 {{ request()->routeIs('content') ? 'bg-orange-500 text-white shadow-lg shadow-orange-200 font-bold' : 'text-gray-500 hover:bg-orange-50 hover:text-orange-600' }}">
            <svg class="w-5 h-5 {{ request()->routeIs('content') ? 'text-white' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
            </svg>
            <span class="text-sm">Content</span>
        </a>

        <a href="{{ route('slider') }}" wire:navigate class="flex items-center gap-3.5 px-4 py-3 rounded-2xl transition-all duration-200 {{ request()->routeIs('slider') ? 'bg-orange-500 text-white shadow-lg shadow-orange-200 font-bold' : 'text-gray-500 hover:bg-orange-50 hover:text-orange-600' }}">
            <svg class="w-5 h-5 {{ request()->routeIs('slider') ? 'text-white' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            <span class="text-sm">Slider</span>
        </a>

        <a href="{{ route('footer') }}" wire:navigate class="flex items-center gap-3.5 px-4 py-3 rounded-2xl transition-all duration-200 {{ request()->routeIs('footer') ? 'bg-orange-500 text-white shadow-lg shadow-orange-200 font-bold' : 'text-gray-500 hover:bg-orange-50 hover:text-orange-600' }}">
            <svg class="w-5 h-5 {{ request()->routeIs('footer') ? 'text-white' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
            <span class="text-sm">Footer</span>
        </a>

        <a href="{{ route('config') }}" wire:navigate class="flex items-center gap-3.5 px-4 py-3 rounded-2xl transition-all duration-200 {{ request()->routeIs('config') ? 'bg-orange-500 text-white shadow-lg shadow-orange-200 font-bold' : 'text-gray-500 hover:bg-orange-50 hover:text-orange-600' }}">
            <svg class="w-5 h-5 {{ request()->routeIs('config') ? 'text-white' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
            <span class="text-sm">Sosial Media</span>
        </a>

        <a href="{{ route('career') }}" wire:navigate class="flex items-center gap-3.5 px-4 py-3 rounded-2xl transition-all duration-200 {{ request()->routeIs('career') ? 'bg-orange-500 text-white shadow-lg shadow-orange-200 font-bold' : 'text-gray-500 hover:bg-orange-50 hover:text-orange-600' }}">
            <svg class="w-5 h-5 {{ request()->routeIs('career') ? 'text-white' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
            </svg>
            <span class="text-sm">Job</span>
        </a>
        @endif
    </nav>

    <!-- User Profile Section -->
    <div class="p-4 border-t border-orange-50 bg-orange-50/10">
        <div x-data="{ open: false }" class="relative">
            <!-- User Card to Toggle -->
            <button @click="open = !open" class="flex items-center gap-3 w-full p-3 rounded-2xl hover:bg-white hover:shadow-md transition-all duration-300 group">
                <div class="h-10 w-10 text-white font-bold bg-orange-500 rounded-xl flex items-center justify-center uppercase shadow-sm group-hover:scale-110 transition-transform">
                    {{ substr(auth()->user()->name, 0, 1) }}
                </div>
                <div class="flex-1 text-left overflow-hidden">
                    <p class="text-sm font-bold text-gray-900 truncate" x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></p>
                    <p class="text-[10px] text-gray-400 uppercase font-bold tracking-wider">Administrator</p>
                </div>
                <svg class="w-4 h-4 text-gray-400 group-hover:text-orange-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>

            <!-- Popover Menu (Upward) -->
            <div x-show="open" @click.away="open = false"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 translate-y-2 scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                x-transition:leave-end="opacity-0 translate-y-2 scale-95"
                class="absolute bottom-[calc(100%+0.5rem)] left-0 w-full bg-white rounded-2xl shadow-2xl border border-orange-50 p-4 z-50 overflow-hidden" x-cloak>

                <div class="absolute top-0 right-0 -m-4 w-20 h-20 bg-orange-50 rounded-full opacity-50"></div>

                <div class="relative space-y-1">
                    <a href="{{ route('profile') }}" wire:navigate class="flex items-center gap-3 px-3 py-2.5 text-sm text-gray-600 hover:text-orange-600 hover:bg-orange-50 rounded-xl transition-all">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Pengaturan Profil
                    </a>

                    <button wire:click="logout" class="w-full flex items-center gap-3 px-3 py-2.5 text-sm text-red-600 hover:bg-red-50 rounded-xl transition-all text-left">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        Keluar Aplikasi
                    </button>
                </div>
            </div>
        </div>
    </div>
</aside>