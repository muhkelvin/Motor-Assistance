<?php
// routes/web.php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\MotorController;
use App\Http\Controllers\CreditSimulationController;
use App\Http\Controllers\InquiryController;

// Homepage
Route::get('/', [HomeController::class, 'index'])->name('home');

// Catalog Routes
Route::prefix('katalog')->name('catalog.')->group(function () {
    Route::get('/', [CatalogController::class, 'index'])->name('index');
    Route::get('/kategori/{slug}', [CatalogController::class, 'category'])->name('category');
});

// Motor Routes
Route::prefix('motor')->name('motors.')->group(function () {
    Route::get('/search', [MotorController::class, 'search'])->name('search');
    Route::get('/compare', [MotorController::class, 'compare'])->name('compare');
    Route::get('/{slug}', [MotorController::class, 'show'])->name('show');
});

// Credit Simulation Routes
Route::prefix('simulasi-kredit')->name('credit-simulation.')->group(function () {
    Route::get('/', [CreditSimulationController::class, 'index'])->name('index');
    Route::post('/hitung', [CreditSimulationController::class, 'calculate'])->name('calculate');
    Route::get('/hasil/{id}', [CreditSimulationController::class, 'result'])->name('result');
    Route::post('/bandingkan', [CreditSimulationController::class, 'compare'])->name('compare');
});

// Inquiry Routes
Route::prefix('inquiry')->name('inquiry.')->group(function () {
    Route::get('/create', [InquiryController::class, 'create'])->name('create');
    Route::post('/store', [InquiryController::class, 'store'])->name('store');
    Route::get('/success', [InquiryController::class, 'success'])->name('success');
});

// Static Pages
Route::view('/tentang', 'pages.about')->name('about');
Route::view('/kontak', 'pages.contact')->name('contact');
Route::view('/syarat-ketentuan', 'pages.terms')->name('terms');
Route::view('/kebijakan-privasi', 'pages.privacy')->name('privacy');
