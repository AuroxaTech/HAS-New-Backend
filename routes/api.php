<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\{
    PropertyController,
    ServiceController,
    TenantController,
    PropertyFavouriteController,
    ServiceFavouriteController,
    ReviewController,
    ContractController,
};

Route::post('/register', [authController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


Route::middleware('auth:sanctum')->group(function () {

    /* update profile */
    Route::post('update/profile', [AuthController::class, 'updateProfile']);
    Route::post('update/password', [AuthController::class, 'updatePassword']);

    /* Landlord add Property */
    Route::get('properties', [PropertyController::class, 'index']);
    Route::get('property/{id}', [PropertyController::class, 'show']);
    Route::post('property/store', [PropertyController::class, 'store']);
    Route::post('property/update/{id}', [PropertyController::class, 'update']);
    Route::get('property/delete/{id}', [PropertyController::class, 'destroy']);

    /* Property multiple Images */
    Route::get('property/image/{id}', [PropertyController::class, 'getPropertyImages']);
    Route::post('property/image/update/{id}', [PropertyController::class, 'updatePropertyImages']);
    Route::get('property/image/delete/{id}', [PropertyController::class, 'destroyPropertyImages']);

    /*Add Property favourite */
    Route::get('get-favourite-properties', [PropertyFavouriteController::class, 'index']);
    Route::post('property-favourites', [PropertyFavouriteController::class, 'store']);
    Route::get('property-favourites/delete/{id}', [PropertyFavouriteController::class, 'destroy']);

    /* Service provider add Service */
    Route::get('services', [ServiceController::class, 'index']);
    Route::get('service/{id}', [ServiceController::class, 'show']);
    Route::post('service/store', [ServiceController::class, 'store']);
    Route::post('service/update/{id}', [ServiceController::class, 'update']);
    Route::get('service/delete/{id}', [ServiceController::class, 'destroy']);

    /* Property multiple Images */
    Route::get('service/image/{id}', [ServiceController::class, 'getServiceImages']);
    Route::post('service/image/update/{id}', [ServiceController::class, 'updateServiceImages']);
    Route::get('service/image/delete/{id}', [ServiceController::class, 'destroyServiceImages']);

    /*Add service favourite */
    Route::get('get-favourite-services', [ServiceFavouriteController::class, 'index']);
    Route::post('service-favourites', [ServiceFavouriteController::class, 'store']);
    Route::get('service-favourites/delete/{id}', [ServiceFavouriteController::class, 'destroy']);

    /*Add review */
    Route::post('review', [ReviewController::class, 'store']);
    Route::post('review/update/{id}', [ReviewController::class, 'update']);
    Route::get('review/delete/{id}', [ReviewController::class, 'destroy']);
    Route::get('reviews/{id}', [ReviewController::class, 'getReviewsByService']);

    /* Tenant */
    Route::get('tenants', [TenantController::class, 'index']);
    Route::get('tenant/{id}', [TenantController::class, 'show']);
    Route::post('tenant/store', [TenantController::class, 'store']);
    Route::post('tenant/update/{id}', [TenantController::class, 'update']);
    Route::get('tenant/delete/{id}', [TenantController::class, 'destroy']);

    /* contract */
    Route::get('contracts', [ContractController::class, 'index']);
    Route::get('contract/{id}', [ContractController::class, 'show']);
    Route::post('contract/store', [ContractController::class, 'store']);
    Route::post('contract/update/{id}', [ContractController::class, 'update']);
    Route::get('contract/delete/{id}', [ContractController::class, 'destroy']);

    


});




