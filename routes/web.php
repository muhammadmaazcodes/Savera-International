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

require __DIR__.'/auth.php';

Route::group(['middleware' => ['auth']], function() {

Route::get('/', [DashboardController::class, 'index']);

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/error', function () {
    abort(500);
});


Route::group(['middleware' => ['collection']], function() {
    // CUSTOM PAYMENTS
    Route::get('/custom-payments/posting-date', [CustomPaymentController::class, 'posting_date']);
    Route::get('/custom-payments/vessel', [CustomPaymentController::class, 'vessel']);
    Route::get('/custom-payments/customer', [CustomPaymentController::class, 'customer']);
    Route::get('/custom-payments/transaction', [CustomPaymentController::class, 'transaction']);
    Route::get('/custom-payments/create-cash', [CustomPaymentController::class, 'create_cash']);
    Route::get('/custom-payments/edit-cash/{id}', [CustomPaymentController::class, 'edit_cash']);
    Route::get('/custom-payments/create-settlement', [CustomPaymentController::class, 'create_settlement']);
    Route::get('/custom-payments/edit-settlement/{id}', [CustomPaymentController::class, 'edit_settlement']);
    Route::get('/custom-payments/create-bank-deposit', [CustomPaymentController::class, 'create_bank_deposit']);
    Route::get('/custom-payments/edit-bank-deposit/{id}', [CustomPaymentController::class, 'edit_bank_deposit']);
    Route::get('/custom-payments/view-bank-deposit/{id}', [CustomPaymentController::class, 'view_bank_deposit']);

    Route::post('/custom-payments/store', [CustomPaymentController::class, 'store']);
    Route::put('/custom-payments/update/{id}', [CustomPaymentController::class, 'update']);
    Route::delete('/custom-payments/destroy/{id}', [CustomPaymentController::class, 'destroy']);
    Route::get('/custom-payments/destroy-cheque/{id}', [CustomPaymentController::class, 'destroy_cheque']);
    Route::get('/custom-payments/verify/{id}', [CustomPaymentController::class, 'verify']);
    Route::get('/custom-payments/cancel/{id}', [CustomPaymentController::class, 'cancel']);
    Route::post('/custom-payments/update-bulk-status', [CustomPaymentController::class, 'bulk_status']);
    Route::get('payment-cheque/update/{id}', [CustomPaymentController::class, 'UpdateCheque'])->name('update.cheque');
    Route::resource('collection', CollectionController::class);
    Route::post('/bulk/store', [CollectionController::class, 'bulk_store'])->name('collect.bulk.store');
    Route::get('/add-bulk/collection', [CollectionController::class, 'bulk']);

});

