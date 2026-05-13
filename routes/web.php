<?php

use App\Livewire\Admin\Pages\Banners;
use App\Livewire\Admin\Pages\Collections;
use App\Livewire\Admin\Pages\Dashboard;
use App\Livewire\Admin\Pages\Login;
use App\Livewire\Admin\Pages\Products;
use App\Livewire\Admin\Pages\Users;
use App\Livewire\Pages\Catalog;
use App\Livewire\Pages\CollectionShow;
use App\Livewire\Pages\Contact;
use App\Livewire\Pages\Favorites;
use App\Livewire\Pages\Home;
use App\Livewire\Pages\ProductDetail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| Storage — serve arquivos do disco público sem depender de symlink
|--------------------------------------------------------------------------
*/

Route::get('/storage/{path}', function (string $path) {
    abort_unless(Storage::disk('public')->exists($path), 404);

    return Storage::disk('public')->response($path);
})->where('path', '.*')->name('storage.serve');

/*
|--------------------------------------------------------------------------
| Verônica's Fashion — Rotas do catálogo cliente
|--------------------------------------------------------------------------
|
| Todas as páginas são componentes Livewire de página completa.
| Convenção do menu lateral:
|   home             → /
|   catalog.featured → /destaques
|   catalog.new      → /nova-colecao
|   catalog.sale     → /promocoes
|   catalog.category → /categoria/{category}
|   catalog.occasion → /ocasiao/{occasion}
|   product.show     → /produto/{slug}
|   collection.show  → /colecao/{slug}
|   favorites        → /favoritos
|   contact          → /contato
|
*/

Route::get('/', Home::class)->name('home');

// ---- Catálogo (variantes) ----
Route::get('/destaques', Catalog::class)
    ->defaults('mode', 'featured')
    ->name('catalog.featured');

Route::get('/nova-colecao', Catalog::class)
    ->defaults('mode', 'new')
    ->name('catalog.new');

Route::get('/promocoes', Catalog::class)
    ->defaults('mode', 'sale')
    ->name('catalog.sale');

Route::get('/categoria/{category}', Catalog::class)
    ->defaults('mode', 'category')
    ->where('category', '[a-z0-9-]+')
    ->name('catalog.category');

Route::get('/ocasiao/{occasion}', Catalog::class)
    ->defaults('mode', 'occasion')
    ->name('catalog.occasion');

// ---- Detalhes ----
Route::get('/produto/{slug}', ProductDetail::class)
    ->where('slug', '[a-z0-9-]+')
    ->name('product.show');

Route::get('/colecao/{slug}', CollectionShow::class)
    ->where('slug', '[a-z0-9-]+')
    ->name('collection.show');

// ---- Páginas auxiliares ----
Route::get('/favoritos', Favorites::class)->name('favorites');
Route::get('/contato', Contact::class)->name('contact');

/*
|--------------------------------------------------------------------------
| Admin — Dashboard administrativo
|--------------------------------------------------------------------------
|
| admin.login          → /admin/login
| admin.dashboard      → /admin
| admin.products.*     → /admin/produtos
| admin.banners.*      → /admin/banners
| admin.collections.*  → /admin/colecoes
| admin.users.*        → /admin/usuarios
|
*/

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', Login::class)->name('login')->middleware('guest');

    Route::middleware('auth')->group(function () {
        Route::get('/', Dashboard::class)->name('dashboard');

        // Produtos
        Route::get('/produtos', Products\Index::class)->name('products.index');
        Route::get('/produtos/novo', Products\Create::class)->name('products.create');
        Route::get('/produtos/{id}', Products\Edit::class)->name('products.edit');

        // Banners
        Route::get('/banners', Banners\Index::class)->name('banners.index');
        Route::get('/banners/novo', Banners\Create::class)->name('banners.create');
        Route::get('/banners/{id}', Banners\Edit::class)->name('banners.edit');

        // Coleções
        Route::get('/colecoes', Collections\Index::class)->name('collections.index');
        Route::get('/colecoes/novo', Collections\Create::class)->name('collections.create');
        Route::get('/colecoes/{id}', Collections\Edit::class)->name('collections.edit');

        // Usuários
        Route::get('/usuarios', Users\Index::class)->name('users.index');
        Route::get('/usuarios/novo', Users\Create::class)->name('users.create');
        Route::get('/usuarios/{id}', Users\Edit::class)->name('users.edit');
    });
});
