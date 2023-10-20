<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    public $table = 'announcements';
    public $primaryKey = 'id';
    // public $timestamps = false;

    protected $fillable = ['title','content','postedby','announcement_img'];
}
