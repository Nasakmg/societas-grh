<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Poste extends Model
{
    protected $fillable = ['nom', 'structure_id', 'description'];

    public function structure() { return $this->belongsTo(Structure::class); }
    public function employes()  { return $this->hasMany(Employe::class); }
}