Route::group(['middleware' => ['lic']], function() {
    // INV Routes
    Route::resource('inventories', \App\Http\Controllers\InventoryController::class);
    Route::get('inventories/{id}/show', [\App\Http\Controllers\InventoryController::class,'show'])->name('inventories.show');
    Route::get('inventories/{id}/view', [\App\Http\Controllers\InventoryController::class,'view_inv'])->name('inventories.view');
    Route::get('inventories/{id}/detail', [\App\Http\Controllers\InventoryController::class,'detail']);
    Route::get('inventories/bl/{id}/show', [\App\Http\Controllers\InventoryController::class,'show_bl'])->name('show.bl');
    Route::get('inventory/document/delete/{id}', [\App\Http\Controllers\InventoryController::class,'delete_doc'])->name('document.delete');
    Route::post('inventory/document/add', [\App\Http\Controllers\InventoryController::class,'add_doc'])->name('add.inventory.document');
    Route::post('/inventories_bls/add/{id}', [\App\Http\Controllers\InventoryController::class, 'add_bls'])->name('inventory.bls.add');
    Route::put('/inventories_bls/update/{id}', [\App\Http\Controllers\InventoryController::class, 'update_bl'])->name('inventory.bls.update');
    Route::get('/inventories_bls/view/{id}', [\App\Http\Controllers\InventoryController::class, 'view_bl'])->name('bl.view');
    Route::delete('/inventories_bls/delete/{id}', [\App\Http\Controllers\InventoryController::class, 'delete_bl'])->name('inventory.bls.delete');
    Route::get('inventories/{id}/liftings', [\App\Http\Controllers\InventoryController::class,'liftings'])->name('show.liftings');
    Route::post('inventories/{id}/add-stock', [\App\Http\Controllers\InventoryController::class,'add_stock'])->name('inventory.add.stock');
    Route::put('inventory/update-stock/{id}', [\App\Http\Controllers\InventoryController::class,'update_stock'])->name('inventory.update.stock');
    Route::delete('inventory/delete-stock/{id}', [\App\Http\Controllers\InventoryController::class,'delete_stock'])->name('inventory.delete.stock');
    Route::get('get-bl/{id}', [\App\Http\Controllers\InventoryController::class,'getBL']);
    Route::get('get-inv/{id}', [\App\Http\Controllers\InventoryController::class,'getInv']);
    Route::get('edit-bl-terminal', [\App\Http\Controllers\InventoryController::class,'edit_terminal']);
    Route::get('search-bl', [\App\Http\Controllers\InventoryController::class,'search_bl']);
    Route::get('get-unsold-qty-product/{id}/{product}', [\App\Http\Controllers\InventoryController::class,'unsold_qty']);
    Route::get('get-commingles/{id}', [\App\Http\Controllers\InventoryController::class,'get_commingle'])->name('get.bls.commingle');
    Route::post('save-commingles/{id}', [\App\Http\Controllers\InventoryController::class,'save_commingle'])->name('save.bls.commingle');
    Route::get('commingle/delete/{id}', [\App\Http\Controllers\InventoryController::class, 'delete_commingle'])->name('commingle.delete');

    // LC Controller
    Route::resource('local-contract', LocalContractController::class);
    Route::get('local-contracts/inventories', [LocalContractController::class, 'inventory']);
    Route::get('local-contracts/price-update', [LocalContractController::class, 'price_update']);
    Route::get('local-contracts/split/{id}', [LocalContractController::class, 'split']);
    Route::post('local-contracts/split/{id}', [LocalContractController::class, 'split_store']);

    Route::get('local-contracts/vessel-allocation', [VesselAllocationController::class, 'index']);
    Route::get('local-contracts/vessel-allocation/delete/{id}', [VesselAllocationController::class, 'delete'])->name('vessel_allocation.delete');
    Route::get('local-contracts/bl-allocation/delete/{id}', [VesselAllocationController::class, 'bl_delete'])->name('bl_allocation.delete');

    Route::get('local-contracts/bl-allocation/{id}', [VesselAllocationController::class, 'bl_index']);
    Route::post('local-contracts/bl-allocation/{id}', [VesselAllocationController::class, 'bl_allocate']);
    Route::post('local-contracts/allocate-vessel/{id}', [VesselAllocationController::class, 'allocate'])->name('allocate.vessel');

    Route::get('local-contracts/vessel', [LocalContractController::class, 'vessel']);
    Route::get('local-contracts/buyer', [LocalContractController::class, 'buyer']);
    Route::get('local-contracts/seller', [LocalContractController::class, 'seller']);
    Route::get('local-contracts/contracts', [LocalContractController::class, 'contracts']);

    Route::get('local-contracts/view-contract/{id}', [LocalContractController::class, 'view_contract']);

    Route::get('local-contracts/washout/{id}', [LocalContractController::class, 'washout']);
    Route::post('local-contracts/washout/{id}', [LocalContractController::class, 'washout_store']);


    Route::post('local-contracts/export', [LocalContractController::class, 'export'])->name('local-contract.export');

    Route::get('get-contract/{id}',[LocalContractController::class, 'getContract'])->name('get.contract');
    Route::post('save-contract-message',[LocalContractController::class, 'SaveMessage'])->name('save.message');
    Route::post('update-contract-price/{id}',[LocalContractController::class, 'UpdatePrice']);

    Route::get('local-contract/barter/create', [LocalContractController::class, 'barter_create'])->name('local-contract.barter');
    Route::get('local-contract/temp/create', [LocalContractController::class, 'temp_create'])->name('local-contract.temp');
    Route::get('local-contract/barter/index', [LocalContractController::class, 'barter_index'])->name('barter.index');
    Route::get('local-contract/temp/index', [LocalContractController::class, 'temp_index'])->name('temp.index');
    Route::get('local-contract/temp/return-contract/{id}', [LocalContractController::class, 'return_contract'])->name('temp.return_contract');
    Route::get('local-contract/temp/return-contract/edit/{id}', [LocalContractController::class, 'return_contract_edit'])->name('temp.return_contract_edit');

    Route::get('local-contract/barter/return-contract/{id}', [LocalContractController::class, 'return_barter'])->name('barter.return_contract');
    Route::get('local-contract/barter/return-contract/edit/{id}', [LocalContractController::class, 'return_barter_edit'])->name('barter.return_contract_edit');


    Route::get('/check-quantity', [LocalContractController::class, 'CheckQuantity'])->name('check.quantity');
    Route::get('/datatable-search', [LocalContractController::class, 'datatable_search'])->name('datatable.search');

    Route::get('/update-quantity/{id}', [LocalContractController::class, 'UpdateQuantity'])->name('update.quantity');
    Route::get('/update-rate/{id}', [LocalContractController::class, 'UpdateRate'])->name('update.rate');
    Route::get('/update-product/{id}', [LocalContractController::class, 'UpdateProduct'])->name('update.product');

    Route::get('local-contracts/edit-qty/{id}',[LocalContractController::class,'EditQty'])->name('contract.edit-qty');
    Route::get('local-contracts/edit-rate/{id}',[LocalContractController::class,'EditRate'])->name('contract.edit-rate');
    Route::get('local-contracts/edit-product/{id}',[LocalContractController::class,'EditProduct'])->name('contract.edit-product');

    Route::get('local-contracts/reduce-qty/{id}/{qty}',[LocalContractController::class,'EditReduceQty'])->name('edit.reduce-qty');
    Route::post('local-contracts/update-reduce-qty/{id}/{qty}',[LocalContractController::class,'UpdateReduceQty'])->name('update.reduce-qty');
    
    // Lifting Controller
    Route::get('/sales-request', [SalesRequestController::class, 'index']);
    Route::get('/sales-request/process', [SalesRequestController::class, 'process_index']);
    Route::get('/sales-request/process/{id}/edit', [SalesRequestController::class, 'process_edit'])->name('sale.process.edit');
    Route::get('/sales-request/success', [SalesRequestController::class, 'success_index']);
    Route::get('/sales-request/allocation', [SalesRequestController::class, 'allocation_index']);
    Route::get('/sales-request/success/{id}/edit', [SalesRequestController::class, 'success_edit'])->name('sale.success.edit');
    Route::get('/sales-request/delete-contract/{id}', [SalesRequestController::class, 'sale_contract_delete'])->name('sale_contract.delete');
    Route::post('/sales-request/store', [SalesRequestController::class, 'store'])->name('sales.request.store');
    Route::get('/sales-request/add-lifting/{id}', [SalesRequestController::class, 'add_lifting'])->name('sales.add_lifting');
    Route::get('/sales-request/edit/{id}', [SalesRequestController::class, 'edit'])->name('sales.edit');
    Route::post('/sales-request/update/{id}', [SalesRequestController::class, 'update'])->name('sales.update');
    Route::get('/create-contract/{id}', [SalesRequestController::class, 'contract_sale'])->name('sales.contract');
    Route::post('/store-contract', [SalesRequestController::class, 'contract_store'])->name('sales.contract.store');
    Route::get('/sales-request/check-qty', [SalesRequestController::class, 'check_qty']);
    Route::get('/sales-request/export', [SalesRequestController::class, 'export']);
    Route::get('sales-request/view/{id}', [SalesRequestController::class, 'view_lifting'])->name('view.lifting');
    Route::get('sales-request/delete/{id}', [SalesRequestController::class, 'delete'])->name('sales.delete');
    Route::get('sales-request/get-inv/{product}', [SalesRequestController::class, 'getInv'])->name('get.inv.product');


    Route::post('/lifting/store', [LiftingController::class, 'store'])->name('lifting.store');
    Route::get('/get-sale/{id}', [SalesRequestController::class, 'getSale']);
    Route::get('update-lifting-status/{id}', [SalesRequestController::class, 'update_lifting_status']);
    
    Route::get('get-terminal/{id}',[SalesRequestController::class,'getTerminals']);


});

