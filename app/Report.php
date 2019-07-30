<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Report extends Model
{

    public static function getArrayPostulationsBySubject($idSubject,$idPhase)
    {
        //Recuperamos los datos
        $subject = Subject::query();
        $subject = $subject->where('id', $idSubject)->first();
        $postulations = Postulation::query();
        //filtro por subject_id y luego por phase_id

        $postulations = DB::table('postulations')->where('subject_id',$subject->id);
        //$postulations = $postulations->where('subject_id',$subject->id);
        $postulations = $postulations->where('phase_id',$idPhase)->get();
        //error_log($idPhase);
        //error_log($subject->id);
        //dd($postulations);

       

        $requirements = $subject->requirements;
        
        //creamos el array
        $array_assistants = [];
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

            $assistant = Assistant::find($postulation->assistant_id);
            $career = $assistant->careers->first();
            $faculty = $career->faculty;

            $scores = AssistantScore::where('postulation_id', $postulation->id)->get();
            //$scores = $postulation->assistantScores;
            $array_assistantScores = [];

            foreach($scores as $score){
                $array_assistantScores[] = [
                    'subject_id' => $score->subject_id,
                    'score' => $score->score 
                ];
            }

            $array_assistants[] = [
                'assistant_rut' => $assistant->rut,
                'assistant_fone' => $assistant->fone,
                'assistant_email' => $assistant->email,
                'assistant_address' => $assistant->address,
                'assistant_name' => $assistant->name,
                'assistant_lastNameDad' => $assistant->lastNameDad,
                'assistant_lastNameMom' => $assistant->lastNameMom,
                'assistant_level' => $assistant->level,
                'assistant_ppa' => $assistant->ppa,
                'faculty_name' => $faculty->name,
                'career_name' => $career->name,
                'scores' => $array_assistantScores
            ];

        }
        $bigArray[] = [
            'subject_name' => $subject->name,
            'requirements_subject' => $array_requirements,
            'assistants' => $array_assistants
        ];

        return $bigArray;
    }
}