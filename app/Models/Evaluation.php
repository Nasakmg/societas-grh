<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    protected $fillable = [
        'employe_id','evaluateur_id',
        'periode','score','objectifs','commentaires'
    ];

    public function employe()    { return $this->belongsTo(Employe::class); }
    public function evaluateur() { return $this->belongsTo(User::class, 'evaluateur_id'); }
}
