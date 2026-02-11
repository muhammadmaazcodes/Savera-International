<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\PortController;
use App\Http\Controllers\PaymentTypeController;
use App\Http\Controllers\PaymentTermController;
use App\Http\Controllers\PaymentRecordController;
use App\Http\Controllers\VesselAllocationController;
use App\Http\Controllers\VesselController;
use App\Http\Controllers\LocalContractController;
use App\Http\Controllers\SalesRequestController;
use App\Http\Controllers\NotesController;
use App\Http\Controllers\InternationalContractController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\SurveyorController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\SalesContractController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TransactionTypeController;
use App\Http\Controllers\LiftingController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\CustomPaymentController;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Concerns\ToArray;

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

Route::get('/', [DashboardController::class, 'index'])->middleware(['auth', 'verified']);

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/error', function () {
    abort(500);
});

require __DIR__.'/auth.php';

Route::resource('companies', CompanyController::class)->middleware(['auth', 'verified']);
Route::resource('expense', ExpenseController::class)->middleware(['auth', 'verified']);
Route::resource('surveyor', SurveyorController::class)->middleware(['auth', 'verified']);
Route::resource('collection', CollectionController::class)->middleware(['auth', 'verified']);

Route::post('/bulk/store', [CollectionController::class, 'bulk_store'])->middleware(['auth', 'verified'])->name('collect.bulk.store');
Route::get('/add-bulk/collection', [CollectionController::class, 'bulk'])->middleware(['auth', 'verified']);

Route::get('/general-ledger', [PaymentRecordController::class, 'index'])->middleware(['auth', 'verified']);

Route::get('/payment/inventory', [PaymentRecordController::class, 'inventory'])->middleware(['auth', 'verified']);
Route::get('/payment/local-contract', [PaymentRecordController::class, 'local_contract'])->middleware(['auth', 'verified']);

Route::post('/payment/inventory', [PaymentRecordController::class, 'payment_invetory'])->middleware(['auth', 'verified'])->name('payment.inventory.store');
Route::post('/payment/local-contract', [PaymentRecordController::class, 'payment_contract'])->middleware(['auth', 'verified'])->name('payment.local-contract.store');

Route::get('/temporary-contract',[SalesContractController::class, 'temp_index'])->middleware(['auth', 'verified']);
Route::get('/temporary-contract/edit/{id}',[SalesContractController::class, 'temp_edit'])->middleware(['auth', 'verified']);
Route::get('/normal-contract',[SalesContractController::class, 'normal_index'])->middleware(['auth', 'verified']);
Route::get('/barter-contract',[SalesContractController::class, 'barter_index'])->middleware(['auth', 'verified']);
Route::get('/barter-contract/edit/{id}',[SalesContractController::class, 'barter_edit'])->middleware(['auth', 'verified']);

Route::resource('international-contract', InternationalContractController::class)->middleware(['auth', 'verified']);
Route::get('/international-contract-split/{id}', [InternationalContractController::class, 'contract_split'])->middleware(['auth', 'verified'])->name('contract.split');
Route::get('/international-contract-washout/{id}', [InternationalContractController::class, 'washout'])->middleware(['auth', 'verified'])->name('washout');
Route::post('/international-contract-split/store', [InternationalContractController::class, 'contract_split_store'])->middleware(['auth', 'verified'])->name('contract.split.store');
Route::post('/international-contract/doc-upload', [InternationalContractController::class, 'upload_document'])->middleware(['auth', 'verified']);

Route::put('/companies_addresses/update/{id}', [CompanyController::class, 'update_address'])->middleware(['auth', 'verified'])->name('company.address.update');
Route::delete('/companies_addresses/delete/{id}', [CompanyController::class, 'delete_address'])->middleware(['auth', 'verified'])->name('company.address.delete');

Route::resource('businesses', BusinessController::class)->middleware(['auth', 'verified']);
Route::resource('transaction-type', TransactionTypeController::class)->middleware(['auth', 'verified']);

Route::put('/businesses_addresses/update/{id}', [BusinessController::class, 'update_address'])->middleware(['auth', 'verified'])->name('business.address.update');
Route::delete('/businesses_addresses/delete/{id}', [BusinessController::class, 'delete_address'])->middleware(['auth', 'verified'])->name('business.address.delete');

