<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Period;
use App\Subject;

class PeriodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Period::all();
    }

    //Retorna el periodo activo de la asignatura en cuestion
    public function periodBySubject($id_subject){
        
        $subject = Subject::where('id',$id_subject)->first();
        
        $periods = $subject->periods;
        
        foreach ($periods as $period) {
            if($period->pivot->active == 1){
                $period_active = $period;
                break;
            }
        } 

        return $period_active;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

          $period = new Period([
            'semester' => $request->get('semester'),
            'year'=> $request->get('year'),
            'start'=> $request->get('start'),
            'finish' => $request->get('finish')
          ]);
          $period->save();
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
        $period = Period::where('id',$id)->first();
        return $period;
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
        $period = Period::where('id',$id)->first();

        $period->start = $request->get('start');
        $period->finish = $request->get('finish');

        $period->save();
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
