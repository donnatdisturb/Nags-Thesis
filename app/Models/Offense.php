<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offense extends Model
{
    use HasFactory;
    public $table = 'offenses';
    protected $primaryKey = 'id';

    protected $fillable = ['offensename'];
}