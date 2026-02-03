<?php

use Illuminate\Support\Facades\Route;

// Public Blog Routes
Route::get('/', App\Livewire\Public\Blog\Index::class)->name('blogs.index');
Route::get('/blogs/{id}', App\Livewire\Public\Blog\Detail::class)->name('blogs.detail');
Route::get('/page/{slug}', App\Livewire\Public\FooterDetail::class)->name('page.detail');

// Public Career Application Form
Route::get('/career/apply', App\Livewire\Public\Career\Apply::class)->name('career.apply');
Route::get('/career/apply/{slug}', App\Livewire\Public\Career\Apply::class)->name('career.apply.slug');

Route::get('/dashboard', App\Livewire\Pages\Dashboard::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/akun', App\Livewire\Pages\Akun\Index::class)
    ->middleware(['auth', 'verified'])
    ->name('akun');

Route::get('/category', App\Livewire\Pages\Category\Index::class)
    ->middleware(['auth', 'verified'])
    ->name('category');

Route::get('/content', App\Livewire\Pages\Content\Index::class)
    ->middleware(['auth', 'verified'])
    ->name('content');

Route::get('/footer', App\Livewire\Pages\Footer\Index::class)
    ->middleware(['auth', 'verified'])
    ->name('footer');

Route::get('/config', App\Livewire\Pages\Config\Index::class)
    ->middleware(['auth', 'verified'])
    ->name('config');

// Career Management (Admin)
Route::get('/career', App\Livewire\Pages\Career\Index::class)
    ->middleware(['auth', 'verified'])
    ->name('career');

Route::get('/slider', App\Livewire\Pages\Slider\Index::class)
    ->middleware(['auth', 'verified'])
    ->name('slider');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';
