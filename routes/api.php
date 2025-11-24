<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticateUser;
use App\Http\Controllers\Contacts;
use App\Http\Controllers\Chats;
use App\Http\Controllers\SearchUsers;
use App\Http\Controllers\Connect;
use App\Http\Controllers\Notifications;


Route::post('/user', [AuthenticateUser::class, 'createUser']);
Route::post('/users', [Contacts::class, 'searchUsers']);
Route::get('/searchList', [SearchUsers::class, 'searchUsers']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/connectrequest', [Connect::class, 'connectionRequest']);
    Route::get('/fetchNotifications', [Notifications::class, 'getNotifications']);
    Route::post('/requestAccepted', [Connect::class, 'requestAccepted']);
    Route::post('/requestRejected', [Connect::class, 'requestRejected']);
    Route::get('/getContacts', [Contacts::class, 'getContacts']);
    Route::post('/saveMyMsg', [Chats::class, 'saveMessage']);
});