Route::group(['middleware' => ['admin']], function() {

    Route::resource('companies', CompanyController::class);
    Route::resource('expense', ExpenseController::class);
    Route::resource('surveyor', SurveyorController::class);

    Route::get('/general-ledger', [PaymentRecordController::class, 'index']);

    Route::get('/payment/inventory', [PaymentRecordController::class, 'inventory']);
    Route::get('/payment/local-contract', [PaymentRecordController::class, 'local_contract']);

    Route::post('/payment/inventory', [PaymentRecordController::class, 'payment_invetory'])->name('payment.inventory.store');
    Route::post('/payment/local-contract', [PaymentRecordController::class, 'payment_contract'])->name('payment.local-contract.store');

    Route::get('/temporary-contract',[SalesContractController::class, 'temp_index']);
    Route::get('/temporary-contract/edit/{id}',[SalesContractController::class, 'temp_edit']);
    Route::get('/normal-contract',[SalesContractController::class, 'normal_index']);
    Route::get('/barter-contract',[SalesContractController::class, 'barter_index']);
    Route::get('/barter-contract/edit/{id}',[SalesContractController::class, 'barter_edit']);

    Route::resource('international-contract', InternationalContractController::class);
    Route::get('/international-contract-split/{id}', [InternationalContractController::class, 'contract_split'])->name('contract.split');
    Route::get('/international-contract-washout/{id}', [InternationalContractController::class, 'washout'])->name('washout');
    Route::post('/international-contract-split/store', [InternationalContractController::class, 'contract_split_store'])->name('contract.split.store');
    Route::post('/international-contract/doc-upload', [InternationalContractController::class, 'upload_document']);

    Route::put('/companies_addresses/update/{id}', [CompanyController::class, 'update_address'])->name('company.address.update');
    Route::delete('/companies_addresses/delete/{id}', [CompanyController::class, 'delete_address'])->name('company.address.delete');

    Route::resource('businesses', BusinessController::class);
    Route::resource('transaction-type', TransactionTypeController::class);

    Route::put('/businesses_addresses/update/{id}', [BusinessController::class, 'update_address'])->name('business.address.update');
    Route::delete('/businesses_addresses/delete/{id}', [BusinessController::class, 'delete_address'])->name('business.address.delete');

    Route::get('/options', [\App\Http\Controllers\OptionController::class, 'index']);
    Route::put('/options/update', [\App\Http\Controllers\OptionController::class, 'update']);
    // Route::put('/options/{name}/update', [\App\Http\Controllers\OptionController::class, 'update']);

    Route::resource('notes', NotesController::class);
    Route::get('status-update/notes/{id}', [NotesController::class,'status_update'])->name('notes.status-update');
    Route::resource('products', ProductController::class);
    Route::resource('ports', PortController::class);
    Route::resource('payment-types', PaymentTypeController::class);
    Route::resource('payment-terms', PaymentTermController::class);
    Route::resource('vessels', VesselController::class);
    Route::resource('terminals', \App\Http\Controllers\TerminalController::class);
    Route::resource('bank-accounts', \App\Http\Controllers\BankAccountController::class);


    Route::resource('clearing-agents', \App\Http\Controllers\ClearingAgentController::class);
    Route::resource('document', \App\Http\Controllers\DocumentController::class);


    Route::get('/emails', [EmailController::class, 'receiveEmails']);
    Route::get('/emails/show/{id}', [EmailController::class, 'show'])->name('mail.show');
    Route::get('/emails/assign-to', [EmailController::class, 'assign_to'])->name('mail.assign_to');

    Route::get('activity-logs',[ActivityLogController::class, 'index']);


    Route::resource('accounts', AccountController::class);
    Route::get('account/chart',[AccountController::class,'chart']);
    Route::get('coa/create',[AccountController::class,'coa_create']);
    Route::get('get-account/{id}',[AccountController::class,'getAccount']);
    Route::resource('journals', JournalController::class);

        Route::resource('roles', RoleController::class);
        Route::resource('users', UserController::class);

    Route::get('cost-calculator',function() {
        $options = \App\Models\Option::get();
        $values = [];        
        foreach ($options as $option) {
            $values[$option->name] = $option->content;    
        }
        return view('pages.calculator.index',compact('values')); 
    });

});


    }); // End Middleware


Route::get('morph-rel',function(){
    $bls = App\Models\InventoryBL::find(1);
    return $bls->document;
});