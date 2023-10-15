<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\SectionsController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\InvoiceDetailsController;
use App\Http\Controllers\InvoiceAchiveController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('invoices', InvoiceController::class);

Route::resource('sections' , SectionsController::class);

Route::resource('products', ProductsController::class);

Route::get('product-by-section/{id}',function ($id){
return response()->json(Product::where('section_id',$id)->pluck('Product_name','id'));
})->name('product-by-section');

Route::get('InvoicesDetails/{id}', [InvoiceDetailsController::class, 'edit'])->name('InvoicesDetails');

Route::get('download/{invoice_number}/{file_name}', [InvoiceDetailsController::class , 'get_file'])->name('get file');

Route::get('View_file/{invoice_number}/{file_name}', [InvoiceDetailsController::class,'open_file'])->name('View_file');

Route::post('delete_file', [InvoiceDetailsController::class ,'destroy'])->name('delete_file');

Route::get('edit_invoice/{id}', [InvoiceController::class,'edit'])->name('edit_invoice');


Route::get('status_show/{id}',[InvoiceController::class,'show'])->name('status_show');

Route::post('Status_Update/{id}', [InvoiceController::class,'Status_update'])->name('Status_update');

Route::resource('Archive', InvoiceAchiveController::class);

Route::get('invoices_paid',[InvoiceController::class ,'invoice_paid']);

Route::get('invoices_unpaid',[InvoiceController::class ,'invoice_unPaid']);

Route::get('invoices_partial',[InvoiceController::class ,'invoice_partial']);





Route::get('hamada/{page}', [AdminController::class,'index']);  

