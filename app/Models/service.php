<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class service extends Model
{
    use Translatable;
    use HasFactory;
    // 3. To define which attributes needs to be translated
public $translatedAttributes = ['name'];

public $fillable=['price','description','status','name'];

}
