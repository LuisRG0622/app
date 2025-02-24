<?php

use App\Http\Controllers\ChirpController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\RawMaterialController;
use App\Http\Controllers\SuppliersController;
use App\Http\Controllers\FinishedProductController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\CategoriaProductoController;
use App\Http\Controllers\PDFController;






Route::get('/', function () {
    return auth()->check() ? redirect()->route('dashboard') : redirect()->route('login');
});




Route::middleware(['auth'])->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::get('/search', [SearchController::class, 'search'])->name('search');
    
    
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);
    
    Route::get('/users', function () {return view('users.index');})->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::resource('users', UserController::class);
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');

    Route::prefix('sales')->group(function () {
        Route::get('/', [SalesController::class, 'index'])->name('sales.index');
        Route::get('/create', [SalesController::class, 'create'])->name('sales.create');
        Route::post('/', [SalesController::class, 'store'])->name('sales.store');
        Route::get('/{sale}', [SalesController::class, 'show'])->name('sales.show');
        Route::get('/{sale}/edit', [SalesController::class, 'edit'])->name('sales.edit');
        Route::put('/{sale}', [SalesController::class, 'update'])->name('sales.update');
        Route::delete('/{sale}', [SalesController::class, 'destroy'])->name('sales.destroy');
    });
    

    Route::get('/raw_material', function () {return view('raw_material.index');})->name('raw_material.index');
    Route::resource('raw_material', RawMaterialController::class);
    Route::post('/materials/store', [RawMaterialController::class, 'store'])->name('materials.store');
    Route::get('/materials', [RawMaterialController::class, 'index'])->name('materials.index');
    Route::post('/raw-materials', [RawMaterialController::class, 'store'])->name('raw_material.store');
    Route::post('/raw_material/import', [RawMaterialController::class, 'import'])->name('raw_material.import');
    Route::get('/raw-material/create', [RawMaterialController::class, 'create'])->name('raw_material.create');
    Route::post('/raw-material/store', [RawMaterialController::class, 'store'])->name('raw_material.store');
    Route::post('raw_material', [RawMaterialController::class, 'store'])->name('raw_material.store');
    Route::get('/productos', [RawMaterialController::class, 'index'])->name('raw_material.index');
    Route::get('/categoria_producto/{id}/edit', [CategoriaProductoController::class, 'edit'])->name('categoria_producto.edit');
    Route::put('/categoria_producto/{id}', [CategoriaProductoController::class, 'update'])->name('categoria_producto.update');
    Route::resource('categoria_producto', CategoriaProductoController::class);


    Route::get('/suppliers', function () {
        return view('suppliers.index');
    })->name('suppliers.index');
    Route::resource('suppliers', SuppliersController::class);
    




    Route::get('/clients', function () {
        return view('clients.index');
    })->name('clients.index');
    Route::resource('clients', ClientController::class);
    Route::get('/clients/create', [ClientController::class, 'create'])->name('clients.create'); // Muestra el formulario de creación
    Route::post('/clients', [ClientController::class, 'store'])->name('clients.store');



    Route::post('/quotes/store', [QuoteController::class, 'store'])->name('quotes.store');
    Route::get('/quotes', [QuoteController::class, 'index'])->name('quotes.index');
    Route::get('/quotes/pdf', [QuoteController::class, 'generatePDF'])->name('quotes.pdf');
    Route::get('/quote/{clientId}/pdf', [QuoteController::class, 'generatePDF'])->name('quote.generatePDF');
    Route::get('/quote/{clientId}/preview', [QuoteController::class, 'preview'])->name('quote.preview');
    Route::get('/categoria-producto', [CategoriaProductoController::class, 'index'])->name('categoria-producto.index');
    Route::get('/categoria-producto/create/{producto_id}', [CategoriaProductoController::class, 'create'])->name('categoria-producto.create');
    Route::post('/categoria-producto', [CategoriaProductoController::class, 'store'])->name('categoria-producto.store');
    Route::get('raw-material/createcategoria', [RawMaterialController::class, 'createCategoria'])->name('raw_material.createcategoria');
    Route::get('/quote/preview/{clientId}', [QuoteController::class, 'preview'])->name('quote.preview');

    
    Route::get('/categoria_producto/create', [CategoriaProductoController::class, 'create'])->name('categoria_producto.create');
    Route::post('/categoria_producto/store', [CategoriaProductoController::class, 'store'])->name('categoria_producto.store');

    Route::get('/generate-pdf', [PDFController::class, 'generatePDF']);
    Route::get('/sales/{sale}/pdf', [SalesController::class, 'generatePDF'])->name('sales.pdf');
    Route::get('/sales/{sale}', [SalesController::class, 'show'])->name('sales.show');
    Route::get('/sales/{id}', [SalesController::class, 'show'])->name('sales.show');
    Route::get('/sales/{id}/pdf', [SalesController::class, 'generatePDF'])->name('sales.pdf');

    Route::get('/quotes/raw-materials', [QuoteController::class, 'showRawMaterials'])->name('quotes.raw_materials');
    Route::get('/quotes/raw-materials', [QuoteController::class, 'showRawMaterials'])->name('quotes.raw_materials');
    Route::post('/quotes/select/{rawMaterial}', [QuoteController::class, 'selectRawMaterial'])->name('quotes.select');
    Route::post('/quotes/generate-pdf/{rawMaterial}', [QuoteController::class, 'generatePdf'])->name('quotes.generate-pdf');
    Route::get('sales/{id}', [QuoteController::class, 'show'])->name('sales.show');


    Route::get('/quotes', [QuoteController::class, 'index'])->name('quotes.index');
    Route::post('/quotes/select/{id}', [QuoteController::class, 'select'])->name('quotes.select');
    Route::get('/quotes/preview/{id}', [QuoteController::class, 'preview'])->name('quotes.preview');
    Route::post('/quotes/generate/{id}', [QuoteController::class, 'generate'])->name('quotes.generate');
    Route::get('/quotes', [QuoteController::class, 'index'])->name('quotes.raw_materials');
    Route::get('quotes/preview/{id}', [QuoteController::class, 'preview'])->name('quotes.preview');

    Route::get('/clients/{id}', [ClientController::class, 'getClientData'])->name('clients.data');
    Route::get('/quotes/{quote}/edit', [QuoteController::class, 'edit'])->name('quotes.edit');
    Route::get('/sales/{sale}/edit', [SalesController::class, 'edit'])->name('sales.edit');
    // Define la ruta para actualizar una cotización
    Route::put('/quotes/{quote}', [QuoteController::class, 'update'])->name('quotes.update');
    Route::get('quotes/{id}/pdf', [QuoteController::class, 'generatePdf'])->name('quotes.generatePdf');
    Route::get('/quotes/{id}/pdf', [QuoteController::class, 'generatePdf'])->name('quotes.pdf');
    Route::get('/quotes/generate-pdf/{id}', [QuoteController::class, 'generatePdf'])->name('quotes.generatePdf');

    Route::get('raw-material/cotizacion/{id}', [RawMaterialController::class, 'createCotizacion'])->name('raw_material.createCotizacion');
    Route::get('raw-material/cotizacion/show/{quoteId}', [RawMaterialController::class, 'showCotizacion'])->name('raw_material.showCotizacion');
    Route::get('/raw-materials/material-quote', [CategoriaProductoController::class, 'materialQuote'])->name('raw_material.materialquote');
    Route::get('/raw-materials/material-quote', [QuoteController::class, 'createMaterialQuote'])->name('quotes.materialquote');
    Route::post('/raw-materials/store-material-quote', [QuoteController::class, 'storeMaterialQuote'])->name('quotes.storeMaterialQuote');
    

});


    


require __DIR__.'/auth.php';
