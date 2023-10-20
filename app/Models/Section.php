<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    public $table = 'sections';
    protected $primaryKey = 'id';

    protected $fillable = ['sectionname'];
}
