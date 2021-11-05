<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GezMedischeGegevens extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $touches = ['gez_form'];

    public function gez_form() {
        return $this->belongsTo(GezForm::class);
    }
}
