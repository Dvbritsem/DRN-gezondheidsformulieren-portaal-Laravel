<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GezForm extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function gez_warnadres() {
        return $this->hasMany(GezWarnadres::class);
    }

    public function gez_medischegegevens() {
        return $this->hasOne(GezMedischeGegevens::class);
    }
}
