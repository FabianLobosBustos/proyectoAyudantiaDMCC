<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Assistant;
use App\Career;
use App\Subject;
use App\AssistantScore;
use App\Faculty;
use phpDocumentor\Reflection\Types\Object_;

class AssistantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        error_log('Some message here.');
        return Assistant::all();
    }

    
    //UNO DE LOS CORES DEL SISTEMA NO MODIFICAR SIN AVISO
    //Funcion que retorna el alumno, en el caso de que este exista en la bd
    public function checkByRut(Request $request)
    {
        
        $assistant = Assistant::where('rut',(int)$request->rut)->get();
        
        //Se chekea si el estudiante existe en la BD
        if($assistant->isEmpty()){
            return 0; 
        }

        $assistant = $assistant->first();
        $career = $assistant->careers->first();
        
        //ACA SE DEBE RETORNAR LA CARRERA VIGENTE DEL ESTUDIANTE! => IMPLEMENTAR CAMBIO EN LA BD
        $faculty = Faculty::where('id',$career->faculty->id)->first();

        $allData = new Object_();
        
        $assistantSend = new Object_();
        $careerSend = new Object_();
        $facultySend = new Object_();

        $careerSend->id = $career->id;
        $careerSend->name = $career->name;
        
        $facultySend->id = $faculty->id;
        $facultySend->name = $faculty->name;
            
        $assistantSend->id = $assistant->id;
        $assistantSend->name = $assistant->name;
        $assistantSend->lastNameMom = $assistant->lastNameMom;
        $assistantSend->lastNameDad = $assistant->lastNameDad;
        $assistantSend->level = $assistant->level;
        $assistantSend->rut = $assistant->rut;
        $assistantSend->fone = $assistant->fone;
        $assistantSend->verificatorDigit = $assistant->verificatorDigit;
        $assistantSend->address = $assistant->address;
        $assistantSend->email = $assistant->email;
        
        $allData->faculty = $facultySend;
        $allData->career = $careerSend;
        $allData->assistant = $assistantSend;
        

        $allData = json_encode($allData);
        
        
        return $allData;
        
    }

    //Funcion que muestra la nota que tuvo el alumno en las asignatura
    //que son requerimientos de la asignatura dada por parametro.
    public function showScoresBySubject($id_assistant,$id_subject){
        $assistant = Assistant::where('id',$id_assistant)->first();
        //con el sort_by se logra que se obtengan las ultimas notas registradas primero
        $assistantScores = $assistant->assistantScores->sortBy('created_at',SORT_REGULAR, true);
        $subject = Subject::where('id',$id_subject)->first();
        $requirements = $subject->requirements;
        
        $listOfRequirementsIds = [];
        foreach($requirements as $requirement){
            array_push($listOfRequirementsIds,$requirement->id);
        }

        $list_of_scores = [];
        foreach($assistantScores as $assistantScore){
            
            $assistantScore = AssistantScore::where('id',$assistantScore->id)->first();
            $requirementSubjectId = $assistantScore->subject_id;
    
            if (in_array($requirementSubjectId,$listOfRequirementsIds)) {
                $requirementName = Subject::where('id',$requirementSubjectId)->first()->name;
                $list_of_scores[] = [
                    'subject_id' => $requirementSubjectId,
                    'subject_name' => $requirementName,
                    'score' => $assistantScore->score
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
        $assistant = new Assistant;
        
        $assistant->name = $request->name;
        $assistant->lastName = $request->lastName;
        $assistant->level = $request->level;
        $assistant->fone =$request->fone;
        $assistant->rut = $request->rut;
        $assistant->verificatorDigit = $request->verificatorDigit;
        $assistant->address = $request->address;
        $assistant->save();
        
        
        


        return $assistant->first();
        
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
        return Assistant::where('id',$id)->get();
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
