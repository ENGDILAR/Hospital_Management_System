<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class group extends Model
{
    use Translatable;
    use HasFactory;
    public $translatedAttributes = ['name','notes'];
    public $fillable= ['Total_before_discount','discount_value','Total_after_discount','tax_rate','Total_with_tax'];
    //public $guarded=[]; we allow any extrenal columon 

// 1 to many
    public function service_group()
    {
        //in the pivot table we should call the not-referenced columon manualy ->withPivot('quantity,''...')
        return $this->belongsToMany(service::class,'service_group')->withPivot('quantity');
    }
    
}

// here we will work on livewire insted of controller to wprk without ajax and avoid makeing refresh every time when anything changed 
// go to livewire laravel
// select documintation section