<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Structure extends Model
{
    protected $fillable = ['nom', 'responsable_id'];

    public function employes()    { return $this->hasMany(Employe::class); }
    public function postes()      { return $this->hasMany(Poste::class); }
    public function responsable() { return $this->belongsTo(Employe::class, 'responsable_id'); }
}
