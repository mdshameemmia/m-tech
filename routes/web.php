<?php

use App\Http\Controllers\AnnualReportController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\LevyController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\MaterialCostController;
use App\Http\Controllers\OfficialOrOtherCostController;
use App\Http\Controllers\PaymentReceivedController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProgressClaimController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\QuotationController;
use App\Http\Controllers\SalaryVoucharController;
use App\Http\Controllers\StaffCPFAndSalaryController;
use App\Http\Controllers\SubContactCostController;
use App\Http\Controllers\SubcontractController;
use App\Http\Controllers\SubcontractProjectController;
use App\Http\Controllers\TimeScheduleController;
use App\Models\StaffCPFAndSalary;
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

Route::middleware(['auth'])->group(function () {
   
Route::get('/levies/create',[LevyController::class,'create'])->name('levies.create');
Route::get('/levies/index',[LevyController::class,'index'])->name('levies.index');
Route::post('/levies/store',[LevyController::class,'store'])->name('levies.store');
Route::get('/levies/edit/{id}',[LevyController::class,'edit'])->name('levies.edit');
Route::post('/levies/update/{id}',[LevyController::class,'update'])->name('levies.update');
Route::get('/levies/delete/{id}',[LevyController::class,'delete'])->name('levies.delete');
Route::post('/levi/report/download',[LevyController::class,'reportDownload'])->name('levi-report.download');
   
// subcontract
Route::get('/subcontract/create',[SubcontractController::class,'create'])->name('subcontract.create');
Route::get('/subcontract/index',[SubcontractController::class,'index'])->name('subcontract.index');
Route::post('/subcontract/store',[SubcontractController::class,'store'])->name('subcontract.store');
Route::get('/subcontract/edit/{id}',[SubcontractController::class,'edit'])->name('subcontract.edit');
Route::post('/subcontract/update/{id}',[SubcontractController::class,'update'])->name('subcontract.update');
Route::get('/subcontract/delete/{id}',[SubcontractController::class,'delete'])->name('subcontract.delete');

// subcontract
Route::get('/subcontract_project/create',[SubcontractProjectController::class,'create'])->name('subcontract_project.create');
Route::get('/subcontract_project/index',[SubcontractProjectController::class,'index'])->name('subcontract_project.index');
Route::post('/subcontract_project/store',[SubcontractProjectController::class,'store'])->name('subcontract_project.store');
Route::get('/subcontract_project/edit/{id}',[SubcontractProjectController::class,'edit'])->name('subcontract_project.edit');
Route::post('/subcontract_project/update/{id}',[SubcontractProjectController::class,'update'])->name('subcontract_project.update');
Route::get('/subcontract_project/delete/{id}',[SubcontractProjectController::class,'delete'])->name('subcontract_project.delete');

// sub contact cost 
Route::get('/sub_contact_costs/index',[SubContactCostController::class,'index'])->name('sub_contact_costs.index');
Route::get('/sub_contact_costs/create',[SubContactCostController::class,'create'])->name('sub_contact_costs.create');
Route::post('/sub_contact_costs/store',[SubContactCostController::class,'store'])->name('sub_contact_costs.store');
Route::get('/sub_contact_costs/edit/{id}',[SubContactCostController::class,'edit'])->name('sub_contact_costs.edit');
Route::post('/sub_contact_costs/update/{id}',[SubContactCostController::class,'update'])->name('sub_contact_costs.update');
Route::get('/sub_contact_costs/delete/{id}',[SubContactCostController::class,'delete'])->name('sub_contact_costs.delete');
Route::get('/get-subcontract-project',[SubContactCostController::class,'getSubcontractProject']);
Route::post('/subcontract/report/download',[SubContactCostController::class,'reportDownload'])->name('subcontract-report.download');
Route::get('/get-subcontract-project-amount',[SubContactCostController::class,'getProjectAmount']);

// official or other cost 
Route::get('/official_or_other_costs/index',[OfficialOrOtherCostController::class,'index'])->name('official_or_other_costs.index');
Route::get('/official_or_other_costs/create',[OfficialOrOtherCostController::class,'create'])->name('official_or_other_costs.create');
Route::post('/official_or_other_costs/store',[OfficialOrOtherCostController::class,'store'])->name('official_or_other_costs.store');
Route::get('/official_or_other_costs/edit/{id}',[OfficialOrOtherCostController::class,'edit'])->name('official_or_other_costs.edit');
Route::post('/official_or_other_costs/update/{id}',[OfficialOrOtherCostController::class,'update'])->name('official_or_other_costs.update');
Route::get('/official_or_other_costs/delete/{id}',[OfficialOrOtherCostController::class,'delete'])->name('official_or_other_costs.delete');
Route::post('/official/report/download',[OfficialOrOtherCostController::class,'reportDownload'])->name('official-report.download');

// Material  cost 
Route::get('/material_costs/index',[MaterialCostController::class,'index'])->name('material_costs.index');
Route::get('/material_costs/create',[MaterialCostController::class,'create'])->name('material_costs.create');
Route::post('/material_costs/store',[MaterialCostController::class,'store'])->name('material_costs.store');
Route::get('/material_costs/edit/{id}',[MaterialCostController::class,'edit'])->name('material_costs.edit');
Route::post('/material_costs/update/{id}',[MaterialCostController::class,'update'])->name('material_costs.update');
Route::get('/material_costs/delete/{id}',[MaterialCostController::class,'delete'])->name('material_costs.delete');
Route::post('/material_costs/report/download',[MaterialCostController::class,'reportDownload'])->name('material-report.download');

// staff and cpf salary 
Route::get('/staff_cpfs/index',[StaffCPFAndSalaryController::class,'index'])->name('staff_cpfs.index');
Route::get('/staff_cpfs/create',[StaffCPFAndSalaryController::class,'create'])->name('staff_cpfs.create');
Route::post('/staff_cpfs/store',[StaffCPFAndSalaryController::class,'store'])->name('staff_cpfs.store');
Route::get('/staff_cpfs/edit/{id}',[StaffCPFAndSalaryController::class,'edit'])->name('staff_cpfs.edit');
Route::post('/staff_cpfs/update/{id}',[StaffCPFAndSalaryController::class,'update'])->name('staff_cpfs.update');
Route::get('/staff_cpfs/delete/{id}',[StaffCPFAndSalaryController::class,'delete'])->name('staff_cpfs.delete');
Route::get('/check-amount',[StaffCPFAndSalaryController::class,'checkAmount']);
Route::post('/salary/report/download',[StaffCPFAndSalaryController::class,'reportDownload'])->name('salary-report.download');


// Payment Received 
Route::get('/payment_receives/index',[PaymentReceivedController::class,'index'])->name('payment_receives.index');
Route::get('/payment_receives/create',[PaymentReceivedController::class,'create'])->name('payment_receives.create');
Route::post('/payment_receives/store',[PaymentReceivedController::class,'store'])->name('payment_receives.store');
Route::get('/payment_receives/edit/{id}',[PaymentReceivedController::class,'edit'])->name('payment_receives.edit');
Route::post('/payment_receives/update/{id}',[PaymentReceivedController::class,'update'])->name('payment_receives.update');
Route::get('/payment_receives/delete/{id}',[PaymentReceivedController::class,'delete'])->name('payment_receives.delete');
Route::get('/get-project-name',[PaymentReceivedController::class,'getProjectName']);
Route::post('/payment/report',[PaymentReceivedController::class,'reportDownload'])->name('payment-report.download');

// Loan  
Route::get('/loan/index',[LoanController::class,'index'])->name('loan.index');
Route::get('/loan/create',[LoanController::class,'create'])->name('loan.create');
Route::post('/loan/store',[LoanController::class,'store'])->name('loan.store');
Route::get('/loan/edit/{id}',[LoanController::class,'edit'])->name('loan.edit');
Route::get('/loan/paid/{id}',[LoanController::class,'paid']);
Route::post('/loan/paid-update/{id}',[LoanController::class,'paidUpdate'])->name('loan.paid');
Route::post('/loan/update/{id}',[LoanController::class,'update'])->name('loan.update');
Route::get('/loan/delete/{id}',[LoanController::class,'delete'])->name('loan.delete');
Route::get('/loan/history/{id}',[LoanController::class,'history'])->name('loan.history');




// Annual Report 
Route::get('/annual_reports',[AnnualReportController::class,'index'])->name('annual_reports.index');
Route::post('/annual_reports/search',[AnnualReportController::class,'search'])->name('annual_reports.search');


//  Time Schedule 
Route::get('/time-schedule/index',[TimeScheduleController::class,'index'])->name('time-schedule.index');
Route::get('/time-schedule/edit/{id}',[TimeScheduleController::class,'edit'])->name('time-schedule.edit');
Route::post('/time-schedule/update/{id}',[TimeScheduleController::class,'update'])->name('time-schedule.update');
Route::get('/time-schedule/delete/{id}',[TimeScheduleController::class,'delete'])->name('time-schedule.delete');
Route::post('/time-schedule/store',[TimeScheduleController::class,'store'])->name('time-schedule.store');
Route::get('/time-schedule/create',[TimeScheduleController::class,'create'])->name('time-schedule.create');
Route::post('/time-schedule/search',[TimeScheduleController::class,'search'])->name('time-schedule.search');

//  salary vouchar  
Route::get('/salary-vouchar/index',[SalaryVoucharController::class,'index'])->name('salary-vouchar.index');
Route::get('/salary-vouchar/edit/{id}',[SalaryVoucharController::class,'edit'])->name('salary-vouchar.edit');
Route::post('/salary-vouchar/update/{id}',[SalaryVoucharController::class,'update'])->name('salary-vouchar.update');
Route::get('/salary-vouchar/delete/{id}',[SalaryVoucharController::class,'delete'])->name('salary-vouchar.delete');
Route::post('/salary-vouchar/store',[SalaryVoucharController::class,'store'])->name('salary-vouchar.store');
Route::get('/salary-vouchar/create',[SalaryVoucharController::class,'create'])->name('salary-vouchar.create');
Route::post('/salary-vouchar/search',[SalaryVoucharController::class,'search'])->name('salary-vouchar.search');
Route::post('/salary-vouchar/download',[SalaryVoucharController::class,'reportDownload'])->name('salary-vourchar.download');
Route::get('/single-salary-vouchar/download/{id}',[SalaryVoucharController::class,'singleSalaryVoucharDownload'])->name('single-salary-vouchar.download');

//  employee
Route::get('/employees/index',[EmployeeController::class,'index'])->name('employees.index');
Route::get('/employees/edit/{id}',[EmployeeController::class,'edit'])->name('employees.edit');
Route::post('/employees/update/{id}',[EmployeeController::class,'update'])->name('employees.update');
Route::get('/employees/delete/{id}',[EmployeeController::class,'delete'])->name('employees.delete');
Route::post('/employees/store',[EmployeeController::class,'store'])->name('employees.store');
Route::get('/employees/create',[EmployeeController::class,'create'])->name('employees.create');
Route::post('/get-employee-details',[EmployeeController::class,'getEmployeeDetails'])->name('employee.details');
Route::post('/get-salary-details',[EmployeeController::class,'getEmployeeSalary'])->name('employee.salary');


// company
Route::get('companies/index',[CompanyController::class,'index'])->name('companies.index');
Route::get('companies/create',[CompanyController::class,'create'])->name('companies.create');
Route::post('companies/store',[CompanyController::class,'store'])->name('companies.store');
Route::get('companies/edit/{id}',[CompanyController::class,'edit'])->name('companies.edit');
Route::post('companies/update/{id}',[CompanyController::class,'update'])->name('companies.update');
Route::get('companies/delete/{id}',[CompanyController::class,'delete'])->name('companies.delete');

// Product
Route::get('products/index',[ProductController::class,'index'])->name('products.index');
Route::get('products/create',[ProductController::class,'create'])->name('products.create');
Route::post('products/store',[ProductController::class,'store'])->name('products.store');
Route::get('products/edit/{id}',[ProductController::class,'edit'])->name('products.edit');
Route::post('products/update/{id}',[ProductController::class,'update'])->name('products.update');
Route::get('products/delete/{id}',[ProductController::class,'delete'])->name('products.delete');

// Project
Route::get('projects/index',[ProjectController::class,'index'])->name('projects.index');
Route::get('projects/create',[ProjectController::class,'create'])->name('projects.create');
Route::post('projects/store',[ProjectController::class,'store'])->name('projects.store');
Route::get('projects/edit/{id}',[ProjectController::class,'edit'])->name('projects.edit');
Route::post('projects/update/{id}',[ProjectController::class,'update'])->name('projects.update');
Route::get('projects/delete/{id}',[ProjectController::class,'delete'])->name('projects.delete');
Route::post('project/download',[ProjectController::class,'reportDownload'])->name('project.download');

// Project
Route::get('vendors/index',[QuotationController::class,'index'])->name('vendors.index');
Route::get('vendors/create',[QuotationController::class,'create'])->name('vendors.create');
Route::post('vendors/store',[QuotationController::class,'store'])->name('vendors.store');
Route::get('vendors/edit/{id}',[QuotationController::class,'edit'])->name('vendors.edit');
Route::post('vendors/update/{id}',[QuotationController::class,'update'])->name('vendors.update');
Route::get('vendors/delete/{id}',[QuotationController::class,'delete'])->name('vendors.delete');
Route::get('vendors/quotation-description/{id}',[QuotationController::class,'quotationDescription'])->name('vendors.quotation_description');
Route::get('vendors/quotation-description/create/{id}',[QuotationController::class,'quotationDescriptionCreate']);
Route::post('vendors/quotation-description/store/{id}',[QuotationController::class,'quotationDescriptionStore'])->name('vendors.quotation-description.store');
Route::post('vendors/quotation-description/update/{id}',[QuotationController::class,'quotationDescriptionUpdate'])->name('vendors.quotation-description.update');
Route::get('vendors/quotation-description/edit/{id}',[QuotationController::class,'quotationDescriptionEdit'])->name('vendors.quotation-description.edit');
Route::get('vendors/quotation-description/delete/{id}',[QuotationController::class,'quotationDescriptionDelete'])->name('vendors.quotation-description.delete');

// Progress Claim
Route::get('progress-claim/index',[ProgressClaimController::class,'index'])->name('progress-claim.index');
Route::get('progress-claim/create',[ProgressClaimController::class,'create'])->name('progress-claim.create');
Route::post('progress-claim/store',[ProgressClaimController::class,'store'])->name('progress-claim.store');
Route::get('progress-claim/edit/{id}',[ProgressClaimController::class,'edit'])->name('progress_claim.edit');
Route::post('progress-claim/update/{id}',[ProgressClaimController::class,'update'])->name('progress-claim.update');
Route::get('progress-claim/delete/{id}',[ProgressClaimController::class,'delete'])->name('progress_claim.delete');
Route::get('/progress-claim/download/{id}',[ProgressClaimController::class,'progressClaimDownload'])->name('progress_claim.download');

// Invoice
Route::get('invoice/index',[InvoiceController::class,'index'])->name('invoice.index');
Route::get('invoice/create',[InvoiceController::class,'create'])->name('invoice.create');
Route::post('invoice/store',[InvoiceController::class,'store'])->name('invoice.store');
Route::get('invoice/edit/{id}',[InvoiceController::class,'edit'])->name('invoice.edit');
Route::post('invoice/update/{id}',[InvoiceController::class,'update'])->name('invoice.update');
Route::get('invoice/delete/{id}',[InvoiceController::class,'delete'])->name('invoice.delete');
Route::get('invoice/download/{id}',[InvoiceController::class,'invoiceDownload'])->name('invoice.download');
Route::get('get-description-by-progress-claim',[InvoiceController::class,'getProgressDescription']);

Route::get('/get-progress-claim',[InvoiceController::class,'getProgressClaim']);

Route::get('/get-invoice',[PaymentReceivedController::class,'getInvoice']);
Route::get('/get-invoice-amount',[PaymentReceivedController::class,'getInvoiceAmount']);



// get data by company
Route::get('/get-title-by-compnay',[QuotationController::class,'getTitle']);
Route::get('get-unit-by-compnay',[QuotationController::class,'getUnit']);
Route::get('/quotation-download/{id}',[QuotationController::class,'quotationDownload'])->name('quotation.download');


Route::get('/get-description-by-quotation',[ProgressClaimController::class,'getProductDescription']);


Route::get('/', function () {
    return view('welcome');
});
});



// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';


Route::get('/number',function(){
  function convertNumberToWord(){
    $oneToNineNumber = [1,2,3,4,5,6,7,8,9];
  $oneToNineWord = ['One','Two','Three','Four','Five','Six','Seven','Eight','Nine'];
  $tenToNineteenNumber = [10,11,12,13,14,15,16,17,18,19];
  $tenToNineteenWord  = ['Ten','Eleven','Twelve','Thirteen','Fourteen','Fifteen','Sixteen','Seventen','Eighteen','Nineteen'];
  $numberDistanceBetweenTenNumber = [2,3,4,5,6,7,8,9];
  $numberDistanceBetweenTenWord = ['Twenty','Thirty','Forty','Fifty','Sixty','Seventy','Eighty','Ninety'];
  return 'testing';
  }

  echo convertNumberToWord();
});
