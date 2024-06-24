<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\ListController;

Route::get('/', [ListController::class, 'showAllTasks']);

Route::post('/create-task', [ListController::class, 'createTask'] )->name('tasks.create');

Route::put('/update-task/{id}' , [ListController::class, 'updateTask'])->name('tasks.update');

Route::delete('/delete-task/{id}', [ListController::class, 'destroyTask'])->name('tasks.destroy');
