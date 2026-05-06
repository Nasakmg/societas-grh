<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    protected $fillable = [
        'user_id','prenom','nom','email','telephone',
        'poste_id','structure_id','contrat','salaire_base',
        'date_embauche','matricule','photo','statut','duree_suspension'
    ];

    public function user()       { return $this->belongsTo(User::class); }
    public function structure()  { return $this->belongsTo(Structure::class); }
    public function poste()      { return $this->belongsTo(Poste::class); }
    public function conges()     { return $this->hasMany(Conge::class); }
    public function presences()  { return $this->hasMany(Presence::class); }
    public function fichePaies() { return $this->hasMany(FichePaie::class); }
    public function contrats()   { return $this->hasMany(Contrat::class); }
    public function evaluations(){ return $this->hasMany(Evaluation::class); }

    public function getNomCompletAttribute()
    {
        return $this->prenom . ' ' . $this->nom;
    }
}
