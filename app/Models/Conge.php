<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conge extends Model
{
    protected $fillable = [
        'employe_id','valideur_id','type',
        'date_debut','date_fin','nb_jours','motif','statut'
    ];

    public function employe() { return $this->belongsTo(Employe::class); }
    public function valideur(){ return $this->belongsTo(User::class, 'valideur_id'); }
}
