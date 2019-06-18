<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Student;
use App\Career;
use App\Subject;
use App\StudentScore;
use App\Faculty;
use phpDocumentor\Reflection\Types\Object_;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        error_log('Some message here.');
        return Student::all();
    }

    
    //UNO DE LOS CORES DEL SISTEMA NO MODIFICAR SIN AVISO
    //Funcion que retorna el alumno, en el caso de que este exista en la bd
    public function checkByRut(Request $request)
    {
        
        $student = Student::where('rut',(int)$request->rut)->get();
        
        //Se chekea si el estudiante existe en la BD
        if($student->isEmpty()){
            return 0; 
        }

        $student = $student->first();
        $career = $student->careers->first();
        
        //ACA SE DEBE RETORNAR LA CARRERA VIGENTE DEL ESTUDIANTE! => IMPLEMENTAR CAMBIO EN LA BD
        $faculty = Faculty::where('id',$career->faculty->id)->first();

        $allData = new Object_();
        
        $studentSend = new Object_();
        $careerSend = new Object_();
        $facultySend = new Object_();

        $careerSend->id = $career->id;
        $careerSend->name = $career->name;
        
        $facultySend->id = $faculty->id;
        $facultySend->name = $faculty->name;
            
        $studentSend->id = $student->id;
        $studentSend->name = $student->name;
        $studentSend->lastNameMom = $student->lastNameMom;
        $studentSend->lastNameDad = $student->lastNameDad;
        $studentSend->level = $student->level;
        $studentSend->rut = $student->rut;
        $studentSend->verificatorDigit = $student->verificatorDigit;
        $studentSend->address = $student->address;
        $studentSend->email = $student->email;
        
        $allData->faculty = $facultySend;
        $allData->career = $careerSend;
        $allData->student = $studentSend;
        

        $allData = json_encode($allData);
        
        
        return $allData;
        
    }

    //Funcion que muestra la nota que tuvo el alumno en las asignatura
    //que son requerimientos de la asignatura dada por parametro.
    public function showScoresBySubject($id_student,$id_subject){
        $student = Student::where('id',$id_student)->first();
        //con el sort_by se logra que se obtengan las ultimas notas registradas primero
        $studentScores = $student->studentScores->sortBy('created_at',SORT_REGULAR, true);
        $subject = Subject::where('id',$id_subject)->first();
        $requirements = $subject->requirements;
        
        $listOfRequirementsIds = [];
        foreach($requirements as $requirement){
            array_push($listOfRequirementsIds,$requirement->id);
        }

        $list_of_scores = [];
        foreach($studentScores as $studentScore){
            
            $studentScore = StudentScore::where('id',$studentScore->id)->first();
            $requirementSubjectId = $studentScore->subject_id;
    
            if (in_array($requirementSubjectId,$listOfRequirementsIds)) {
                $requirementName = Subject::where('id',$requirementSubjectId)->first()->name;
                $list_of_scores[] = [
                    'subject_id' => $requirementSubjectId,
                    'subject_name' => $requirementName,
                    'score' => $studentScore->score
                ];
                //Eliminamos del requirimiento la nota agregada!
                unset($listOfRequirementsIds[array_search($requirementSubjectId,$listOfRequirementsIds)]);
            }
            
        }
       
        //$list_of_scores = json_encode($list_of_scores);
        return $list_of_scores;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        error_log('Guardando alumno en BD!');
        $student = new Student;
        
        $student->name = $request->name;
        $student->lastName = $request->lastName;
        $student->level = $request->level;
        $student->fone =$request->fone;
        $student->rut = $request->rut;
        $student->verificatorDigit = $request->verificatorDigit;
        $student->address = $request->address;
        $student->save();
        
        
        


        return $student->first();
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        error_log('mostrando1!!');
        return Student::where('id',$id)->get();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
