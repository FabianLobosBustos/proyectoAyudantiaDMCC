<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Faculty;
use App\Career;

class FacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function allFacultiesCareers(){
        $faculties = Faculty::all();  

        $array = [];
        
        foreach ($faculties as $faculty) {
            $careers = $faculty->careers;
            $listOfCareer=[];
            foreach ($careers as $career) {
                $listOfCareer[] = [
                    'career_id' => $career->id,
                    'career_name' => $career->name
                ];
            }
            $array[] = [
                'faculty_id' => $faculty->id,
                'faculty_name' => $faculty->name,
                'careers' => $listOfCareer
            ];
        }

        $array = json_encode($array);

        return $array;
        
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
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
