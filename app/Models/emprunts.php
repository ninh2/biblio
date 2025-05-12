<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class emprunts extends Model
{
    use HasFactory;
    protected $table = 'emprunts';

    public $timestamps = false;

    protected $primaryKey = 'id_emprunt';

    protected $fillable = [
        'id',
        'date'
    ];

    public function ouvrages()
    {
        return $this->belongsTo(Ouvrages::class, 'id_emprunt', 'id_ouvrages');
    }

    public function utilisateurs()
    {
        return $this->belongsTo(Utilisateur::class, 'id_emprunt', 'id_utilisateur');
    }


}