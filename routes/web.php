<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SkillLanguageController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/portfolio/filter',[App\Http\Controllers\HomeController::class, 'filterProjects'])->name('portfolio.filter');

Route::get('/contact/list', [App\Http\Controllers\ContactController::class, 'list'])->name('contact.list');
Route::resource('/contact', App\Http\Controllers\ContactController::class);
Route::post('/projects/{id}/increment-view', [ProjectController::class, 'incrementView'])->name('projects.incrementView');
Route::middleware([RoleMiddleware::class])->name('admin.')->prefix('/admin')->group(function(){
    Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'index'])->name('index');
    Route::get('/qualification/education', [App\Http\Controllers\QualificationController::class,'showEducation'])->name('qualification.edu');
    Route::get('/qualification/experience', [App\Http\Controllers\QualificationController::class,'showExperience'])->name('qualification.exp');
    Route::resource('/qualification', App\Http\Controllers\QualificationController::class);

    Route::resource('/skillLanguage', SkillLanguageController::class);
    //Route::get('/skill/skill', [skillLanguageController::class,'showskill'])->name('skill.skill');
    //Route::get('/skill/language', [SkillLanguageController::class,'showlanguage'])->name('skill.language');

    Route::resource('/service', ServiceController::class);
    //Route::resource('/review', ReviewController::class);
    Route::resource('/category', CategoryController::class);
    Route::get('/portfolio/search', [PortfolioController::class,'search'])->name('portfolio.search');
    Route::resource('/portfolio', PortfolioController::class);
    Route::resource('/project', ProjectController::class);
    Route::resource('/about', AboutController::class);
    Route::resource('/contact', ContactController::class);

   //oute::get('/profile', [UserController::class, 'show'])->name('profile');
//ute::get('/change-password', [UserController::class, 'changePassword'])->name('change-password');
//ute::post('/change-password', [UserController::class, 'updatePassword'])->name('update-password');
//ute::get('/edit-profile', [UserController::class, 'editProfile'])->name('edit-profile');
//ute::post('/edit-profile', [UserController::class, 'updateProfile'])->name('update-profile');
Route::get('/users',[UserController::class, 'users'])->name('user.users');
Route::get('/users/{user}', [UserController::class, 'editUserRole'])->name('user.edit-user-role');
Route::put('/users/{user}', [UserController::class, 'UpdateUserRole'])->name('update-user-role');
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'editProfile'])->name('profile.edit-profile');
    Route::post('/profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update-profile');
    Route::get('/profile/change-password', [ProfileController::class, 'changePassword'])->name('profile.change-password');
    Route::post('/profile/update-password', [ProfileController::class, 'updatePassword'])->name('profile.update-password');
});
