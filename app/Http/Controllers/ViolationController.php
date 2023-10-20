<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ViolationClassifier;

class ViolationController extends Controller
{
    protected $classifier;

    public function __construct(ViolationClassifier $classifier)
    {
        $this->classifier = $classifier;
    }

    public function showForm()
    {
        return view('violation_form');
    }

    public function classifyViolation(Request $request)
    {
        $description = $request->input('description');
    
            $X = [
                "Punching",
                "He is violent",
                "He is a cyberbullying me",
            ];

            $y = [
                "Major",
                "Minor",
                "Minor",
            ];
                   

        if (count($X) !== count($y)) {
            throw new \InvalidArgumentException('Number of samples in $X and $y must be the same.');
        }
    
        $classifier = new ViolationClassifier();
        $classifier->train($X, $y);
        //dd($classifier);
        $uniqueTargets = $classifier->getUniqueTargets();

        
        $prediction = $classifier->predict($description);
        // dd($prediction)
     
       
        return view('violation_result', ['prediction' => $prediction]);
    
    }
    
    


}
