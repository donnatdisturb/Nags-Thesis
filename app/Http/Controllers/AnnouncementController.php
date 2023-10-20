<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Announcement;
use App\Models\Guidance;

use Illuminate\Support\Facades\Storage;

use DB;
use Auth;
use View;
use Redirect;

class AnnouncementController extends Controller
{

    

    public function index1()
    {
         $announcements = DB::table('announcements')
             ->join('guidances','announcements.postedby','guidances.id')
             ->select('announcements.*', 'guidances.lname', 'guidances.fname', 'guidances.guidance_img AS guidanceIMG')
             ->get();
 
    return View::make('welcome',compact('announcements')) ;
    }

    public function index()
    {
        $announcements = DB::table('announcements')
            ->join('guidances','announcements.postedby','guidances.id')
            ->select('announcements.*', 'guidances.lname', 'guidances.fname')
            ->orderBy('id','DESC')
            ->paginate(5);

    return View::make('announcements.index',compact('announcements')) ;
    }

    public function announcement()
    {
        $announcements = Announcement::all();
     

    return View::make('announcements.announcement',compact('announcements')) ;
    }

  
    public function create()
    {
        return View::make('announcements.create');
    }

   
    public function store(Request $request)
    {   
        
        $input = $request->all();
         if($request->hasFile('image')) {
            
            $file = $request->file('image') ;
            $fileName = uniqid().'_'.$file->getClientOriginalName();
            $request->image->storeAs('images', $fileName, 'public');
            $input['announcement_img'] = $fileName;
            $input['postedby'] = Auth::user()->id;
            $announcements = Announcement::create($input);
        }

        return Redirect::route('announcementindex')->with('success','Announcement posted successfully!');
    }
    
    public function edit($id)
    {
        $announcements = Announcement::find($id);

        $guidances = Guidance::pluck('lname', 'id');
        return View::make('announcements.edit',compact('announcements', 'guidances'));
    }


    public function update(Request $request, $id)
    {
      $announcements = Announcement::find($id);
       $input = $request->all();
       
     if ($request->hasFile('image')) {

          $file = $request->file('image') ;
          $fileName = uniqid().'_'.$file->getClientOriginalName();
          $request->image->storeAs('images', $fileName, 'public');
          $input['announcement_img'] = $fileName;
      }
       $announcements->update($input);

       return Redirect::route('announcementindex')->with('success','Announcement edited Successfully!');
    }

    public function destroy($id)
    {
        $announcements = Announcement::find($id);
        $announcements->delete();
        return Redirect::route('announcements.index')->with('success','Announcement Deleted Success!');
    }
}
