<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public static $rules = ['name' =>'required',
        'email' =>'required',
        'comment'=>'required',
        'announcement_id'=>'required'];

    public static $messages = [
        'required' => 'This field is required!'];
}
