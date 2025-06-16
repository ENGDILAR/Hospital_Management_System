<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Doctor extends Model
{
    use HasFactory;
    use Translatable;
    public $translatedAttributes = ['name','appointments'];
    // we dont have name and appointments in this table but we have to put a fake value to translate it 
    public $fillable = ['email','email_verified_at','password','phone','name','section_id','status','user_id'];
    
    /**
     * Get the Doctor's image.
     */
    // onr to one
    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function section(): BelongsTo
    { 
        // one to many
        return $this->belongsTo(Section::class);
    }
    public function doctorappointments()
    {
        return $this->belongsToMany(appointment::class,'appointment_doctor');
    }
}
