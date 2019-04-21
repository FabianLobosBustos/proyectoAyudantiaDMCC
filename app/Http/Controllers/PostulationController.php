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
        //creamos una nueva postulacion!
        $postulation = new Postulation;
        error_log('ingresando al metodo');
        //filtramos por rut del alumno
        $student = Student::where('rut',$request->student_rut)->get();
        if(!$student->isEmpty()){
            error_log('Se ha encontrado al alumno');
            //Recargamos los datos del alumno!
            $student = $student->first();
            $student->name = $request->student_name;
            $student->lastName = $request->student_lastName;
            $student->level = $request->student_level;
            $student->fone =$request->student_fone;
            $student->rut = $request->student_rut;
            $student->verificatorDigit = $request->student_verificatorDigit;
            $student->address = $request->student_address;
            error_log('a punto de guardar');
            $student->save();
            //falta el cooreo 
            //asumiendo que nos llega el nombre de la carrera
            //Buscamos la carrera especifica y la atamos al alumno
            $career = Career::where('name',$request->carrer_name)->first();
            $student->careers()->attach($career);

            //ATENCION! LA CARRERA SE DEBE ASOCIAR A LA FACULTAD EN CUESTION
            //Y VALIDARSE EL PROCESO! //ademas se asume de que existe
            $faculty = Faculty::where('name',$request->faculty_name)->first();
            $career->faculty_id = $faculty->id;

            //asi mismo con la asignatua a la que postula
            $subject = Subject::where('name',$request->subject_name)->first();
            $postulation->subject_id = $subject->id;

            //obviamente añadimos al alumno
            $postulation->student_id = $student->id;

            //y la informacion referente al alumno
            $postulation->numberTime = $request->postulation_numberTime;
            $postulation->referenceTeacher = $request->postulation_id_referenceTeacher;
            $postulation->accepted = 0;
            //QUEDA PENDIENTE EL TEMA DE LAS NOTAS!!!
                //basicamente es porque aun no se sabe el
                //como se enviaran del frontEnd
        
            //guardamos la postulacion
            $postulation->save();
            return 'CORRECTO';
        
        }

        return 'ALUMNO_NO_REGISTRADO';
        
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
