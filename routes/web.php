<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Main pages
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/services', [HomeController::class, 'services'])->name('services');
Route::get('/portfolio', [HomeController::class, 'portfolio'])->name('portfolio');
Route::get('/portfolio/{slug}', [HomeController::class, 'portfolioDetail'])->name('portfolio.show');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

// Blog routes
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/blog/category/{category}', [BlogController::class, 'byCategory'])->name('blog.category');
Route::get('/blog/tag/{tag}', [BlogController::class, 'byTag'])->name('blog.tag');
Route::post('/blog/comment/{blogId}', [BlogController::class, 'storeComment'])->name('blog.comment.store');

// Contact form submission
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
