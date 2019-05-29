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
    public function getAllPostulationsToSubjectPDF($idSubject,$idPeriod)
    {
        $bigArray = Report::getArrayPostulationsBySubject($idSubject,$idPeriod);
        $pdf = PDF::loadView('pdfPractice',  ['data' => $bigArray]);
        return $pdf->download('report.pdf'); 
        
    }

    public function getAllPostulationsToSubjectEXCEL($idSubject,$idPeriod) 
    { 
        //despues el bigArray llegara por el frontEnd
        $bigArray = Report::getArrayPostulationsBySubject($idSubject,$idPeriod);

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

        foreach ($bigArray[0]['students'] as $value){
            
            $secondRow = [
                $value['student_rut'],
                $value['student_name'],
                $value['student_lastNameDad'],
                $value['student_lastNameMom'],
                $value['student_email'],
                $value['student_fone'],
                $value['student_address'],
                $value['faculty_name'],
                $value['career_name'],
                $value['student_level'],
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