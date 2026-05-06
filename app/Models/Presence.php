<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Presence extends Model
{
    protected $fillable = [
        'employe_id','date','heure_arrivee',
        'heure_depart','statut','note'
    ];

    public function employe() { return $this->belongsTo(Employe::class); }
}