Route::get('/options', [\App\Http\Controllers\OptionController::class, 'index'])->middleware(['auth', 'verified']);
Route::put('/options/update', [\App\Http\Controllers\OptionController::class, 'update'])->middleware(['auth', 'verified']);
// Route::put('/options/{name}/update', [\App\Http\Controllers\OptionController::class, 'update'])->middleware(['auth', 'verified']);

Route::resource('notes', NotesController::class)->middleware(['auth', 'verified']);
Route::get('status-update/notes/{id}', [NotesController::class,'status_update'])->middleware(['auth', 'verified'])->name('notes.status-update');
Route::resource('products', ProductController::class)->middleware(['auth', 'verified']);
Route::resource('ports', PortController::class)->middleware(['auth', 'verified']);
Route::resource('payment-types', PaymentTypeController::class)->middleware(['auth', 'verified']);
Route::resource('payment-terms', PaymentTermController::class)->middleware(['auth', 'verified']);
Route::resource('vessels', VesselController::class)->middleware(['auth', 'verified']);
Route::resource('terminals', \App\Http\Controllers\TerminalController::class)->middleware(['auth', 'verified']);
Route::resource('bank-accounts', \App\Http\Controllers\BankAccountController::class)->middleware(['auth', 'verified']);

Route::resource('inventories', \App\Http\Controllers\InventoryController::class)->middleware(['auth', 'verified']);
Route::get('inventories/{id}/show', [\App\Http\Controllers\InventoryController::class,'show'])->middleware(['auth', 'verified'])->name('inventories.show');
Route::get('inventories/{id}/view', [\App\Http\Controllers\InventoryController::class,'view_inv'])->middleware(['auth', 'verified'])->name('inventories.view');
Route::get('inventories/{id}/detail', [\App\Http\Controllers\InventoryController::class,'detail'])->middleware(['auth', 'verified']);
Route::get('inventories/bl/{id}/show', [\App\Http\Controllers\InventoryController::class,'show_bl'])->middleware(['auth', 'verified'])->name('show.bl');
Route::get('inventory/document/delete/{id}', [\App\Http\Controllers\InventoryController::class,'delete_doc'])->middleware(['auth', 'verified'])->name('document.delete');
Route::post('inventory/document/add', [\App\Http\Controllers\InventoryController::class,'add_doc'])->middleware(['auth', 'verified'])->name('add.inventory.document');
Route::post('/inventories_bls/add/{id}', [\App\Http\Controllers\InventoryController::class, 'add_bls'])->middleware(['auth', 'verified'])->name('inventory.bls.add');
Route::put('/inventories_bls/update/{id}', [\App\Http\Controllers\InventoryController::class, 'update_bl'])->middleware(['auth', 'verified'])->name('inventory.bls.update');
Route::get('/inventories_bls/view/{id}', [\App\Http\Controllers\InventoryController::class, 'view_bl'])->middleware(['auth', 'verified'])->name('bl.view');
Route::delete('/inventories_bls/delete/{id}', [\App\Http\Controllers\InventoryController::class, 'delete_bl'])->middleware(['auth', 'verified'])->name('inventory.bls.delete');
Route::get('inventories/{id}/liftings', [\App\Http\Controllers\InventoryController::class,'liftings'])->middleware(['auth', 'verified'])->name('show.liftings');
Route::post('inventories/{id}/add-stock', [\App\Http\Controllers\InventoryController::class,'add_stock'])->middleware(['auth', 'verified'])->name('inventory.add.stock');
Route::put('inventory/update-stock/{id}', [\App\Http\Controllers\InventoryController::class,'update_stock'])->middleware(['auth', 'verified'])->name('inventory.update.stock');
Route::delete('inventory/delete-stock/{id}', [\App\Http\Controllers\InventoryController::class,'delete_stock'])->middleware(['auth', 'verified'])->name('inventory.delete.stock');
Route::get('get-bl/{id}', [\App\Http\Controllers\InventoryController::class,'getBL'])->middleware(['auth', 'verified']);
Route::get('get-inv/{id}', [\App\Http\Controllers\InventoryController::class,'getInv'])->middleware(['auth', 'verified']);
Route::get('edit-bl-terminal', [\App\Http\Controllers\InventoryController::class,'edit_terminal'])->middleware(['auth', 'verified']);
Route::get('search-bl', [\App\Http\Controllers\InventoryController::class,'search_bl'])->middleware(['auth', 'verified']);
Route::get('get-unsold-qty-product/{id}/{product}', [\App\Http\Controllers\InventoryController::class,'unsold_qty'])->middleware(['auth', 'verified']);
Route::get('get-commingles/{id}', [\App\Http\Controllers\InventoryController::class,'get_commingle'])->middleware(['auth', 'verified'])->name('get.bls.commingle');
Route::post('save-commingles/{id}', [\App\Http\Controllers\InventoryController::class,'save_commingle'])->middleware(['auth', 'verified'])->name('save.bls.commingle');
Route::get('commingle/delete/{id}', [\App\Http\Controllers\InventoryController::class, 'delete_commingle'])->middleware(['auth', 'verified'])->name('commingle.delete');

