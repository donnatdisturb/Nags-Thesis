<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guidance;
use App\Models\User;

use View;
use Redirect;
use Validator;
use Event;
use Auth;

use App\Imports\GuidanceImport;
use Excel;
use App\Rules\ExcelRule;


class GuidanceController extends Controller
{
    public function index()
    {
        $guidances= Guidance::paginate(5);

        return View::make('guidance.index',compact('guidances'));
    }

    public function create()
    {
        return View::make('guidance.create');
    }

    public function store(Request $request)
    {
        $user = new User([
            'name' => $request->input('fname'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'role'=>"guidance"
          ]);
  
        $user->save();
        $input = $request->all();
         if($request->hasFile('image')) {
            
            $file = $request->file('image') ;
            $fileName = uniqid().'_'.$file->getClientOriginalName();
            $request->image->storeAs('images', $fileName, 'public');
            $input['guidance_img'] = $fileName;
            $input['user_id']= $user->id;
             $guidances = Guidance::create($input);
        }

        return Redirect::route('guidance.index')->with('success','Guidance Success!');
    }

    public function edit($id)
    {
        $guidances = Guidance::find($id);
        return View::make('guidance.edit',compact('guidances'));
    }

  public function update(Request $request, $id)
    {
        $guidances = Guidance::find($id);

        $input = $request->all();
         
       if ($request->hasFile('image')) {

            $file = $request->file('image') ;
            $fileName = uniqid().'_'.$file->getClientOriginalName();
            $request->image->storeAs('images', $fileName, 'public');
            $input['guidance_img'] = $fileName;
        }
         $guidances->update($input);

         return Redirect::route('guidance.index')->with('success','Guidance Success!');
        }

    public function destroy($id)
    {
        $guidances = Guidance::find($id);
        $guidances->delete();
        return Redirect::route('guidance.index')->with('success','Guidance Deleted Success!');
    }

    public function profile(){
        $guidance = Auth::user()->id;
        
        $guidanceinfo = Guidance::with('user')->where('user_id','=',$guidance)->get();
        return view('guidance.profile', compact('guidanceinfo') );
    
       }
       
    public function import(Request $request) {

        $request->validate([
           'guidance_upload' => ['required', new ExcelRule($request->file('guidance_upload'))],
       ]);

        Excel::import(new GuidanceImport, request()->file('guidance_upload'));
       return redirect()->back()->with('success', 'Excel file Imported Successfully');
   }

   
   public function editProfile($id){
    $guidanceid= Auth::user()->id;
    $guidance = Guidance::find($id);
    $guidances = Guidance::with('user')->where('user_id',$guidanceid)->get();

          
    return View::make('guidance.editprofile',compact('guidanceid','guidance','guidances'));

   }

   public function updateprofile(Request $request, $id)
   {
       
       $guidances = Guidance::find($id);

        $input = $request->all();
        
      if ($request->hasFile('image')) {

           $file = $request->file('image') ;
           $fileName = uniqid().'_'.$file->getClientOriginalName();
           $request->image->storeAs('images', $fileName, 'public');
           $input['guidance_img'] = $fileName;
       }
        $guidances->update($input);
       return redirect()->route('guidance.profile');
       }    
   
}
