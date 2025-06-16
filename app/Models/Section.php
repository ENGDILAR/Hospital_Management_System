<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// 1. To specify package’s class you are using
class Section extends Model
{
 
//cause inn sections tabel we just have increment id
use Translatable; // 2. To add translation methods


//we will give im a fake columon that is not in our table from dab
protected $fillable =['name','description'];


// 3. To define which attributes needs to be translated
public $translatedAttributes = ['name','description'];

public function doctors()
{
    return $this->hasMany(Doctor::class);
}

use HasFactory;


}
