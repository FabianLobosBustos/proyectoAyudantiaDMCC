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

    //EN ESTA FUNCION PUDE RETORNAN UN ARRAY DE OBJECTS!!!
    //retorna solo las que tienen un periodo activo!!
    public function getActiveSubjects(){
        $subjects = Subject::all();
        $subjects_actives= [];
        foreach($subjects as $subject){
            $periods = $subject->periods;
            foreach ($periods as $period) {
                if($period->pivot->active==1){
                    $subjects_actives[] = $subject;
                    break;
                }
            }
        }

        $subjects_actives = json_encode($subjects_actives);
        return $subjects_actives;
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
