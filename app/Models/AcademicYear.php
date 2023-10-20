<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicYear extends Model
{
    use HasFactory;
    public $table = 'academeicyear';
    protected $primaryKey = 'id';

    protected $fillable = ['year'];
}
