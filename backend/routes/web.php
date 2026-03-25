<?php

use Illuminate\Support\Facades\Route;

// Front Controllers
use App\Http\Controllers\Front\DestinoController;
use App\Http\Controllers\Front\TemporadaController;
use App\Http\Controllers\Front\EventoController;
use App\Http\Controllers\Front\BuscadorController;

// Admin Controllers
use App\Http\Controllers\Admin\PanelController;
use App\Http\Controllers\Admin\AdminDestinoController;
use App\Http\Controllers\Admin\AdminTemporadaController;
use App\Http\Controllers\Admin\AdminEventoController;
use App\Http\Controllers\Admin\AdminUsuarioController;

// Auth Controllers
use App\Http\Controllers\Auth\LoginController;

// ============================================================
// RUTAS PÚBLICAS — Lo que ve el turista
// ============================================================

// Página principal
Route::get('/', [DestinoController::class, 'index'])
     ->name('home');

// Listado y detalle de destinos
Route::get('/destinos', [DestinoController::class, 'listado'])
     ->name('destinos.listado');
Route::get('/destinos/{id}', [DestinoController::class, 'detalle'])
     ->name('destinos.detalle');

// Buscador
Route::get('/buscar', [BuscadorController::class, 'buscar'])
     ->name('buscar');

// Temporadas y recomendaciones
Route::get('/temporadas', [TemporadaController::class, 'recomendaciones'])
     ->name('temporadas.index');
Route::get('/temporadas/{mes}', [TemporadaController::class, 'recomendaciones'])
     ->name('temporadas.mes');

// Eventos culturales
Route::get('/eventos', [EventoController::class, 'index'])
     ->name('eventos.index');

// Cambio de idioma
Route::get('/idioma/{idioma}', [BuscadorController::class, 'cambiarIdioma'])
     ->name('idioma.cambiar');

// ============================================================
// RUTAS DE AUTENTICACIÓN
// ============================================================

Route::get('/admin/login', [LoginController::class, 'showLogin'])
     ->name('login');
Route::post('/admin/login', [LoginController::class, 'login'])
     ->name('login.post');
Route::post('/admin/logout', [LoginController::class, 'logout'])
     ->name('logout');

// ============================================================
// RUTAS DEL PANEL ADMINISTRATIVO — protegidas por auth
// ============================================================

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/panel', [PanelController::class, 'index'])
         ->name('panel');

    // Destinos
    Route::get('/destinos',              [AdminDestinoController::class, 'index'])
         ->name('destinos.index');
    Route::get('/destinos/crear',        [AdminDestinoController::class, 'create'])
         ->name('destinos.create');
    Route::post('/destinos',             [AdminDestinoController::class, 'store'])
         ->name('destinos.store');
    Route::get('/destinos/{id}/editar',  [AdminDestinoController::class, 'edit'])
         ->name('destinos.edit');
    Route::put('/destinos/{id}',         [AdminDestinoController::class, 'update'])
         ->name('destinos.update');
    Route::delete('/destinos/{id}',      [AdminDestinoController::class, 'destroy'])
         ->name('destinos.destroy');

    // Temporadas
    Route::get('/temporadas',             [AdminTemporadaController::class, 'index'])
         ->name('temporadas.index');
    Route::get('/temporadas/crear',       [AdminTemporadaController::class, 'create'])
         ->name('temporadas.create');
    Route::post('/temporadas',            [AdminTemporadaController::class, 'store'])
         ->name('temporadas.store');
    Route::get('/temporadas/{id}/editar', [AdminTemporadaController::class, 'edit'])
         ->name('temporadas.edit');
    Route::put('/temporadas/{id}',        [AdminTemporadaController::class, 'update'])
         ->name('temporadas.update');
    Route::delete('/temporadas/{id}',     [AdminTemporadaController::class, 'destroy'])
         ->name('temporadas.destroy');

    // Eventos
    Route::get('/eventos',             [AdminEventoController::class, 'index'])
         ->name('eventos.index');
    Route::get('/eventos/crear',       [AdminEventoController::class, 'create'])
         ->name('eventos.create');
    Route::post('/eventos',            [AdminEventoController::class, 'store'])
         ->name('eventos.store');
    Route::get('/eventos/{id}/editar', [AdminEventoController::class, 'edit'])
         ->name('eventos.edit');
    Route::put('/eventos/{id}',        [AdminEventoController::class, 'update'])
         ->name('eventos.update');
    Route::delete('/eventos/{id}',     [AdminEventoController::class, 'destroy'])
         ->name('eventos.destroy');

    // Usuarios
    Route::get('/usuarios',             [AdminUsuarioController::class, 'index'])
         ->name('usuarios.index');
    Route::get('/usuarios/crear',       [AdminUsuarioController::class, 'create'])
         ->name('usuarios.create');
    Route::post('/usuarios',            [AdminUsuarioController::class, 'store'])
         ->name('usuarios.store');
    Route::get('/usuarios/{id}/editar', [AdminUsuarioController::class, 'edit'])
         ->name('usuarios.edit');
    Route::put('/usuarios/{id}',        [AdminUsuarioController::class, 'update'])
         ->name('usuarios.update');
    Route::delete('/usuarios/{id}',     [AdminUsuarioController::class, 'destroy'])
         ->name('usuarios.destroy');

});
