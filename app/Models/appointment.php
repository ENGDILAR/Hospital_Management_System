<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class appointment extends Model
{
    use Translatable;
    public $translatedAttributes=['name'];
    public $fillable=['name'];
    use HasFactory;
}
