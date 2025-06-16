<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insurancetranslation extends Model
{
    use HasFactory;
    public $fillable=['name','notes'];
    public $timestamps =false;
}
