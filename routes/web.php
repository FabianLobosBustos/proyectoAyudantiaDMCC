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
//Assistant
Route::get('assistant/{id_assistant}/subject/{id_subject}', 'AssistantController@showScoresBySubject');
Route::post('assistants/checkByRut', 'AssistantController@checkByRut');
Route::apiResource('assistants', 'AssistantController');
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
Route::get('downloadPostulationExportPDF/{idSubject}/phase/{idPhase}','ExportController@getAllPostulationsToSubjectPDF');
Route::get('downloadPostulationExportEXCEL/{idSubject}/phase/{idPhase}','ExportController@getAllPostulationsToSubjectEXCEL');
//Report
Route::get('getArrayPostulationsBySubject/{idSubject}/phase/{idPhase}','ReportController@getArrayPostulationsBySubject');
//Phase
Route::apiResource('phases', 'PhaseController');
Route::get('phaseBySubject/{id}','PhaseController@phaseBySubject');