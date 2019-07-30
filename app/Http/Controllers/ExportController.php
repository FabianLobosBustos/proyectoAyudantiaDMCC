<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Subject;
use App\Postulation;

use App\Exports\PostulationsExport;
use Excel;
use App\Report;

//CONTROLADOR ENFOCADO A GENERACION DE REPORTES
class ExportController extends Controller
{
    public function getAllPostulationsToSubjectPDF($idSubject,$idPhase)
    {
        $bigArray = Report::getArrayPostulationsBySubject($idSubject,$idPhase);
        $pdf = PDF::loadView('pdfPractice',  ['data' => $bigArray]);
        return $pdf->download('report.pdf'); 
        
    }

    public function getAllPostulationsToSubjectEXCEL($idSubject,$idPhase) 
    { 
        //despues el bigArray llegara por el frontEnd
        $bigArray = Report::getArrayPostulationsBySubject($idSubject,$idPhase);

        //creamos la primera linea de nuestro reporte
        $firstRow = [
            'Rut',
            'Nombre',
            'Apellido Paterno',
            'Apellido Materno',
            'Email',
            'Telefono',
            'Dirección',
            'Facultad',
            'Carrera',
            'Nivel'
        ];

        foreach($bigArray[0]['requirements_subject'] as $requirement){
            array_push($firstRow,$requirement['requirement_name']);
        }

        //agregamos las filas faltantes -> arrayExport es el contenedor macro
        $arrayExport=[$firstRow];

        foreach ($bigArray[0]['assistants'] as $value){
            
            $secondRow = [
                $value['assistant_rut'],
                $value['assistant_name'],
                $value['assistant_lastNameDad'],
                $value['assistant_lastNameMom'],
                $value['assistant_email'],
                $value['assistant_fone'],
                $value['assistant_address'],
                $value['faculty_name'],
                $value['career_name'],
                $value['assistant_level'],
            ];
            foreach ($value['scores'] as $score){
                array_push($secondRow,$score['score']);
            }
            array_push($arrayExport,$secondRow);
        }
        
        //Creamos el array a exportar
        $export = new PostulationsExport($arrayExport);

        //Se descarga el Excel con el contenido
        return Excel::download($export, 'report.xlsx'); 
         
    } 
    
}