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

//RUTA HOME PRINCIPAL SISTEMA (POSTULACION)
Route::get('/', function () {
    return view('welcome');
});

//RUTA PARA EL HOME DEL COORDINADOR
Route::get('/coordinator', function () {
    return view('coordinator');
});


//RUTAS
//Student
Route::get('student/{id_student}/subject/{id_subject}', 'StudentController@showScoresBySubject');
Route::post('students/checkByRut', 'StudentController@checkByRut');
Route::apiResource('students', 'StudentController');
//Subject
Route::get('subject/{id}/requirements', 'SubjectController@showRequirementsBySubject');
Route::get('getActiveSubjects', 'SubjectController@getActiveSubjects');
Route::apiResource('subjects', 'SubjectController');
//Postulation
Route::apiResource('postulations', 'PostulationController');
//Faculty
Route::get('allFacultiesCareers', 'FacultyController@allFacultiesCareers');
//Requirement
Route::apiResource('requirements','RequirementController');
//Export
Route::get('downloadPostulationExportPDF/{idSubject}/period/{idPeriod}','ExportController@getAllPostulationsToSubjectPDF');
Route::get('downloadPostulationExportEXCEL/{idSubject}/period/{idPeriod}','ExportController@getAllPostulationsToSubjectEXCEL');
//Report
Route::get('getArrayPostulationsBySubject/{idSubject}/period/{idPeriod}','ReportController@getArrayPostulationsBySubject');
//Period
Route::apiResource('periods', 'PeriodController');
Route::get('periodBySubject/{id}','PeriodController@periodBySubject');