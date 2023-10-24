<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Student;
use App\Models\Guidance;
use App\Models\User;
use App\Models\Counsel;
use DB;

class CallendarController extends Controller
{
   /**

     * Write code on Method

     *

     * @return response()

     */

     public function index(Request $request)
     {
         if ($request->ajax()) {
            $counselings = Counsel::select('id', 'scheduled_date as start_date', 'start_time', 'end_time', 'student_id')
            ->with('student:id,fname,lname')
            ->get();
            $formattedData = [];

             foreach ($counselings as $counseling) {
                 $startDatetime = $counseling->start_date . ' ' . $counseling->start_time;
                 $endDatetime = $counseling->start_date . ' ' . $counseling->end_time;
             
                 $student = $counseling->student;
                 $title = $student->fname . ' ' . $student->lname;
             
                 $formattedData[] = [
                     'id' => $counseling->id,
                     'title' => $title,
                     'start' => $startDatetime,
                     'end' => $endDatetime,
                 ];
             }
             
             return response()->json($formattedData);
        }
    
        $students = Student::all();
        $guidance = Guidance::all();
    
        return view('FullCalendar', compact('students', 'guidance'));
     }
     

     /**
 
      * Write code on Method
 
      *
 
      * @return response()
 
      */
 
     public function ajax(Request $request)
     {
        // dd($request->all());
        switch ($request->type) {
            case 'add':
                // $event = Counsel::create([
                //     'scheduled_date' => $request->coachingDate,
                //     'start_time' => $request->starttime,
                //     'end_time' => $request->endtime,
                //     'guidance_id' =>$request->guidance,
                //     'student_id' => $request->student,
                //     'Status' => 'PENDING',
                // ]);
                $event = DB::table('counsil')->insert([
                    'scheduled_date' => $request->coachingDate,
                    'start_time' => $request->starttime,
                    'end_time' => $request->endtime,
                    'guidance_id' => $request->guidance,
                    'student_id' => $request->student,
                    'Status' => 'PENDING',
                ]);
                
                
                return response()->json($event);
                break;
                
                case 'update':
                    $event = Counsel::find($request->id)->update([
                        'title' => $request->title,
                        'start' => $request->start,
                        'end' => $request->end,
                    ]);
                    return response()->json($event);
                    break;
                
                case 'delete':
                    $event = Counsel::find($request->id)->delete();
                    return response()->json($event);
                    break;
                    default:
 
              break;
            }
        }
    }
