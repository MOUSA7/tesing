<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{

    public function scope(){
      $scope = Student::name()->get();
      return $scope;
    }

    public function access(){
        $access = Student::name()->get();
        return $access;
    }

    public function mutators_read(){
        $students = Student::all();
        foreach ($students as $student){
           dd($student->name);
        }

    }

    public function mutators_store(){
        $student = Student::create([
            'name'=>'hend',
            'subject_id'=>3,
            'address'=>'nablus'
        ]);
    }

    public function index(){
        $filter = Student::all()->filter(function ($value){
            return $value->subject_id == 2;
        });
        return $filter;
    }
    //
}
