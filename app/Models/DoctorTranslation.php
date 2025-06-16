<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorTranslation extends Model
{
    // we donot put use tanslatable here cause we have to add $tanslatedattribute vaiables
    use HasFactory; 
    public $fillable = ['name'];
    public $timestamps = false;
}
