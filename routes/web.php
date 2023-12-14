<?php

use App\Http\Controllers\FacilityController;
use App\Http\Controllers\Organization\BranchController;
use App\Http\Controllers\Organization\ContactController;
use App\Http\Controllers\Organization\DashboardController;
use App\Http\Controllers\Organization\RoleController;
use App\Http\Controllers\Organization\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => redirect()->route('dashboard'));

/**
 * Redirects the user to their dashboard
 */
Route::get('/dashboard', function () {

    return redirect()->route('organization.dashboard');

})->middleware(['auth'])->name('dashboard');



Route::prefix('dashboard/o/')
    ->name('organization.')
    ->middleware(['auth'])
    ->group(function () {

        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        # Role
        Route::prefix('role')
            ->name('role.')
            ->group(function () {
                Route::get('/', [RoleController::class, 'index'])->middleware(['permission:role:index'])->name('index');
                Route::get('create', [RoleController::class, 'create'])->middleware(['permission:role:create'])->name('create');
                Route::get('{role:id}/edit', [RoleController::class, 'edit'])->middleware(['permission:role:edit'])->name('edit');
            });

        # User
        Route::prefix('users')
            ->name('user.')
            ->group(function () {

                Route::get('/', [UserController::class, 'index'])->middleware(['permission:user:index'])->name('index');
                Route::get('create', [UserController::class, 'create'])->middleware(['permission:user:create'])->name('create');
                Route::get('edit/{user}', [UserController::class, 'edit'])->middleware(['permission:user:edit'])->name('edit');
            });

        # Profile
        Route::view('profile', 'users.organization.profile')->name('profile');


        # Contact
        Route::prefix('contact')
            ->name('contact.')
            ->group(function () {
                Route::get('/', [ContactController::class, 'index'])->name('index');
                Route::get('create', [ContactController::class, 'create'])->name('create');
                Route::get('{contact:id}/edit', [ContactController::class, 'edit'])->name('edit');
            });

        # Facility
        Route::prefix('facility')
            ->name('facility.')
            ->group(function () {
                Route::get('/', [FacilityController::class, 'index'])->name('index');
                Route::get('create', [FacilityController::class, 'create'])->name('create');
                Route::get('{id}/edit', [FacilityController::class, 'edit'])->name('edit');
            });

        # Branch
        Route::prefix('branch')
            ->name('branch.')
            ->group(function () {
                Route::get('/', [BranchController::class, 'index'])->name('index');
                Route::get('create', [BranchController::class, 'create'])->name('create');
                Route::get('{branch:id}/edit', [BranchController::class, 'edit'])->name('edit');
            });

        # Calendar
        Route::get('calendar', [DashboardController::class, 'calendar'])->name('calendar');
    });



/**
 * Auth routes
 */
require __DIR__ . '/auth.php';

?>
