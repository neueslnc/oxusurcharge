<?php

use PDF as DomPdf;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Controllers\Profile;
use App\Http\Controllers\Criteria;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BidController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DepartamentController;
use App\Http\Controllers\User\ArticleController;
use App\Http\Controllers\User\ArticleMessageController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\SuperAdmin\SMS\PlayMobileController;
use App\Http\Controllers\SuperAdmin\NotificationUserController;
use App\Http\Controllers\Admin\EmployeeController as AdminEmployeeController;
use App\Http\Controllers\User\Bid\StatementController as UserStatementController;
use App\Http\Controllers\SuperAdmin\ArticleController as SuperAdminArticleController;
use App\Http\Controllers\SuperAdmin\EmployeeController as SuperAdminEmployeeController;
use App\Http\Controllers\User\Bid\AnnouncementController as UserAnnouncementController;
// use dompdf;
use App\Http\Controllers\User\NotificationUserController as UserNotificationUserController;
use App\Http\Controllers\SuperAdmin\Bid\StatementController as SuperAdminStatementController;
use App\Http\Controllers\SuperAdmin\Bid\AnnouncementController as SuperAdminAnnouncementController;
use App\Models\UserOnCriteria;

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

Route::middleware(['auth'])->group(function () {

    Route::post('/file', function (Request $req) {

        return Storage::response($req->input('id'));
    })->name('file');

    Route::group(['middleware' => 'role:super_admin'], function() {

        Route::resource('/departament', DepartamentController::class);

        Route::prefix('superadmin')->group(function () {
            Route::name('superadmin.')->group(function () {

                Route::resource('/notification_user', NotificationUserController::class);

                Route::resource('/article', SuperAdminArticleController::class)->except([
                    'create', 'store', 'edit', 'update', 'destroy'
                ]);
                Route::resource('{admin_id}/sms_message', PlayMobileController::class);
                Route::post('sms_message/get/ajax', [PlayMobileController::class,'getAjaxData'])->name('getAjaxDataSMSMessage');

                Route::get('get_sms_filter', [PlayMobileController::class, 'get_sms_filter'])->name('get_sms_filter');

                Route::get('get_sms_filter_by_departaments', [PlayMobileController::class, 'get_sms_filter_by_departaments'])->name('get_sms_filter_by_departaments');

                Route::get('get_sms_filter_by_teacher', [PlayMobileController::class, 'get_sms_filter_by_teacher'])->name('get_sms_filter_by_teacher');

                Route::get('/sms_messages_get', [PlayMobileController::class, 'export'])->name('sms_messages_get');
               
               
               
               
                Route::get('get_count_active_article_counts', [SuperAdminArticleController::class, 'get_count_active_article_counts']);

                Route::post('update_article_status/${id}', [SuperAdminArticleController::class, 'update_article_status'])->name('update_article_status');


                Route::get('get_article_month_filter', [SuperAdminArticleController::class, 'article_month_filter'])->name('article_month_filter');


                Route::resource('/employees', SuperAdminEmployeeController::class);
                Route::get('/teacher_get_static', [SuperAdminEmployeeController::class, 'export'])->name('teacher_get_static');

                Route::resource('/announcement', SuperAdminAnnouncementController::class)->except([
                    'create', 'store', 'edit', 'update', 'destroy'
                ]);

                Route::get('/announcement_get_static',[SuperAdminAnnouncementController::class, 'export'])->name('announcement_get_static');
                Route::get('/statement_get_static',[SuperAdminStatementController::class, 'export'])->name('statement_get_static');

                Route::get('get_elon_month_filter', [SuperAdminAnnouncementController::class, 'month_filter'])->name('annoucment_month_filter');

                Route::resource('/statement', SuperAdminStatementController::class)->except([
                    'create', 'store', 'edit', 'update', 'destroy'
                ]);

                Route::get('bildirgi', [SuperAdminStatementController::class, 'month_filter'])->name('statement_month_filter');
            });
        });

        Route::get('get_count_active_announcement_counts', [SuperAdminAnnouncementController::class, 'get_count_active_announcement_counts']);

        Route::post('update_announcement_status/${id}', [SuperAdminAnnouncementController::class, 'update_announcement_status'])->name('update_announcement_status');

        Route::put('update_announcement_unfulfilled/{id?}/{unfulfilled}', [SuperAdminAnnouncementController::class, 'update_announcement_unfulfilled'])->name('update_announcement_unfulfilled');

        Route::put('update_statement_unfulfilled/{id}/{unfulfilled}', [SuperAdminStatementController::class, 'update_statement_unfulfilled'])->name('update_statement_unfulfilled');

        Route::get('get_count_active_statement_counts', [SuperAdminStatementController::class, 'get_count_active_statement_counts']);

        Route::post('update_statement_status/${id}', [SuperAdminStatementController::class, 'update_statement_status'])->name('update_statement_status');

        Route::resource('/emloyees', UserController::class);

        // Route::post('/employe/delete/{id}', [UserController::class, 'delete_user'])->name('delete.user');

        Route::post('/set_data_criteria', [Criteria::class, 'set_data'])->name('set_data_criteria');

        Route::get('/report_archive_criterias', [Criteria::class, 'report_archive_criterias'])->name('report_archive_criterias');

        Route::get('/report_archive_criteria/{criteria_id}/{month_year?}', [Criteria::class, 'report_archive_criteria'])->name('report_archive_criteria');

        Route::resource('/bid', BidController::class);
    });

    Route::group(['middleware' => 'role:admin'], function() {
        Route::prefix('admin')->group(function () {
            Route::name('admin.')->group(function () {
                Route::resource('/employees', AdminEmployeeController::class);
            });
        });
    });

    Route::group(['middleware' => 'role:user'], function() {
        Route::prefix('user')->group(function () {
            Route::name('user.')->group(function () {

                Route::resource('/article', ArticleController::class);
                Route::resource('/message', ArticleMessageController::class);
                Route::resource('/announcement', UserAnnouncementController::class);
                Route::resource('/statement', UserStatementController::class);

                Route::post('set_status_notification', [UserNotificationUserController::class, 'set_status_notification']);

                Route::get('get_notification', [UserNotificationUserController::class, 'get_notification']);
            });
        });
        Route::resource('profiles', Profile::class);
    });


    Route::any('/destroy', [AuthenticatedSessionController::class, 'destroy'])->name('destroy');

    Route::get('/clear_cache', function () {

        Artisan::call('config:clear');

        Artisan::call('config:cache');

        Artisan::call('view:clear');

        Artisan::call('view:cache');

        Artisan::call('route:clear');

        Artisan::call('route:cache');

        return redirect()->route('login');
    });
});

Route::middleware(['guest'])->group(function () {

    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');

    Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login_post');
});

Route::get("test", [SuperAdminEmployeeController::class, 'index_vue']);

Route::get("/load_script", function () {

    if (env('APP_DEBUG')) {

        Artisan::call('migrate:fresh');

        Artisan::call('db:seed');

        return view("reload_script");
    }

})->name("load_script");
