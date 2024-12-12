<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ApplicantsController;
use App\Http\Controllers\AuthManager;
use App\Http\Controllers\DataFormsController;
use App\Http\Controllers\ExpiredController;
use App\Http\Controllers\GlobalNav;
use App\Http\Controllers\HeadController;
use App\Models\AdminActivityLog;
use Illuminate\Support\Facades\Route;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
// Route::get('/', function () {
//     return view('login')views

// Route::get('/test', function() {
//     return view ('test');
// });
//protected
Route::middleware(['auth:user'])->group(function () {
    Route::get('/create', [DataFormsController::class, 'create'])->name('create');
    Route::get('/home', [DataFormsController::class, 'Home'])->name('home');
    Route::get('/views', [DataFormsController::class, 'index'])->name('views');
    Route::get('/renew', [DataFormsController::class, 'showRenewForm'])->name('renew');
    Route::post('/archive', action: [ExpiredController::class, 'archive'])->name('archive.records');
    
});
Route::post('/restore', action: [ExpiredController::class, 'restore'])->name('restore.records');

Route::middleware(['auth:admin'])->group(function () {
    Route::get('admin/dashboard', [AdminController::class, 'dashboard'])->name('ITDD.dashboard');
    Route::get('/admin/account-details', [AdminController::class, 'accountDetails'])->name('admin.account.details');
    Route::post('/admin/account/verify', [AdminController::class, 'verifyAccount'])->name('admin.account.verify');

    Route::get('/admin-activity-logs/{adminId}', [AdminController::class, 'getActivityLogs']);
    route::post('/change-pass', [AdminController::class, 'changePassword'])->name('changepass');




});


Route::middleware(['auth:head'])->group(function () {
    Route::get('Head/View/pdao.database', [HeadController::class, 'index'])->name('HEAD.index');
    Route::get('Head/dashboard', [HeadController::class, 'dashboard'])->name('HEAD.dashboard');
    

    Route::get('/Head/account-details', [HeadController::class, 'accountDetails'])->name('HEAD.account.details');
    Route::post('/Head/account/verify', [HeadController::class, 'verifyAccount'])->name('HEAD.account.verify');
    Route::post('/change-password', [HeadController::class, 'HeadchangePassword'])->name('HEAD.changeAdminPassword');
    Route::get('/Head-create-acc', [HeadController::class, 'gotocreate'])->name('create-account');
    Route::post('Head-create-account-portal',[HeadController::class, 'createacc'])->name('account-create');

});

Route::post('/Head-Login',[HeadController::class, 'loginPost'])->name('Head.login.post');

Route::post('/register-Head', [HeadController::class, 'register'])->name('register.post.head');
Route::post('/head/admin/activate/{id}', [HeadController::class, 'Headactivate'])->name('HEAD.admin.activate');
Route::post('/head/admin/suspend/{id}', [HeadController::class, 'Headsuspend'])->name('HEAD.admin.suspend');


/* Route::post('head/user/activate/{id}', [HeadController::class, 'Head_Pdaoactivate'])->name('HEAD.user.activate');


Route::post('head/user/suspend/{id}', [HeadController::class, 'Head_Pdaosuspend'])->name('HEAD.user.suspend'); */


Route::post('/head/user/activate/{id}', [HeadController::class, 'Head_Pdaoactivate'])->name('HEAD.user.activate');
Route::post('/head/user/suspend{id}', [HeadController::class, 'Head_Pdaosuspend'])->name('HEAD.user.suspend');

Route::get('/Head/logut',[HeadController::class,'HeadLogout'])->name('HEAD.logout');

Route::get('/logut',[AdminController::class,'Adminlogout'])->name('admin.logout');
//navigations
Route::get('/register', [GlobalNav::class,'register'])->name('register');
Route::get('/login', [GlobalNav::class, 'login'])->name('login');
Route::get('/login-head-gov', [GlobalNav::class, 'loginHEAD'])->name('loginHEAD');
Route::get('/ITDDlogin', [GlobalNav::class, 'loginITDD'])->name('ITDD.login');
Route::get('/verify', [GlobalNav::class, 'verifyPage'])->name('verify');

Route::get('/verify-pwd', [GlobalNav::class, 'verify'])->name('getverify');

Route::post('/ITDDlogin', [AdminController::class, 'loginPost'])->name('ITDD.login.post');

