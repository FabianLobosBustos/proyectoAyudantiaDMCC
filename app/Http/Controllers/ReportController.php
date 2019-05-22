<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use Excel;
use App\Subject;
use App\Student;

class ReportController extends Controller
{
    public function getAllPostulationsToSubjectPDF($idSubject)
    {
        $subject = Subject::where('id', $idSubject)->first();
        
        $postulations = $subject->postulations;
        $requirements = $subject->requirements;
        $array_students = [];
        $array_requirements = [];
        
        $bigArray = [];

        error_log('pulento');
        //ENTREGAR TODOS LOS DATOS!!
        foreach ($requirements as $requirement){
            $subjectRequirement = Subject::where('id', $requirement->referenceSubject)->first();
            $array_requirements[] = [
                'requirement_id' => $subjectRequirement->id,
                'requirement_name' => $subjectRequirement->name
            ];
        }

        

        foreach ($postulations as $postulation) {
            $student = $postulation->student;
            $career = $student->careers->first();
            $faculty = $career->faculty;
            $scores = $postulation->studentScores;
            $array_studentScores = [];

            foreach($scores as $score){
                $array_studentScores[] = [
                    'subject_id' => $score->subject_id,
                    'score' => $score->score 
                ];
            }

            $array_students[] = [
                'student_rut' => $student->rut,
                'student_fone' => $student->fone,
                'student_email' => $student->email,
                'student_address' => $student->address,
                'student_name' => $student->name,
                'student_lastNameDad' => $student->lastNameDad,
                'student_lastNameMom' => $student->lastNameMom,
                'student_level' => $student->level,
                'faculty_name' => $faculty->name,
                'career_name' => $career->name,
                'scores' => $array_studentScores
            ];

        }
        $bigArray[] = [
            'subject_name' => $subject->name,
            'requirements_subject' => $array_requirements,
            'students' => $array_students
        ];
        

        //COMENTARIO VITAL DE TESTING
        //dd($bigArray);
        $pdf = PDF::loadView('pdfPractice',  ['data' => $bigArray]);
        error_log('ALFIN CTM!!');
        return $pdf->download('invoice.pdf'); 
        
    }

    public function getAllPostulationsToSubjectEXCEL($idSubject)
    {
   
        return Excel::download('Filename', function($excel) use($bigArray) {
        
            $excel->sheet('Sheetname', function($sheet) use($bigArray) {
        
                $sheet->fromArray($bigArray);
        
            });
        
        });
        
    }
}