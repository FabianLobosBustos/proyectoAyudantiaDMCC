<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Phase;
use App\Subject;

class PhaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Phase::all();
    }

    //Retorna la fase activa de la asignatura en cuestion
    public function phaseBySubject($id_subject){
        
        $subject = Subject::where('id',$id_subject)->first();
        
        $phases = $subject->phases;
        
        foreach ($phases as $phase) {
            if($phase->pivot->active == 1){
                $phase_active = $phase;
                break;
            }
        } 

        return $phase_active;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

          $phase = new Phase([
            'semester' => $request->get('semester'),
            'year'=> $request->get('year'),
            'start'=> $request->get('start'),
            'finish' => $request->get('finish')
          ]);
          $phase->save();
          return 1;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $phase = Phase::where('id',$id)->first();
        return $phase;
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
        $phase = Phase::where('id',$id)->first();

        $phase->start = $request->get('start');
        $phase->finish = $request->get('finish');

        $phase->save();
        return 1;
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
