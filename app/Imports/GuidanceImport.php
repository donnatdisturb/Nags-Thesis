<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

use App\Models\User;
use App\Models\Guidance;

use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\WithValidation;



class GuidanceImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {
            // dd($row);
            try {
               
            $user = User::where('email',$row['email'])->firstOrFail();
               }

               catch(ModelNotFoundException $ex) {
                 //dd($ex);
                $user = new User();
                $user->email = $row['email'];
                $user->password = Hash::make('password');
                $user->role = $row['role'];
                $user->save();
            }

        try{
            $guidance = Guidance::where('lname', $row['lname'])->where('fname', $row['fname'])->firstOrFail();
            // dd($guidance);
            }

            catch(ModelNotFoundException $ex) {

            $guidance = new Guidance();
            //$customer->title = $row['title'];
            $guidance->lname = $row['lname'];
            $guidance->fname = $row['fname'];
            $guidance->guidance_img = $row['guidance_img'];
          
            $guidance->user()->associate($user);

            $guidance->save();
        }

        
    }
    }
}