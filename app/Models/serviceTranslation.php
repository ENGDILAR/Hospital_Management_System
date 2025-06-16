<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class serviceTranslation extends Model
{
    use HasFactory;
    public $fillable = ['name'];
    public $timestamps =false;
}
