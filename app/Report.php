<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Report extends Model
{

    public static function getArrayPostulationsBySubject($idSubject,$idPeriod)
    {
        //Recuperamos los datos
        $subject = Subject::query();
        $subject = $subject->where('id', $idSubject)->first();
        $postulations = Postulation::query();
        //filtro por subject_id y luego por periodo_id

        $postulations = DB::table('postulations')->where('subject_id',$subject->id);
        //$postulations = $postulations->where('subject_id',$subject->id);
        $postulations = $postulations->where('period_id',$idPeriod)->get();
        //error_log($idPeriod);
        //error_log($subject->id);
        //dd($postulations);

       

        $requirements = $subject->requirements;
        
        //creamos el array
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
            error_log('k wea!');

            $student = Student::find($postulation->student_id);
            $career = $student->careers->first();
            $faculty = $career->faculty;

            $scores = StudentScore::where('postulation_id', $postulation->id)->get();
            //$scores = $postulation->studentScores;
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

        return $bigArray;
    }
}