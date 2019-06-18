<?php

namespace App\Http\Controllers;

use App\Report;

class ReportController extends Controller
{
    //por el momento no se usa un big array
    public function getArrayPostulationsBySubject($idSubject){
        /*
        $bigArray = Report::getArrayPostulationsBySubject($idSubject);
        $bigArray = json_encode($bigArray);
        return $bigArray;
        */
    }


    
}
