<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    use HasFactory;

    protected $table = 'commentaires';
    protected $primaryKey = 'id_commentaire'; 

    protected $fillable = [
        'id_ouvrage', 
        'date_creation', 
        'statut',
        'note'
    ];

    public $timestamps = false; // Désactiver created_at et updated_at

    // Relation avec l'ouvrage
    public function ouvrage()
    {
        return $this->belongsTo(Ouvrages::class, 'id_ouvrage');
    }
}
