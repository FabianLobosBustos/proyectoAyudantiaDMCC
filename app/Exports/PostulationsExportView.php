<?php

namespace App\Exports;

use App\Postulation;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PostulationsExportView implements FromView
{
    public function view($idSubject): View
    {
        $bigArray = Postulation::getArrayPostulationsBySubject($idSubject);
        return view('postulation.table', ['data' => $bigArray]);
    }
}

