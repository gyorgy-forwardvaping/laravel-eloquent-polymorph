<?php

use App\Models\Photo;
use App\Models\Product;
use App\Models\Staff;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/create', function () {
    $staff = Staff::findOrFail(1);
    $staff->photos()->create(['path' => 'new.jpg']);

    $product = Product::findOrFail(1);
    $product->photos()->create(['path' => 'new_test_product.jpg']);
});
Route::get('/assign', function () {
    $staff = Staff::findOrFail(1);
    $staff->photos()->save(Photo::findOrFail(2));
});
Route::get('/read', function () {
    $staff = Staff::findOrFail(1);
    $product = Product::findOrFail(1);
    foreach ($staff->photos as $photo) {
        echo $photo->path . ' -> ' . $photo->imageable_type . '<br>';
    }
    foreach ($product->photos as $photo) {
        echo $photo->path . ' -> ' . $photo->imageable_type . '<br>';
    }
});
Route::get('/update', function () {
    $staff = Staff::findOrFail(1);

    $photo = $staff->photos()->whereId(1)->first();
    $photo->path = "updated_example.php";
    $photo->save();
});
Route::get('/delete', function () {
    $staff = Staff::findOrFail(1);
    $staff->photos()->delete();
});