Route::get('get-terminal/{id}',[SalesRequestController::class,'getTerminals']);

Route::resource('clearing-agents', \App\Http\Controllers\ClearingAgentController::class)->middleware(['auth', 'verified']);
Route::resource('document', \App\Http\Controllers\DocumentController::class)->middleware(['auth', 'verified']);
Route::resource('local-contract', LocalContractController::class)->middleware(['auth', 'verified']);
Route::get('local-contracts/inventories', [LocalContractController::class, 'inventory'])->middleware(['auth', 'verified']);
Route::get('local-contracts/price-update', [LocalContractController::class, 'price_update'])->middleware(['auth', 'verified']);
Route::get('local-contracts/split/{id}', [LocalContractController::class, 'split'])->middleware(['auth', 'verified']);
Route::post('local-contracts/split/{id}', [LocalContractController::class, 'split_store'])->middleware(['auth', 'verified']);

Route::get('local-contracts/vessel-allocation', [VesselAllocationController::class, 'index'])->middleware(['auth', 'verified']);
Route::get('local-contracts/vessel-allocation/delete/{id}', [VesselAllocationController::class, 'delete'])->middleware(['auth', 'verified'])->name('vessel_allocation.delete');
Route::get('local-contracts/bl-allocation/delete/{id}', [VesselAllocationController::class, 'bl_delete'])->middleware(['auth', 'verified'])->name('bl_allocation.delete');

Route::get('local-contracts/bl-allocation/{id}', [VesselAllocationController::class, 'bl_index'])->middleware(['auth', 'verified']);
Route::post('local-contracts/bl-allocation/{id}', [VesselAllocationController::class, 'bl_allocate'])->middleware(['auth', 'verified']);
Route::post('local-contracts/allocate-vessel/{id}', [VesselAllocationController::class, 'allocate'])->name('allocate.vessel')->middleware(['auth', 'verified']);

Route::get('local-contracts/vessel', [LocalContractController::class, 'vessel'])->middleware(['auth', 'verified']);
Route::get('local-contracts/buyer', [LocalContractController::class, 'buyer'])->middleware(['auth', 'verified']);
Route::get('local-contracts/seller', [LocalContractController::class, 'seller'])->middleware(['auth', 'verified']);
Route::get('local-contracts/contracts', [LocalContractController::class, 'contracts'])->middleware(['auth', 'verified']);

Route::get('local-contracts/view-contract/{id}', [LocalContractController::class, 'view_contract'])->middleware(['auth', 'verified']);

Route::get('local-contracts/washout/{id}', [LocalContractController::class, 'washout'])->middleware(['auth', 'verified']);
Route::post('local-contracts/washout/{id}', [LocalContractController::class, 'washout_store'])->middleware(['auth', 'verified']);


Route::post('local-contracts/export', [LocalContractController::class, 'export'])->name('local-contract.export')->middleware(['auth', 'verified']);

Route::get('get-contract/{id}',[LocalContractController::class, 'getContract'])->name('get.contract');
Route::post('save-contract-message',[LocalContractController::class, 'SaveMessage'])->name('save.message');
Route::post('update-contract-price/{id}',[LocalContractController::class, 'UpdatePrice']);

Route::get('local-contract/barter/create', [LocalContractController::class, 'barter_create'])->middleware(['auth', 'verified'])->name('local-contract.barter');
Route::get('local-contract/temp/create', [LocalContractController::class, 'temp_create'])->middleware(['auth', 'verified'])->name('local-contract.temp');
Route::get('local-contract/barter/index', [LocalContractController::class, 'barter_index'])->middleware(['auth', 'verified'])->name('barter.index');
Route::get('local-contract/temp/index', [LocalContractController::class, 'temp_index'])->middleware(['auth', 'verified'])->name('temp.index');
Route::get('local-contract/temp/return-contract/{id}', [LocalContractController::class, 'return_contract'])->middleware(['auth', 'verified'])->name('temp.return_contract');
Route::get('local-contract/temp/return-contract/edit/{id}', [LocalContractController::class, 'return_contract_edit'])->middleware(['auth', 'verified'])->name('temp.return_contract_edit');

