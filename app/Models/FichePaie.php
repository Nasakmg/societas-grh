<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FichePaie extends Model
{
    protected $fillable = [
        'employe_id','periode','salaire_brut',
        'cnss_employe','ipres_employe',
        'autres_deductions','salaire_net',
        'date_emission','statut'
    ];

    public function employe() { return $this->belongsTo(Employe::class); }
}
