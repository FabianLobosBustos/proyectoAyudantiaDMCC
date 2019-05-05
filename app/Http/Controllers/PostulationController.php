<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Postulation;
use App\Student;
use App\Faculty;
use App\Career;
use App\Subject;
use App\StudentScore;


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
    //si algo es inerente al alumno, sera student_atributo
    //si algo es inerente de la carrera, sera career_atributo
    //si algo es inerente de la facultad, sera faculty_atributo
    //asi hasta el final de los tiempo
    public function store(Request $request)
    {

     
        //obtenemos todos los datos
        $studentSend_rut = $request->input('studentSend.rut');
        $studentSend_name = $request->input('studentSend.name');
        $studentSend_lastNameDad = $request->input('studentSend.lastNameDad');
        $studentSend_lastNameMom = $request->input('studentSend.lastNameMom');
        $studentSend_address = $request->input('studentSend.address');
        $studentSend_email = $request->input('studentSend.email');
        $studentSend_fone = $request->input('studentSend.fone');
        $studentSend_level = $request->input('studentSend.level');
        //OJO luego se consumira de request
        $studentSend_verificatorDigit = 'k';

        //OJO! la carrera nos llega mientras solo su name! => luego actualizar
        $studentSend_careerName = $request->input('studentSend.career');
        $studentSend_facultyName = $request->input('studentSend.faculty');
        
        $postulationSend_numberTime = $request->input('postulationSend.numberTime');
        $postulationSend_referenceTeacher_id = $request->input('postulationSend.referenceTeacher_id');
        $postulationSend_subject_id = $request->input('postulationSend.subject_id');

        $studentScoreSendArray = $request->input('studentScore');
        $requirementSendArray = $request->input('requirement');
        //$arrayRequirements = $phpArray['requirement'];
        //$arrayStudentScores = $phpArray['studentScore'];

        //creamos una nueva postulacion!
        $postulation = new Postulation;
          //CREAR CODE para acceso de teachers
        
        //filtramos por rut del alumno
        $student = Student::where('rut', $studentSend_rut)->get();
        
        if ($student->isEmpty()) {
            $student = new Student;
        }else{
            $student =  $student->first();
        }
    
        
        // Cargamos o Recargamos los datos del estudiante
        $student->name = $studentSend_name;
        $student->lastNameDad = $studentSend_lastNameDad;
        $student->lastNameMom = $studentSend_lastNameMom;
        $student->level = $studentSend_level;
        $student->fone = $studentSend_fone;
        $student->rut = $studentSend_rut;
        $student->address = $studentSend_address;
        $student->email = $studentSend_email;
        $student->verificatorDigit = $studentSend_verificatorDigit;
        $student->save();
        

        //Completo la carrera del estudiante
        $career = Career::where('name', $studentSend_careerName)->first();
        $student->careers()->attach($career);
        //ATENCION! LA CARRERA SE DEBE ASOCIAR A LA FACULTAD EN CUESTION
        //Y VALIDARSE EL PROCESO! //ademas se asume de que existe
        //$faculty = Faculty::where('name', $studentSend_facultyName)->first();
        //$career->faculty_id = $faculty->id;
        //Asigamos la asignatura
        $postulation->subject_id = $postulationSend_subject_id;

        //obviamente añadimos al alumno
        $postulation->student_id = $student->id;

        //y la informacion referente al alumno
        $postulation->numberTime = (integer)$postulationSend_numberTime;
        $postulation->referenceTeacher_id = (integer)$postulationSend_referenceTeacher_id;
        
        //El reference text sera 'null' por mientras
        $postulation->referenceText = "null";
        //accepted en 0 (no esta claro si se usara)
        //$postulation->accepted = 0;

        
        //guardamos la postulacion
        $postulation->save();
        $i = 0;
        foreach($requirementSendArray as $requirement){
        
            $studentScore = new StudentScore;
            $studentScore->score = $studentScoreSendArray[$i];
            $studentScore->postulation_id = $postulation->id;
            $studentScore->student_id = $student->id;
            $studentScore->subject_id = $requirement['id'];
            $studentScore->save();
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
