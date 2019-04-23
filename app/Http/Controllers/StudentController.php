<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Student;
use App\Career;

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

    
    //Funcion que retorna el alumno, en el caso de que este exista en la bd
    public function checkByRut(Request $request)
    {



        
        $student = Student::where('rut',(int)$request->rut)->get();

        if($student->isEmpty()){
           return 0; 
        }
        
        return $student;
        
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
