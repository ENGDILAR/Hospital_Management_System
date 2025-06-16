<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class appointmentTranslation extends Model
{
    protected $fillable =['name'];
    public $timestamps =false;
    use HasFactory;
}
