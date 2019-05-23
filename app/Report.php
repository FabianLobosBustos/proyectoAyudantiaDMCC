<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Report extends Model
{

    public static function getArrayPostulationsBySubject($idSubject)
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

        return $bigArray;
    }
}