Route::get('local-contract/barter/return-contract/{id}', [LocalContractController::class, 'return_barter'])->middleware(['auth', 'verified'])->name('barter.return_contract');
Route::get('local-contract/barter/return-contract/edit/{id}', [LocalContractController::class, 'return_barter_edit'])->middleware(['auth', 'verified'])->name('barter.return_contract_edit');


Route::get('/check-quantity', [LocalContractController::class, 'CheckQuantity'])->middleware(['auth', 'verified'])->name('check.quantity');
Route::get('/datatable-search', [LocalContractController::class, 'datatable_search'])->middleware(['auth', 'verified'])->name('datatable.search');

Route::get('/update-quantity/{id}', [LocalContractController::class, 'UpdateQuantity'])->middleware(['auth', 'verified'])->name('update.quantity');
Route::get('/update-rate/{id}', [LocalContractController::class, 'UpdateRate'])->middleware(['auth', 'verified'])->name('update.rate');
Route::get('/update-product/{id}', [LocalContractController::class, 'UpdateProduct'])->middleware(['auth', 'verified'])->name('update.product');

Route::get('local-contracts/edit-qty/{id}',[LocalContractController::class,'EditQty'])->name('contract.edit-qty');
Route::get('local-contracts/edit-rate/{id}',[LocalContractController::class,'EditRate'])->name('contract.edit-rate');
Route::get('local-contracts/edit-product/{id}',[LocalContractController::class,'EditProduct'])->name('contract.edit-product');

Route::get('/sales-request', [SalesRequestController::class, 'index'])->middleware(['auth', 'verified']);
Route::get('/sales-request/process', [SalesRequestController::class, 'process_index'])->middleware(['auth', 'verified']);
Route::get('/sales-request/process/{id}/edit', [SalesRequestController::class, 'process_edit'])->middleware(['auth', 'verified'])->name('sale.process.edit');
Route::get('/sales-request/success', [SalesRequestController::class, 'success_index'])->middleware(['auth', 'verified']);
Route::get('/sales-request/allocation', [SalesRequestController::class, 'allocation_index'])->middleware(['auth', 'verified']);
Route::get('/sales-request/success/{id}/edit', [SalesRequestController::class, 'success_edit'])->middleware(['auth', 'verified'])->name('sale.success.edit');
Route::get('/sales-request/delete-contract/{id}', [SalesRequestController::class, 'sale_contract_delete'])->middleware(['auth', 'verified'])->name('sale_contract.delete');
Route::post('/sales-request/store', [SalesRequestController::class, 'store'])->middleware(['auth', 'verified'])->name('sales.request.store');
Route::get('/sales-request/add-lifting/{id}', [SalesRequestController::class, 'add_lifting'])->middleware(['auth', 'verified'])->name('sales.add_lifting');
Route::get('/sales-request/edit/{id}', [SalesRequestController::class, 'edit'])->middleware(['auth', 'verified'])->name('sales.edit');
Route::post('/sales-request/update/{id}', [SalesRequestController::class, 'update'])->middleware(['auth', 'verified'])->name('sales.update');
Route::get('/create-contract/{id}', [SalesRequestController::class, 'contract_sale'])->middleware(['auth', 'verified'])->name('sales.contract');
Route::post('/store-contract', [SalesRequestController::class, 'contract_store'])->middleware(['auth', 'verified'])->name('sales.contract.store');
Route::get('/sales-request/check-qty', [SalesRequestController::class, 'check_qty'])->middleware(['auth', 'verified']);
Route::get('/sales-request/export', [SalesRequestController::class, 'export'])->middleware(['auth', 'verified']);
Route::get('sales-request/view/{id}', [SalesRequestController::class, 'view_lifting'])->middleware(['auth', 'verified'])->name('view.lifting');
Route::get('sales-request/delete/{id}', [SalesRequestController::class, 'delete'])->middleware(['auth', 'verified'])->name('sales.delete');
Route::get('sales-request/get-inv/{product}', [SalesRequestController::class, 'getInv'])->middleware(['auth', 'verified'])->name('get.inv.product');


