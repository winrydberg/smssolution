<?php

use App\Http\Controllers\Admin\AcademicYearsController;
use App\Http\Controllers\Admin\ClassController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ExpenditureController;
use App\Http\Controllers\Admin\FeesController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\TermsController;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get("/", [MainController::class, "home"]);
Route::get("/login", [LoginController::class, "login"])->name("login");
Route::post("/login", [LoginController::class, "authenticateUser"]);
Route::get("/logout", [LoginController::class, "logoutUser"]);

Route::middleware(['auth'])->group(function () {
    Route::get("/dashboard", [DashboardController::class, "dashboard"]);


    //TERMS ROUTES
    Route::get("/terms", [TermsController::class, "terms"]);
    Route::post("/activate-term", [TermsController::class, "activateTerm"]); 
    Route::post("/activate-academic-year", [TermsController::class, "activateAcademicYear"]);
    Route::post("/new-academic-year", [TermsController::class, "saveAcademicYear"]);


    //STAFF ROUTES
    Route::get("/new-staff",         [StaffController::class, "newStaff"]);
    Route::post("/new-staff",        [StaffController::class, "saveNewStaff"]);
    Route::get("/staff-types",       [StaffController::class, "staffTypes"]);
    Route::post("/new-staff-type",   [StaffController::class, "saveStaffCategory"]);
    Route::post("/delete-staff-type",[StaffController::class, "deleteStaffCategory"]);
    Route::get("/staff-list",        [StaffController::class, "staffList"]);

    // CLASS ROUTES
    Route::get("/classes",          [ClassController::class, "classes"]);
    Route::post("/new-class",       [ClassController::class, "newClass"]);
    Route::post("/delete-class",    [ClassController::class, "deleteClass"]);
    Route::get("/view-students",    [ClassController::class, "students"]);

    //SUBJECTS
    Route::get("/subjects",         [SubjectController::class, "subjects"]);
    Route::post("/new-subject",     [SubjectController::class, "newSubject"]);
    Route::post("/delete-subject",  [SubjectController::class, "deleteSubject"]);

    //FEES
    Route::get("/fees",      [FeesController::class, "fees"]);
    Route::get("/new-fee",   [FeesController::class, "newFee"]);
    Route::post("/new-fee",  [FeesController::class, "saveFee"]);

    //INVOICES
    Route::post("/generate-invoice",   [PaymentController::class, "generateInvoice"]);
    Route::get("/unpaid-invoices",    [PaymentController::class, "unpaidInvoices"]);
    Route::get("/accept-payment",   [PaymentController::class, "acceptPayment"]);
    Route::post("/accept-payment",    [PaymentController::class, "savePayment"]);
    Route::post("/find-invoice",    [PaymentController::class, "findInvoice"]);
    Route::get("/payments",    [PaymentController::class, "payments"]);

    //STUDENT
    Route::get("/new-student",    [StudentController::class, "newStudent"]);
    Route::get("/get-students",   [StudentController::class, "getStudents"]);
    Route::get("/get-guardian",   [StudentController::class, "getGuardian"]);
    Route::post("/new-student",   [StudentController::class, "saveNewStudent"]);
    Route::get("/students",       [StudentController::class, "students"]);
    Route::get("/student-details",       [StudentController::class, "studentDetails"]);

    //EXPENDITURES
    Route::get("/expenditure-categories",       [ExpenditureController::class, "expenditureCategories"]); 
    Route::post("/new-expenditure-category", [ExpenditureController::class, "saveNewExpenditureCategory"]);
    Route::post("/delete-expenditure-category", [ExpenditureController::class, "deleteExpenditureCategory"]);
    Route::get("/new-expenditure", [ExpenditureController::class, "newExpenditure"]);
    Route::post("/new-expenditure", [ExpenditureController::class, "saveExpenditure"]);

    //REPORTS
    Route::get("/expenditure-reports", [ReportController::class, "expenditureReports"]);
    Route::get("/revenue-reports", [ReportController::class, "revenueReports"]);

    //SETTINGS
    Route::get("/settings", [SettingController::class, "settings"]);

    Route::get("/pay-receipt", [PaymentController::class, "generatePaymentReceipt"]); //record-types

    //some new routes for development
    
});




