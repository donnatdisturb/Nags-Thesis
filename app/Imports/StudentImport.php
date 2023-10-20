<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithValidation;
use App\Models\Student;
use App\Models\User;
use App\Models\Section;
use App\Models\Course;
use App\Models\StudentFamily;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;

class StudentImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {
            try {
                $user = User::where('email',$row['email'])->firstOrFail();
            }
            catch(ModelNotFoundException $ex) {
                $user = new User();
                $user->email = $row['email'];
                $user->password = Hash::make('password');
                $user->role = $row['role'];
                $user->save();
            }

            try {
                $family = StudentFamily::where('lname',$row['guardian_lname'])->firstOrFail();
            }
            catch (ModelNotFoundException $ex) {
                $family = new StudentFamily();
                $family->fname = $row['guardian_fname'];
                $family->lname = $row['guardian_lname'];
                $family->phone = $row['guardian_phone'];
                $family->address = $row['guardian_address'];
                $family->email = $row['guardian_email'];
                $family->save(); 
            }

            try {
                $section = Section::where('sectionname',$row['sectionname'])->firstOrFail();
                }
                catch (ModelNotFoundException $ex) {
                    $section = new Section();
                    $section->sectionname = $row['sectionname'];
                    $section->save();
            }
            
            try {
                $course = Course::where('coursecode',$row['coursecode'])->firstOrFail();
                }
                
                catch (ModelNotFoundException $ex) {
                    $course = new Course();
                    $course->coursename = $row['coursename'];
                    $course->coursecode = $row['coursecode'];
                    $course->save();
            }
            
            try{
                $student = Student::where('lname', $row['lname'])->where('fname', $row['fname'])->firstOrFail();
            }
            
            catch(ModelNotFoundException $ex) {
                
                $student = new Student();
                $student->lname = $row['lname'];
                $student->fname = $row['fname'];
                $student->student_img = $row['student_img'];
                $student->user()->associate($user);
                $student->StudentFamily()->associate($family);
                $student->section()->associate($section);
                $student->course()->associate($course);
                $student->save();
            }
        }
    }
}
