<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RequirementController;

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

//RUTAS
//Student
Route::get('student/{id_student}/subject/{id_subject}', 'StudentController@showScoresBySubject');
Route::post('students/checkByRut', 'StudentController@checkByRut');
Route::apiResource('students', 'StudentController');
//Subject
Route::get('subject/{id}/requirements', 'SubjectController@showRequirementsBySubject');
Route::apiResource('subjects', 'SubjectController');
//Postulation
Route::apiResource('postulations', 'PostulationController');
//Faculty
Route::get('allFacultiesCareers', 'FacultyController@allFacultiesCareers');
//Requirement
Route::apiResource('requirements','RequirementController');
//Report
Route::get('getReportPostulationPDF/{idSubject}','ReportController@getAllPostulationsToSubjectPDF');
Route::get('getReportPostulationEXCEL/{idSubject}','ReportController@getAllPostulationsToSubjectEXCEL');