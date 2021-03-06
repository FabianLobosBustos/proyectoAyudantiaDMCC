<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subject;
class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Subject::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
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


    //!!!!! RECORDAR AÑADIR ID DEL REQUIREMENT EN CUESTION (para el posterior destroy)!
    public function showRequirementsBySubject($id){
        //REALIZAR FILTRADO PARA QUE NO SE CAIGA EL METODO!
        $subject = Subject::where('id', $id)->first();
        $requirements = $subject->requirements;     
        //creando json
        $list_of_requirements = [];
        foreach($requirements as $requirement){
            $requirementName = Subject::where('id', $requirement->referenceSubject)->first()->name;
            
            $list_of_requirements[] = [
                $requirement->referenceSubject,
                $requirementName
            ];
        }
       
        $list_of_requirements = json_encode($list_of_requirements);
        return $list_of_requirements;
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