Route::post('/lifting/store', [LiftingController::class, 'store'])->middleware(['auth', 'verified'])->name('lifting.store');
Route::get('/get-sale/{id}', [SalesRequestController::class, 'getSale'])->middleware(['auth', 'verified']);
Route::get('update-lifting-status/{id}', [SalesRequestController::class, 'update_lifting_status'])->middleware(['auth', 'verified']);

Route::get('/emails', [EmailController::class, 'receiveEmails'])->middleware(['auth', 'verified']);
Route::get('/emails/show/{id}', [EmailController::class, 'show'])->middleware(['auth', 'verified'])->name('mail.show');
Route::get('/emails/assign-to', [EmailController::class, 'assign_to'])->middleware(['auth', 'verified'])->name('mail.assign_to');

Route::get('activity-logs',[ActivityLogController::class, 'index'])->middleware(['auth', 'verified']);

// CUSTOM PAYMENTS
Route::get('/custom-payments/posting-date', [CustomPaymentController::class, 'posting_date'])->middleware(['auth', 'verified']);
Route::get('/custom-payments/vessel', [CustomPaymentController::class, 'vessel'])->middleware(['auth', 'verified']);
Route::get('/custom-payments/customer', [CustomPaymentController::class, 'customer'])->middleware(['auth', 'verified']);
Route::get('/custom-payments/transaction', [CustomPaymentController::class, 'transaction'])->middleware(['auth', 'verified']);
Route::get('/custom-payments/create-cash', [CustomPaymentController::class, 'create_cash'])->middleware(['auth', 'verified']);
Route::get('/custom-payments/edit-cash/{id}', [CustomPaymentController::class, 'edit_cash'])->middleware(['auth', 'verified']);
Route::get('/custom-payments/create-settlement', [CustomPaymentController::class, 'create_settlement'])->middleware(['auth', 'verified']);
Route::get('/custom-payments/edit-settlement/{id}', [CustomPaymentController::class, 'edit_settlement'])->middleware(['auth', 'verified']);
Route::get('/custom-payments/create-bank-deposit', [CustomPaymentController::class, 'create_bank_deposit'])->middleware(['auth', 'verified']);
Route::get('/custom-payments/edit-bank-deposit/{id}', [CustomPaymentController::class, 'edit_bank_deposit'])->middleware(['auth', 'verified']);
Route::get('/custom-payments/view-bank-deposit/{id}', [CustomPaymentController::class, 'view_bank_deposit'])->middleware(['auth', 'verified']);

Route::post('/custom-payments/store', [CustomPaymentController::class, 'store'])->middleware(['auth', 'verified']);
Route::put('/custom-payments/update/{id}', [CustomPaymentController::class, 'update'])->middleware(['auth', 'verified']);
Route::delete('/custom-payments/destroy/{id}', [CustomPaymentController::class, 'destroy'])->middleware(['auth', 'verified']);
Route::get('/custom-payments/destroy-cheque/{id}', [CustomPaymentController::class, 'destroy_cheque'])->middleware(['auth', 'verified']);
Route::get('/custom-payments/verify/{id}', [CustomPaymentController::class, 'verify'])->middleware(['auth', 'verified']);
Route::get('/custom-payments/cancel/{id}', [CustomPaymentController::class, 'cancel'])->middleware(['auth', 'verified']);
Route::post('/custom-payments/update-bulk-status', [CustomPaymentController::class, 'bulk_status'])->middleware(['auth', 'verified']);
Route::get('payment-cheque/update/{id}', [CustomPaymentController::class, 'UpdateCheque'])->middleware(['auth', 'verified'])->name('update.cheque');
Route::resource('accounts', AccountController::class);
Route::get('account/chart',[AccountController::class,'chart']);
Route::get('coa/create',[AccountController::class,'coa_create']);
Route::get('get-account/{id}',[AccountController::class,'getAccount']);
Route::resource('journals', JournalController::class);

Route::get('local-contracts/reduce-qty/{id}/{qty}',[LocalContractController::class,'EditReduceQty'])->name('edit.reduce-qty');
Route::post('local-contracts/update-reduce-qty/{id}/{qty}',[LocalContractController::class,'UpdateReduceQty'])->name('update.reduce-qty');

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
});

Route::get('cost-calculator',function() {
    $options = \App\Models\Option::get();
    $values = [];        
    foreach ($options as $option) {
        $values[$option->name] = $option->content;    
    }
    return view('pages.calculator.index',compact('values')); 
})->middleware(['auth', 'verified']);


Route::get('morph-rel',function(){
    $bls = App\Models\InventoryBL::find(1);
    return $bls->document;
});