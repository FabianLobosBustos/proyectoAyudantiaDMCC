<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Postulation;
use App\Assistant;
use App\Faculty;
use App\Career;
use App\Subject;
use App\AssistantScore;


class PostulationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //El request trae todo lo de la postulacion
    //si algo es inerente al alumno, sera assistant_atributo
    //si algo es inerente de la carrera, sera career_atributo
    //si algo es inerente de la facultad, sera faculty_atributo
    //asi hasta el final de los tiempo
    public function store(Request $request)
    {

     
        //obtenemos todos los datos
        $assistantSend_rut = $request->input('assistantSend.rut');
        $assistantSend_name = $request->input('assistantSend.name');
        $assistantSend_lastNameDad = $request->input('assistantSend.lastNameDad');
        $assistantSend_lastNameMom = $request->input('assistantSend.lastNameMom');
        $assistantSend_address = $request->input('assistantSend.address');
        $assistantSend_email = $request->input('assistantSend.email');
        $assistantSend_fone = $request->input('assistantSend.fone');
        $assistantSend_level = $request->input('assistantSend.level');
        //OJO luego se consumira de request
        $assistantSend_verificatorDigit = 'k';

        //OJO! la carrera nos llega mientras solo su name! => luego actualizar
        $assistantSend_careerName = $request->input('assistantSend.career');
        $assistantSend_facultyName = $request->input('assistantSend.faculty');
        
        $postulationSend_numberTime = $request->input('postulationSend.numberTime');
        $postulationSend_referenceTeacher_id = $request->input('postulationSend.referenceTeacher_id');
        $postulationSend_subject_id = $request->input('postulationSend.subject_id');
        $postulationSend_phase_id = $request->input('postulationSend.subjectPhase');
        $assistantScoreSendArray = $request->input('assistantScore');
        $requirementSendArray = $request->input('requirement');
        //$arrayRequirements = $phpArray['requirement'];
        //$arrayassistantScores = $phpArray['assistantScore'];

        //creamos una nueva postulacion!
        $postulation = new Postulation;
          //CREAR CODE para acceso de teachers
        
        //filtramos por rut del alumno
        $assistant = Assistant::where('rut', $assistantSend_rut)->get();
    
        if ($assistant->isEmpty()) {
            $assistant = new Assistant;
        }else{
            $assistant =  $assistant->first();
        }
    
        
        // Cargamos o Recargamos los datos del estudiante
        $assistant->name = $assistantSend_name;
        $assistant->lastNameDad = $assistantSend_lastNameDad;
        $assistant->lastNameMom = $assistantSend_lastNameMom;
        $assistant->level = $assistantSend_level;
        $assistant->fone = $assistantSend_fone;
        $assistant->rut = $assistantSend_rut;
        $assistant->address = $assistantSend_address;
        $assistant->email = $assistantSend_email;
        $assistant->verificatorDigit = $assistantSend_verificatorDigit;
        $assistant->save();
        

        //Completo la carrera del estudiante
        $career = Career::where('name', $assistantSend_careerName)->first();
       
        $assistant_careers = $assistant->careers;
        
        $same_career_active = 0;
        //si la carrera es la misma y esta activa, no hago nada
        foreach($assistant_careers as $assistant_career){
            if($assistant_career->pivot->active == 1 && $assistant_career->id == $career->id){
                 $same_career_active = 1;
                 break;
            }
        }

        //si la carrera existe  pero no esta activa, ahora la activo.
        $career_not_exist = 0;
        if ($same_career_active == 0) {
            foreach ($assistant_careers as $assistant_career) {
                //si existe la carrera
                if ($assistant_career->id == $career->id) {
                    //reviso las otras carreras del alumno y las inactivo
                    foreach ($assistant_careers as $assistant_career) {
                        $assistant_career->pivot->active = 0;
                        $assistant_career->save();
                    }
                    //luego hago que la carrea encontrada sea activada
                    $assistant_career->pivot->active = 1;
                    $assistant_career->save();
                    $career_not_exist = 1;
                }
            }
        }
        
        //si la carrera no esta registrada por el alumno y no esta activa...
        if($career_not_exist == 0 && $same_career_active == 0){
            $assistant->careers()->attach($career);
        }


        // ------------- PARCHAR assistant CARRER -------------- 
        //if($assistant)
        

        //ATENCION! LA CARRERA SE DEBE ASOCIAR A LA FACULTAD EN CUESTION
        //Y VALIDARSE EL PROCESO! //ademas se asume de que existe
        //$faculty = Faculty::where('name', $assistantSend_facultyName)->first();
        //$career->faculty_id = $faculty->id;
        //Asigamos la asignatura
        $postulation->subject_id = $postulationSend_subject_id;

        //obviamente añadimos al alumno
        $postulation->assistant_id = $assistant->id;

        //y la informacion referente al alumno
        $postulation->numberTime = (integer)$postulationSend_numberTime;
        $postulation->referenceTeacher_id = (integer)$postulationSend_referenceTeacher_id;
        
        //El reference text sera 'null' por mientras
        $postulation->referenceText = "null";
        //accepted en 0 (no esta claro si se usara)
        //$postulation->accepted = 0;

        // Se agrega la id de la fase en cuestion
        $postulation->phase_id = $postulationSend_phase_id;

        //guardamos la postulacion
        $postulation->save();
        $i = 0;
        foreach($requirementSendArray as $requirement){
        
            $assistantScore = new AssistantScore;
            $assistantScore->score = $assistantScoreSendArray[$i];
            $assistantScore->postulation_id = $postulation->id;
            $assistantScore->assistant_id = $assistant->id;
            $assistantScore->subject_id = $requirement['id'];
            $assistantScore->save();
            $i++;
        }
        
        
        return 'CORRECTO';

    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