//functions
Route::get('/attachments/{id}', [DataFormsController::class, 'getAttachments']);

Route::post('/create', [DataFormsController::class, 'store'])->name('store');
Route::post('/login', [AuthManager::class, 'loginPost'])->name('login.post');
Route::post('/register', [AdminController::class, 'register'])->name('register.post');
Route::get('/logout', [AuthManager::class,'logout'])->name('logout');
Route::post('/renew/{id}', [DataFormsController::class, 'updateRenewal'])->name('renew.submit');
Route::get('/get-diseases/{id}', [DataFormsController::class, 'getDiseases']);
Route::post('/dataforms/bulk-delete', [DataFormsController::class, 'destroyBulk'])->name('dataforms.bulkDelete');
Route::get('get-diseases/{id}', [DataFormsController::class, 'getDiseases'])->name('getDiseases');
Route::get('/dataforms/{id}/details', [DataFormsController::class, 'getUserDetails'])->name('getUserDetails');
Route::get('data-forms/{id}/edit', [DataFormsController::class, 'edit'])->name('data-forms.edit');
Route::resource('data-forms', DataFormsController::class);
Route::put('/data-forms/{id}', [DataFormsController::class, 'update'])->name('data-forms.update');

Route::get('/get-disability-counts', [DataFormsController::class, 'getDisabilityCounts']);
Route::get('/get-additional-counts', action: [DataFormsController::class, 'causesofdisabilities']);


Route::get('/filter', [DataFormsController::class, 'filter'])->name('filter');


// Route::post('/export-users', function (Request $request) {
//     // Get the selected IDs from the request
//     $selectedIds = json_decode($request->input('selectedIds'), true);

//     // Pass the selected IDs to the export logic (if no selection, all records will be exported)
//     return Excel::download(new UsersExport($selectedIds), 'users.xlsx');
// })->name('users.export');

Route::post('/export-users', [DataFormsController::class, 'exportSelected'])->name('users.export');




Route::get('/expired-records', [ExpiredController::class, 'showExpiredRecords'])->name('expired.records');
Route::post('/export-expired', [ExpiredController::class, 'exportSelected'])->name('expired.export');

Route::get('/form/preview/{id}', [DataFormsController::class, 'preview'])->name('form.preview');

Route::get('/capture-user/{id}', [DataFormsController::class, 'capture'])->name('capture');

Route::get('/filter-expired', [ExpiredController::class, 'filter'])->name('filter.expired');

//nav
Route::get('/Apply', [GlobalNav::class, 'apply'])->name('apply');

//func
Route::get('/applicants/list', [ApplicantsController::class, 'index'])->name('applicants.index'); // List all applicants
Route::get('/applicants', [ApplicantsController::class, 'create'])->name('create.applicants'); // Show create form
Route::post('/applicants', [ApplicantsController::class, 'store'])->name('store.applicants'); // Store new applicant


Route::get('/applicants/{id}', [ApplicantsController::class,'show'])->name('applicants.show');

//func
Route::post('/approve/{id}', [ApplicantsController::class, 'approveApplicant'])->name('approve.applicant');
Route::get('/user/{userId}/activity-logs', [AuthManager::class, 'getUserActivityLogs']);



Route::get('/user-activity-dates/{userId}', [AuthManager::class, 'getUserActivityDates']);
Route::get('/admin-activity-dates/{adminId}', [AdminController::class, 'getAdminActivityDates'])->name('admin.activity.dates');


Route::get('/Database-ITDD-views', [AdminController::class, 'index'])->name('admin-views');

//func
Route::post('/admin/activate/{id}', [AdminController::class, 'activate'])->name('admin.activate');
Route::post('/admin/suspend/{id}', [AdminController::class, 'suspend'])->name('admin.suspend');

Route::post('/users/import', action: [DataFormsController::class, 'importExcel'])->name('users.import');


// Route for activating a user
Route::post('/user/activate/{id}', [AdminController::class, 'Pdaoactivate'])->name('user.activate');

// Route for suspending a user
Route::post('/user/suspend/{id}', [AdminController::class, 'Pdaosuspend'])->name('user.suspend');

Route::post('/applicant/pending/{id}', [ApplicantsController::class,'pending'])->name('pending');

Route::get('expired/filter', [ExpiredController::class,'index'])->name('filter.expire');